<?php
/**
 * 会社概要ページ（スラッグ：company）
 */
get_header();
?>


  <!-- ページヘッダー -->
  <div class="page-header">
    <div class="container">
      <h1 class="page-header__title">会社概要</h1>
      <p class="page-header__sub">Company</p>
    </div>
  </div>

  <!-- ミッション・ビジョン -->
  <section class="section">
    <div class="container">
      <div class="section__header section__header--center fade-in">
        <span class="section__label">Philosophy</span>
        <h2 class="section__title">私たちが目指すもの</h2>
      </div>
      <div class="mission-grid fade-in">
        <div class="mission-card">
          <div class="mission-card__label">Mission</div>
          <h3 class="mission-card__title">データの力で、<br>すべての企業に変革を。</h3>
          <p class="mission-card__text">
            私たちは、AI・機械学習の技術を通じて企業が持つデータの潜在価値を最大限に引き出し、
            データドリブンな社会の実現に貢献します。
          </p>
        </div>
        <div class="mission-card">
          <div class="mission-card__label">Vision</div>
          <h3 class="mission-card__title">あらゆるデータが<br>意思決定を導く世界へ。</h3>
          <p class="mission-card__text">
            テクノロジーの力で情報の非対称性をなくし、
            すべての人がデータに基づいた最適な判断を行える未来を創ります。
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- 会社情報テーブル -->
  <section class="section section--gray">
    <div class="container">
      <div class="section__header section__header--center fade-in">
        <span class="section__label">Overview</span>
        <h2 class="section__title">会社情報</h2>
      </div>
      <div class="fade-in">
        <table class="info-table">
          <tr>
            <th>会社名</th>
            <td>テスト株式会社</td>
          </tr>
          <tr>
            <th>設立</th>
            <td>2020年4月</td>
          </tr>
          <tr>
            <th>代表者</th>
            <td>代表取締役 テスト太郎</td>
          </tr>
          <tr>
            <th>所在地</th>
            <td>〒100-0001 東京都千代田区千代田1-1-1</td>
          </tr>
          <tr>
            <th>資本金</th>
            <td>1億円</td>
          </tr>
          <tr>
            <th>従業員数</th>
            <td>80名（2026年4月現在）</td>
          </tr>
          <tr>
            <th>事業内容</th>
            <td>AI・機械学習を活用したデータ分析基盤の開発・提供<br>データコンサルティング</td>
          </tr>
        </table>
      </div>
    </div>
  </section>

<?php
test_inc_cta();
get_footer();
