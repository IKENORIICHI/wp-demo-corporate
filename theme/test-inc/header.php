<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

	<!-- ヘッダー -->
	<header class="header">
		<div class="header__inner">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header__logo"><span>TEST</span> Inc.</a>
			<nav class="header__nav">
				<?php test_inc_nav(); ?>
			</nav>
			<button class="hamburger" aria-label="メニュー">
				<span></span>
				<span></span>
				<span></span>
			</button>
		</div>
	</header>

	<!-- モバイルメニュー -->
	<nav class="mobile-menu">
		<?php test_inc_nav(); ?>
	</nav>
