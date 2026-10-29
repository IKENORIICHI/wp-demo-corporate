<?php
/**
 * どのテンプレートにも当てはまらない場合の表示
 */
get_header();
test_inc_page_header( is_404() ? 'ページが見つかりません' : get_the_archive_title(), is_404() ? '404' : 'Archive' );
?>

	<section class="section">
		<div class="container">
			<?php if ( have_posts() && ! is_404() ) : ?>
			<ul class="news-list">
				<?php while ( have_posts() ) : the_post(); ?>
				<li class="news-list__item">
					<a href="<?php the_permalink(); ?>">
						<time class="news-list__date"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></time>
						<span class="news-list__title"><?php the_title(); ?></span>
					</a>
				</li>
				<?php endwhile; ?>
			</ul>
			<?php else : ?>
			<p class="news-list__empty">お探しのページは見つかりませんでした。</p>
			<div style="margin-top: 40px; text-align: center;">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--outline">トップへ戻る</a>
			</div>
			<?php endif; ?>
		</div>
	</section>

<?php
get_footer();
