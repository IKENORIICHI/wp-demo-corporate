/* ===========================
   ヒーローセクション：ネットワーク風パーティクルアニメーション
   PKSHAサイトを参考にした動く線のビジュアル
   =========================== */
(function () {
  const canvas = document.getElementById('heroCanvas');
  if (!canvas) return;

  const ctx = canvas.getContext('2d');
  let width, height;
  let particles = [];
  let animationId;
  let mouse = { x: -9999, y: -9999 };

  /* パーティクル設定 */
  const CONFIG = {
    particleCount: 80,        /* ノード数 */
    connectionDist: 160,      /* 線を引く最大距離 */
    mouseDist: 200,           /* マウスに反応する距離 */
    baseSpeed: 0.3,           /* 基本移動速度 */
    particleRadius: 2,        /* ノードの半径 */
    lineWidth: 0.8,           /* 線の太さ */
    color: { r: 56, g: 182, b: 216 }  /* 水色 #38b6d8 */
  };

  /* キャンバスサイズをウィンドウに合わせる */
  function resize() {
    const hero = canvas.parentElement;
    width = canvas.width = hero.offsetWidth;
    height = canvas.height = hero.offsetHeight;
  }

  /* パーティクル生成 */
  function createParticles() {
    particles = [];
    const count = width < 768 ? Math.floor(CONFIG.particleCount * 0.5) : CONFIG.particleCount;
    for (let i = 0; i < count; i++) {
      particles.push({
        x: Math.random() * width,
        y: Math.random() * height,
        vx: (Math.random() - 0.5) * CONFIG.baseSpeed * 2,
        vy: (Math.random() - 0.5) * CONFIG.baseSpeed * 2,
        radius: CONFIG.particleRadius * (0.5 + Math.random() * 0.8)
      });
    }
  }

  /* パーティクル更新 */
  function updateParticles() {
    for (const p of particles) {
      p.x += p.vx;
      p.y += p.vy;

      /* 画面端で跳ね返る */
      if (p.x < 0 || p.x > width) p.vx *= -1;
      if (p.y < 0 || p.y > height) p.vy *= -1;

      /* 範囲内に収める */
      p.x = Math.max(0, Math.min(width, p.x));
      p.y = Math.max(0, Math.min(height, p.y));
    }
  }

  /* 描画 */
  function draw() {
    ctx.clearRect(0, 0, width, height);

    const { r, g, b } = CONFIG.color;

    /* パーティクル間の線を描画 */
    for (let i = 0; i < particles.length; i++) {
      for (let j = i + 1; j < particles.length; j++) {
        const dx = particles[i].x - particles[j].x;
        const dy = particles[i].y - particles[j].y;
        const dist = Math.sqrt(dx * dx + dy * dy);

        if (dist < CONFIG.connectionDist) {
          const opacity = (1 - dist / CONFIG.connectionDist) * 0.35;
          ctx.beginPath();
          ctx.moveTo(particles[i].x, particles[i].y);
          ctx.lineTo(particles[j].x, particles[j].y);
          ctx.strokeStyle = `rgba(${r}, ${g}, ${b}, ${opacity})`;
          ctx.lineWidth = CONFIG.lineWidth;
          ctx.stroke();
        }
      }
    }

    /* マウスとパーティクルの線を描画 */
    for (const p of particles) {
      const dx = mouse.x - p.x;
      const dy = mouse.y - p.y;
      const dist = Math.sqrt(dx * dx + dy * dy);

      if (dist < CONFIG.mouseDist) {
        const opacity = (1 - dist / CONFIG.mouseDist) * 0.5;
        ctx.beginPath();
        ctx.moveTo(p.x, p.y);
        ctx.lineTo(mouse.x, mouse.y);
        ctx.strokeStyle = `rgba(${r}, ${g}, ${b}, ${opacity})`;
        ctx.lineWidth = CONFIG.lineWidth * 1.2;
        ctx.stroke();
      }
    }

    /* ノード（点）を描画 */
    for (const p of particles) {
      ctx.beginPath();
      ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
      ctx.fillStyle = `rgba(${r}, ${g}, ${b}, 0.6)`;
      ctx.fill();
    }
  }

  /* アニメーションループ */
  function animate() {
    updateParticles();
    draw();
    animationId = requestAnimationFrame(animate);
  }

  /* マウス追従 */
  function handleMouseMove(e) {
    const rect = canvas.getBoundingClientRect();
    mouse.x = e.clientX - rect.left;
    mouse.y = e.clientY - rect.top;
  }

  function handleMouseLeave() {
    mouse.x = -9999;
    mouse.y = -9999;
  }

  /* リサイズ処理（デバウンス付き） */
  let resizeTimer;
  function handleResize() {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => {
      resize();
      createParticles();
    }, 200);
  }

  /* 初期化 */
  function init() {
    resize();
    createParticles();

    canvas.parentElement.addEventListener('mousemove', handleMouseMove);
    canvas.parentElement.addEventListener('mouseleave', handleMouseLeave);
    window.addEventListener('resize', handleResize);

    animate();
  }

  /* ページ表示/非表示でアニメーション制御（パフォーマンス対策） */
  document.addEventListener('visibilitychange', () => {
    if (document.hidden) {
      cancelAnimationFrame(animationId);
    } else {
      animate();
    }
  });

  init();
})();
