<?php
/**
 * 事業内容ページ（スラッグ：service）
 */
get_header();
?>


  <!-- ページヘッダー -->
  <div class="page-header">
    <div class="container">
      <h1 class="page-header__title">事業内容</h1>
      <p class="page-header__sub">Service</p>
    </div>
  </div>

  <!-- サービス概要 -->
  <section class="section">
    <div class="container">
      <div class="section__header section__header--center fade-in">
        <span class="section__label">Data Analytics Platform</span>
        <h2 class="section__title">AIデータ分析基盤</h2>
        <p class="section__subtitle">
          企業が保有するあらゆるデータを統合・分析し、
          ビジネスに直結するインサイトを提供するクラウドプラットフォームです。
        </p>
      </div>
      <div class="feature-grid fade-in">
        <div class="feature-card">
          <div class="feature-card__number">01</div>
          <h3 class="feature-card__title">データ統合・ETL</h3>
          <p class="feature-card__text">
            様々なデータソース（DB、API、ファイル）からデータを自動収集。
            クレンジング・変換処理をノーコードで設定でき、
            データパイプラインの構築を大幅に効率化します。
          </p>
        </div>
        <div class="feature-card">
          <div class="feature-card__number">02</div>
          <h3 class="feature-card__title">AI予測分析</h3>
          <p class="feature-card__text">
            独自の機械学習エンジンにより、需要予測・離脱予測・異常検知などを自動化。
            専門知識がなくても高精度なAIモデルを構築・運用できます。
          </p>
        </div>
        <div class="feature-card">
          <div class="feature-card__number">03</div>
          <h3 class="feature-card__title">リアルタイムダッシュボード</h3>
          <p class="feature-card__text">
            分析結果をリアルタイムで可視化するダッシュボード機能を搭載。
            KPI管理やレポート作成を効率化し、
            データに基づいた迅速な意思決定を支援します。
          </p>
        </div>
        <div class="feature-card">
          <div class="feature-card__number">04</div>
          <h3 class="feature-card__title">セキュリティ & ガバナンス</h3>
          <p class="feature-card__text">
            エンタープライズグレードのセキュリティ基盤。
            データアクセス制御・監査ログ・暗号化に対応し、
            安心してデータ活用を推進できます。
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- 導入フロー -->
  <section class="section section--gray">
    <div class="container">
      <div class="section__header section__header--center fade-in">
        <span class="section__label">Flow</span>
        <h2 class="section__title">導入の流れ</h2>
      </div>
      <div class="flow fade-in">
        <div class="flow__step">
          <div class="flow__number">1</div>
          <div class="flow__title">ヒアリング</div>
          <div class="flow__text">課題・要件の<br>整理</div>
        </div>
        <div class="flow__step">
          <div class="flow__number">2</div>
          <div class="flow__title">PoC</div>
          <div class="flow__text">データ検証・<br>効果測定</div>
        </div>
        <div class="flow__step">
          <div class="flow__number">3</div>
          <div class="flow__title">構築</div>
          <div class="flow__text">環境構築・<br>データ連携</div>
        </div>
        <div class="flow__step">
          <div class="flow__number">4</div>
          <div class="flow__title">運用</div>
          <div class="flow__text">本番稼働・<br>継続改善</div>
        </div>
      </div>
    </div>
  </section>

  <!-- 活用事例 -->
  <section class="section">
    <div class="container">
      <div class="section__header section__header--center fade-in">
        <span class="section__label">Use Cases</span>
        <h2 class="section__title">活用事例</h2>
      </div>
      <div class="cards fade-in">
        <div class="card">
          <div class="card__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
          </div>
          <h3 class="card__title">小売業 - 需要予測</h3>
          <p class="card__text">過去の販売データとAI分析により、商品ごとの需要を高精度に予測。在庫の最適化で廃棄ロスを30%削減。</p>
        </div>
        <div class="card">
          <div class="card__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
          </div>
          <h3 class="card__title">製造業 - 異常検知</h3>
          <p class="card__text">IoTセンサーデータをリアルタイム分析し、設備の異常を早期検知。予防保全により稼働停止時間を50%削減。</p>
        </div>
        <div class="card">
          <div class="card__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          </div>
          <h3 class="card__title">金融業 - 顧客分析</h3>
          <p class="card__text">顧客の行動パターンをAIで分析し、離脱予測とパーソナライズ施策を自動化。顧客継続率が15%向上。</p>
        </div>
      </div>
    </div>
  </section>

  <!-- 料金表 -->
  <section class="section section--gray">
    <div class="container">
      <div class="section__header section__header--center fade-in">
        <span class="section__label">Pricing</span>
        <h2 class="section__title">料金プラン</h2>
        <p class="section__subtitle">ビジネスの規模やニーズに合わせた柔軟なプランをご用意しています。</p>
      </div>
      <div class="pricing fade-in">
        <div class="pricing__card">
          <div class="pricing__name">Starter</div>
          <div class="pricing__desc">スモールスタートに最適</div>
          <div class="pricing__price">月額 <strong>30</strong> 万円〜</div>
          <ul class="pricing__features">
            <li>データソース接続 3件まで</li>
            <li>基本ダッシュボード</li>
            <li>メールサポート</li>
            <li>ユーザー数 5名まで</li>
          </ul>
          <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--outline" style="width:100%;justify-content:center;">お問い合わせ</a>
        </div>
        <div class="pricing__card pricing__card--popular">
          <div class="pricing__badge">人気</div>
          <div class="pricing__name">Business</div>
          <div class="pricing__desc">成長企業におすすめ</div>
          <div class="pricing__price">月額 <strong>80</strong> 万円〜</div>
          <ul class="pricing__features">
            <li>データソース接続 無制限</li>
            <li>AI予測分析エンジン</li>
            <li>カスタムダッシュボード</li>
            <li>優先サポート</li>
            <li>ユーザー数 30名まで</li>
          </ul>
          <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--primary" style="width:100%;justify-content:center;">お問い合わせ</a>
        </div>
        <div class="pricing__card">
          <div class="pricing__name">Enterprise</div>
          <div class="pricing__desc">大規模組織向け</div>
          <div class="pricing__price"><strong>個別見積</strong></div>
          <ul class="pricing__features">
            <li>Business の全機能</li>
            <li>オンプレミス対応</li>
            <li>専任カスタマーサクセス</li>
            <li>SLA保証 99.99%</li>
            <li>ユーザー数 無制限</li>
          </ul>
          <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--outline" style="width:100%;justify-content:center;">お問い合わせ</a>
        </div>
      </div>
    </div>
  </section>

<?php
test_inc_cta( '導入のご相談はこちら', 'PoCの実施やデモのご依頼など、まずはお気軽にお問い合わせください。' );
get_footer();
