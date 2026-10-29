<?php
/**
 * 固定ページの共通テンプレート（専用テンプレートがないページ用）
 * 本文はブロックエディタで自由に編集できる
 */
get_header();
while ( have_posts() ) :
	the_post();
	test_inc_page_header( get_the_title(), strtoupper( get_post_field( 'post_name' ) ) );
	?>
	<section class="section">
		<div class="container">
			<div class="entry__content">
				<?php the_content(); ?>
			</div>
		</div>
	</section>
	<?php
endwhile;
get_footer();
