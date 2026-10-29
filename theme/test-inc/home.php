<?php
/**
 * お知らせ一覧（設定 → 表示設定の「投稿ページ」に指定したページ）
 */
get_header();
test_inc_page_header( 'お知らせ', 'News' );
?>

	<section class="section">
		<div class="container">
			<?php if ( have_posts() ) : ?>
			<ul class="news-list">
				<?php while ( have_posts() ) : the_post(); ?>
				<li class="news-list__item">
					<a href="<?php the_permalink(); ?>">
						<time class="news-list__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></time>
						<span class="news-list__title"><?php the_title(); ?></span>
					</a>
				</li>
				<?php endwhile; ?>
			</ul>
			<?php the_posts_pagination(); ?>
			<?php else : ?>
			<p class="news-list__empty">お知らせはまだありません。</p>
			<?php endif; ?>
		</div>
	</section>

<?php
get_footer();
