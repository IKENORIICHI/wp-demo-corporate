<?php
/**
 * 導入実績 1件分の表示（一覧・詳細で共通）
 */
$post_id = get_the_ID();
$results = test_inc_case_results( $post_id );
?>
<div class="case fade-in">
	<div class="case__header">
		<span class="case__tag"><?php echo esc_html( get_post_meta( $post_id, 'case_tag', true ) ); ?></span>
		<h3 class="case__title">
			<?php if ( is_singular( 'case' ) ) : ?>
				<?php the_title(); ?>
			<?php else : ?>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			<?php endif; ?>
		</h3>
	</div>
	<div class="case__body">
		<div class="case__section">
			<h4 class="case__label">課題</h4>
			<p class="case__text"><?php echo nl2br( esc_html( get_post_meta( $post_id, 'case_challenge', true ) ) ); ?></p>
		</div>
		<div class="case__section">
			<h4 class="case__label">導入内容</h4>
			<p class="case__text"><?php echo nl2br( esc_html( get_post_meta( $post_id, 'case_solution', true ) ) ); ?></p>
		</div>
		<?php if ( $results ) : ?>
		<div class="case__section">
			<h4 class="case__label">成果</h4>
			<div class="case__results">
				<?php foreach ( $results as $r ) : ?>
				<div class="case__result">
					<div class="case__result-value"><?php echo esc_html( $r['value'] ); ?></div>
					<div class="case__result-label"><?php echo esc_html( $r['label'] ); ?></div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php endif; ?>
	</div>
</div>
