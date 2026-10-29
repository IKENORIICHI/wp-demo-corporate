<?php
/**
 * お知らせの詳細
 */
get_header();
test_inc_page_header( 'お知らせ', 'News' );
?>

	<section class="section">
		<div class="container">
			<?php while ( have_posts() ) : the_post(); ?>
			<article class="entry">
				<time class="news-list__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></time>
				<h2 class="entry__title"><?php the_title(); ?></h2>
				<div class="entry__content">
					<?php the_content(); ?>
				</div>
			</article>
			<?php endwhile; ?>
			<div style="margin-top: 40px; text-align: center;">
				<a href="<?php echo esc_url( home_url( '/news/' ) ); ?>" class="btn btn--outline">お知らせ一覧へ戻る</a>
			</div>
		</div>
	</section>

<?php
get_footer();
