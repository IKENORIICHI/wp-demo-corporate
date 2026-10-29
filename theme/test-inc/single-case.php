<?php
/**
 * 導入実績の詳細
 */
get_header();
test_inc_page_header( '導入実績', 'Case Study' );
?>

	<section class="section">
		<div class="container">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/case' ); ?>
			<?php endwhile; ?>
			<div style="margin-top: 40px; text-align: center;">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'case' ) ); ?>" class="btn btn--outline">実績一覧へ戻る</a>
			</div>
		</div>
	</section>

<?php
test_inc_cta( '御社でも成果を出しませんか？', 'PoCの実施やデモのご依頼など、まずはお気軽にお問い合わせください。' );
get_footer();
