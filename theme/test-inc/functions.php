<?php
/**
 * テスト株式会社 テーマの機能定義
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ===========================
   テーマの基本設定
   =========================== */
add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	register_nav_menus( array( 'global' => 'グローバルメニュー' ) );
} );

/* ===========================
   CSS・JS の読み込み
   =========================== */
add_action( 'wp_enqueue_scripts', function () {
	$ver = wp_get_theme()->get( 'Version' );
	wp_enqueue_style( 'test-inc', get_template_directory_uri() . '/assets/css/style.css', array(), $ver );
	wp_enqueue_script( 'test-inc-main', get_template_directory_uri() . '/assets/js/main.js', array(), $ver, true );
	if ( is_front_page() ) {
		wp_enqueue_script( 'test-inc-hero', get_template_directory_uri() . '/assets/js/hero-canvas.js', array(), $ver, true );
	}
} );

/* ===========================
   カスタム投稿タイプ
   - case：導入実績（管理画面から追加・編集できる）
   - inquiry：お問い合わせ（フォーム送信内容を保存。非公開）
   =========================== */
add_action( 'init', function () {
	register_post_type( 'case', array(
		'labels'       => array(
			'name'          => '導入実績',
			'singular_name' => '導入実績',
			'add_new_item'  => '導入実績を追加',
			'edit_item'     => '導入実績を編集',
		),
		'public'       => true,
		'has_archive'  => 'achievements',
		'rewrite'      => array( 'slug' => 'achievements' ),
		'menu_icon'    => 'dashicons-chart-bar',
		'menu_position'=> 5,
		'supports'     => array( 'title', 'excerpt', 'thumbnail', 'page-attributes' ),
		'show_in_rest' => true,
	) );

	register_post_type( 'inquiry', array(
		'labels'          => array(
			'name'          => 'お問い合わせ',
			'singular_name' => 'お問い合わせ',
		),
		'public'          => false,
		'show_ui'         => true,
		'menu_icon'       => 'dashicons-email',
		'menu_position'   => 6,
		'supports'        => array( 'title', 'editor' ),
		'capability_type' => 'post',
		'capabilities'    => array( 'create_posts' => 'do_not_allow' ),
		'map_meta_cap'    => true,
	) );
} );

/* 実績一覧は並び順（page-attributes の「順序」）で表示する */
add_action( 'pre_get_posts', function ( $q ) {
	if ( ! is_admin() && $q->is_main_query() && $q->is_post_type_archive( 'case' ) ) {
		$q->set( 'orderby', array( 'menu_order' => 'ASC', 'date' => 'DESC' ) );
		$q->set( 'posts_per_page', 12 );
	}
} );

/* ===========================
   導入実績の入力欄（メタボックス）
   プラグインなしで「業種・課題・導入内容・成果」を入力できるようにする
   =========================== */
function test_inc_case_fields() {
	return array(
		'case_tag'       => array( '業種', 'text' ),
		'case_client'    => array( '企業名（一覧カード用）', 'text' ),
		'case_challenge' => array( '課題', 'textarea' ),
		'case_solution'  => array( '導入内容', 'textarea' ),
		'case_results'   => array( '成果（1行に「数値|ラベル」。例：30%|廃棄ロス削減）', 'textarea' ),
	);
}

add_action( 'add_meta_boxes', function () {
	add_meta_box( 'test_inc_case', '実績の内容', function ( $post ) {
		wp_nonce_field( 'test_inc_case_save', 'test_inc_case_nonce' );
		echo '<table class="form-table">';
		foreach ( test_inc_case_fields() as $key => list( $label, $type ) ) {
			$value = get_post_meta( $post->ID, $key, true );
			echo '<tr><th><label for="' . esc_attr( $key ) . '">' . esc_html( $label ) . '</label></th><td>';
			if ( 'textarea' === $type ) {
				echo '<textarea class="large-text" rows="4" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '">' . esc_textarea( $value ) . '</textarea>';
			} else {
				echo '<input class="regular-text" type="text" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" value="' . esc_attr( $value ) . '">';
			}
			echo '</td></tr>';
		}
		echo '</table>';
	}, 'case', 'normal', 'high' );
} );

