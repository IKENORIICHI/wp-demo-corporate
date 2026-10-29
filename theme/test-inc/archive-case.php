<?php
/**
 * 導入実績一覧（/achievements/）
 */
get_header();
test_inc_page_header( '導入実績', 'Achievements' );
?>

	<!-- 実績一覧 -->
	<section class="section">
		<div class="container">
			<div class="section__header section__header--center fade-in">
				<span class="section__label">Case Studies</span>
				<h2 class="section__title">お客様の成果</h2>
				<p class="section__subtitle">AI データ分析基盤の導入により、多くの企業様がビジネス成果を実現しています。</p>
			</div>

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/case' ); ?>
			<?php endwhile; ?>

			<?php the_posts_pagination(); ?>
		</div>
	</section>

<?php
test_inc_cta( '御社でも成果を出しませんか？', 'PoCの実施やデモのご依頼など、まずはお気軽にお問い合わせください。' );
get_footer();
