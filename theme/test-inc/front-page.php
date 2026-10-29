<?php
/**
 * トップページ
 */
get_header();
?>

  <!-- ヒーロー -->
  <section class="hero">
    <div class="hero__bg"></div>
    <canvas id="heroCanvas"></canvas>
    <div class="hero__content">
      <span class="hero__label">AI × Data Analytics</span>
      <h1 class="hero__title">データの力で、<br><span>未来を拓く。</span></h1>
      <p class="hero__desc">
        テスト株式会社は、AI・機械学習を活用したデータ分析基盤を提供し、<br>
        企業のデータドリブンな意思決定を支援します。
      </p>
      <div style="display: flex; gap: 16px; flex-wrap: wrap;">
        <a href="<?php echo esc_url( home_url( '/service/' ) ); ?>" class="btn btn--primary">
          事業内容を見る
          <span class="btn__arrow">→</span>
        </a>
        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--outline">お問い合わせ</a>
      </div>
    </div>
  </section>

  <!-- サービス紹介 -->
  <section class="section">
    <div class="container">
      <div class="section__header section__header--center fade-in">
        <span class="section__label">Service</span>
        <h2 class="section__title">AIで、データの価値を最大化する</h2>
        <p class="section__subtitle">
          高度な機械学習アルゴリズムと直感的なインターフェースで、
          あらゆるデータから価値あるインサイトを引き出します。
        </p>
      </div>
      <div class="cards fade-in">
        <div class="card">
          <div class="card__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
          </div>
          <h3 class="card__title">データ統合基盤</h3>
          <p class="card__text">分散したデータソースを一元管理。リアルタイムでのデータ収集・変換・統合を実現します。</p>
        </div>
        <div class="card">
          <div class="card__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20V10"/><path d="M18 20V4"/><path d="M6 20v-4"/></svg>
          </div>
          <h3 class="card__title">AI分析エンジン</h3>
          <p class="card__text">最新の深層学習モデルを搭載。予測分析・異常検知・自然言語処理を高精度で提供します。</p>
        </div>
        <div class="card">
          <div class="card__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
          </div>
          <h3 class="card__title">ダッシュボード</h3>
          <p class="card__text">直感的なビジュアライゼーションで、分析結果をわかりやすく可視化。迅速な意思決定を支えます。</p>
        </div>
      </div>
    </div>
  </section>

  <!-- 数字で見る実績 -->
  <section class="section section--gray">
    <div class="container">
      <div class="section__header section__header--center fade-in">
        <span class="section__label">Achievements</span>
        <h2 class="section__title">数字で見るテスト株式会社</h2>
      </div>
      <div class="numbers fade-in">
        <div class="numbers__item">
          <div class="numbers__value">150+</div>
          <div class="numbers__label">導入企業数</div>
        </div>
        <div class="numbers__item">
          <div class="numbers__value">99.9%</div>
          <div class="numbers__label">稼働率</div>
        </div>
        <div class="numbers__item">
          <div class="numbers__value">10億+</div>
          <div class="numbers__label">処理データ件数 / 月</div>
        </div>
        <div class="numbers__item">
          <div class="numbers__value">50+</div>
          <div class="numbers__label">AIモデル数</div>
        </div>
      </div>
    </div>
  </section>

  <!-- 導入実績（管理画面の「導入実績」から最新3件を表示） -->
  <section class="section">
    <div class="container">
      <div class="section__header section__header--center fade-in">
        <span class="section__label">Achievements</span>
        <h2 class="section__title">導入実績</h2>
        <p class="section__subtitle">業界を問わず、多くの企業様のデータ活用を支援しています。</p>
      </div>
      <?php
      $cases = new WP_Query( array(
        'post_type'      => 'case',
        'posts_per_page' => 3,
        'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
      ) );
      if ( $cases->have_posts() ) :
      ?>
      <div class="cards fade-in">
        <?php while ( $cases->have_posts() ) : $cases->the_post(); ?>
        <a class="card card--link" href="<?php the_permalink(); ?>">
          <span class="case__tag"><?php echo esc_html( get_post_meta( get_the_ID(), 'case_tag', true ) ); ?></span>
          <h3 class="card__title"><?php echo esc_html( get_post_meta( get_the_ID(), 'case_client', true ) ?: get_the_title() ); ?></h3>
          <p class="card__text"><?php echo esc_html( get_the_excerpt() ); ?></p>
        </a>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>
      <?php endif; ?>
      <div style="margin-top: 40px; text-align: center;" class="fade-in">
        <a href="<?php echo esc_url( get_post_type_archive_link( 'case' ) ); ?>" class="btn btn--outline">
          実績一覧
          <span class="btn__arrow">→</span>
        </a>
      </div>
    </div>
  </section>

  <!-- お知らせ（通常の投稿から最新3件） -->
  <section class="section section--gray">
    <div class="container">
      <div class="section__header section__header--center fade-in">
        <span class="section__label">News</span>
        <h2 class="section__title">お知らせ</h2>
      </div>
      <?php
      $news = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 3, 'ignore_sticky_posts' => true ) );
      if ( $news->have_posts() ) :
      ?>
      <ul class="news-list fade-in">
        <?php while ( $news->have_posts() ) : $news->the_post(); ?>
        <li class="news-list__item">
          <a href="<?php the_permalink(); ?>">
            <time class="news-list__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></time>
            <span class="news-list__title"><?php the_title(); ?></span>
          </a>
        </li>
        <?php endwhile; wp_reset_postdata(); ?>
      </ul>
      <?php else : ?>
      <p class="news-list__empty">お知らせはまだありません。</p>
      <?php endif; ?>
      <div style="margin-top: 40px; text-align: center;" class="fade-in">
        <a href="<?php echo esc_url( home_url( '/news/' ) ); ?>" class="btn btn--outline">
          お知らせ一覧
          <span class="btn__arrow">→</span>
        </a>
      </div>
    </div>
  </section>

<?php
test_inc_cta();
get_footer();