add_action( 'save_post_case', function ( $post_id ) {
	if ( ! isset( $_POST['test_inc_case_nonce'] ) || ! wp_verify_nonce( $_POST['test_inc_case_nonce'], 'test_inc_case_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	foreach ( test_inc_case_fields() as $key => list( , $type ) ) {
		if ( isset( $_POST[ $key ] ) ) {
			$raw = wp_unslash( $_POST[ $key ] );
			update_post_meta( $post_id, $key, 'textarea' === $type ? sanitize_textarea_field( $raw ) : sanitize_text_field( $raw ) );
		}
	}
} );

/* 成果欄を「数値|ラベル」の配列に変換する */
function test_inc_case_results( $post_id ) {
	$lines   = preg_split( '/\r\n|\r|\n/', (string) get_post_meta( $post_id, 'case_results', true ) );
	$results = array();
	foreach ( $lines as $line ) {
		$parts = array_map( 'trim', explode( '|', $line, 2 ) );
		if ( '' !== $parts[0] ) {
			$results[] = array( 'value' => $parts[0], 'label' => isset( $parts[1] ) ? $parts[1] : '' );
		}
	}
	return $results;
}

/* ===========================
   お問い合わせフォームの送信処理
   送信内容は管理画面の「お問い合わせ」に保存し、管理者にメール通知する
   =========================== */
function test_inc_contact_types() {
	return array(
		'demo'     => 'デモのご依頼',
		'estimate' => 'お見積もり',
		'question' => '製品に関するご質問',
		'other'    => 'その他',
	);
}

function test_inc_handle_contact() {
	$back = wp_get_referer() ? wp_get_referer() : home_url( '/contact/' );
	$back = remove_query_arg( 'sent', $back );

	if ( ! isset( $_POST['test_inc_contact_nonce'] ) || ! wp_verify_nonce( $_POST['test_inc_contact_nonce'], 'test_inc_contact' ) ) {
		wp_safe_redirect( add_query_arg( 'sent', 'error', $back ) );
		exit;
	}
	/* スパム対策：人には見えない欄に入力があれば破棄 */
	if ( ! empty( $_POST['website'] ) ) {
		wp_safe_redirect( add_query_arg( 'sent', 'ok', $back ) );
		exit;
	}

	$types   = test_inc_contact_types();
	$type    = isset( $_POST['type'] ) ? sanitize_key( $_POST['type'] ) : '';
	$company = sanitize_text_field( wp_unslash( $_POST['company'] ?? '' ) );
	$name    = sanitize_text_field( wp_unslash( $_POST['your_name'] ?? '' ) );
	$email   = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
	$tel     = sanitize_text_field( wp_unslash( $_POST['tel'] ?? '' ) );
	$message = sanitize_textarea_field( wp_unslash( $_POST['message'] ?? '' ) );

	if ( ! isset( $types[ $type ] ) || '' === $company || '' === $name || ! is_email( $email ) || '' === $message ) {
		wp_safe_redirect( add_query_arg( 'sent', 'invalid', $back ) );
		exit;
	}

	$body = "種別：{$types[ $type ]}\n会社名：{$company}\nお名前：{$name}\nメール：{$email}\n電話：{$tel}\n\n{$message}";

	wp_insert_post( array(
		'post_type'    => 'inquiry',
		'post_status'  => 'private',
		'post_title'   => sprintf( '【%s】%s %s 様', $types[ $type ], $company, $name ),
		'post_content' => $body,
	) );

	wp_mail(
		get_option( 'admin_email' ),
		'[' . get_bloginfo( 'name' ) . '] お問い合わせがありました',
		$body,
		array( 'Reply-To: ' . $name . ' <' . $email . '>' )
	);

	wp_safe_redirect( add_query_arg( 'sent', 'ok', $back ) );
	exit;
}
add_action( 'admin_post_nopriv_test_inc_contact', 'test_inc_handle_contact' );
add_action( 'admin_post_test_inc_contact', 'test_inc_handle_contact' );

/* ===========================
   メニュー未設定時の代わりのリンク
   =========================== */
function test_inc_fallback_menu() {
	$links = array(
		'/company/'      => '会社概要',
		'/service/'      => '事業内容',
		'/achievements/' => '実績',
		'/news/'         => 'お知らせ',
		'/contact/'      => 'お問い合わせ',
	);
	foreach ( $links as $path => $label ) {
		echo '<a href="' . esc_url( home_url( $path ) ) . '">' . esc_html( $label ) . '</a>';
	}
}

/* ヘッダー・モバイルメニュー共通の出力（a タグだけを並べる） */
function test_inc_nav() {
	if ( has_nav_menu( 'global' ) ) {
		echo strip_tags( wp_nav_menu( array(
			'theme_location' => 'global',
			'container'      => false,
			'echo'           => false,
			'depth'          => 1,
		) ), '<a>' );
	} else {
		test_inc_fallback_menu();
	}
}

/* CTA ブロック（各ページ共通） */
function test_inc_cta( $title = 'まずはお気軽にご相談ください', $text = 'データ活用に関するご質問やデモのご依頼など、お気軽にお問い合わせください。' ) {
	?>
	<section class="cta fade-in">
		<div class="container">
			<h2 class="cta__title"><?php echo esc_html( $title ); ?></h2>
			<p class="cta__text"><?php echo esc_html( $text ); ?></p>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--primary">
				お問い合わせ
				<span class="btn__arrow">→</span>
			</a>
		</div>
	</section>
	<?php
}

/* 下層ページの見出し */
function test_inc_page_header( $title, $sub ) {
	?>
	<div class="page-header">
		<div class="container">
			<h1 class="page-header__title"><?php echo esc_html( $title ); ?></h1>
			<p class="page-header__sub"><?php echo esc_html( $sub ); ?></p>
		</div>
	</div>
	<?php
}
