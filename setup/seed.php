<?php
/**
 * デモ用の初期データ投入（ページ・実績・お知らせ・メニュー・表示設定）
 * WordPress Playground の blueprint から実行する
 */
require_once '/wordpress/wp-load.php';

update_option( 'blogname', 'テスト株式会社' );
update_option( 'blogdescription', 'AI × データ分析で未来を拓く' );
update_option( 'timezone_string', 'Asia/Tokyo' );
update_option( 'date_format', 'Y年n月j日' );
update_option( 'permalink_structure', '/%postname%/' );

/* 既定のサンプル投稿・ページを削除 */
foreach ( get_posts( array( 'post_type' => array( 'post', 'page' ), 'numberposts' => -1, 'post_status' => 'any' ) ) as $p ) {
	wp_delete_post( $p->ID, true );
}

/* 固定ページ */
$pages = array(
	'home'    => 'トップ',
	'company' => '会社概要',
	'service' => '事業内容',
	'news'    => 'お知らせ',
	'contact' => 'お問い合わせ',
);
$ids = array();
foreach ( $pages as $slug => $title ) {
	$ids[ $slug ] = wp_insert_post( array(
		'post_type'   => 'page',
		'post_status' => 'publish',
		'post_name'   => $slug,
		'post_title'  => $title,
	) );
}
update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $ids['home'] );
update_option( 'page_for_posts', $ids['news'] );

/* 導入実績（カスタム投稿タイプ case） */
$cases = array(
	array(
		'title'     => '大手小売チェーン A社 — 需要予測AIで廃棄ロス30%削減',
		'client'    => '大手小売チェーン A社',
		'tag'       => '小売業',
		'excerpt'   => '需要予測AIの導入により、在庫最適化を実現。食品廃棄ロスを30%削減し、年間数億円のコスト削減に貢献。',
		'challenge' => '全国500店舗の在庫管理が属人的で、食品廃棄ロスと機会損失が年間数十億円規模で発生していた。',
		'solution'  => 'POSデータ・天候・イベント情報を統合し、商品カテゴリごとの需要を日次で予測するAIモデルを構築。ダッシュボードで店舗別の発注推奨量をリアルタイム配信。',
		'results'   => "30%|廃棄ロス削減\n15%|機会損失削減\n3ヶ月|導入期間",
	),
	array(
		'title'     => '製造メーカー B社 — 設備異常検知で稼働停止時間50%削減',
		'client'    => '製造メーカー B社',
		'tag'       => '製造業',
		'excerpt'   => 'IoTセンサーデータのリアルタイム異常検知により、設備の予防保全を実現。稼働停止時間を50%削減。',
		'challenge' => '製造ライン設備の突発故障による計画外停止が頻発し、納期遅延と修理コストが経営課題となっていた。',
		'solution'  => 'IoTセンサーから振動・温度・電流データを収集し、異常パターンをAIがリアルタイム検知。故障の予兆を最大72時間前に通知するアラートシステムを構築。',
		'results'   => "50%|稼働停止時間削減\n40%|修理コスト削減\n72h|事前予知",
	),
	array(
		'title'     => '金融機関 C社 — 顧客分析AIで継続率15%向上',
		'client'    => '金融機関 C社',
		'tag'       => '金融業',
		'excerpt'   => '顧客行動分析AIで離脱予測とパーソナライズ施策を自動化。顧客継続率が15%向上し、LTV最大化を実現。',
		'challenge' => '顧客の解約率が業界平均を上回っており、解約予兆の把握と効果的なリテンション施策の立案が急務だった。',
		'solution'  => '取引履歴・アプリ利用ログ・問い合わせ履歴を統合分析し、解約リスクスコアを算出。スコアに基づくパーソナライズドオファーを自動配信する仕組みを構築。',
		'results'   => "15%|継続率向上\n2.3倍|施策反応率\n年1.2億|収益改善",
	),
);
foreach ( $cases as $i => $c ) {
	$id = wp_insert_post( array(
		'post_type'    => 'case',
		'post_status'  => 'publish',
		'post_title'   => $c['title'],
		'post_excerpt' => $c['excerpt'],
		'menu_order'   => $i,
	) );
	update_post_meta( $id, 'case_client', $c['client'] );
	update_post_meta( $id, 'case_tag', $c['tag'] );
	update_post_meta( $id, 'case_challenge', $c['challenge'] );
	update_post_meta( $id, 'case_solution', $c['solution'] );
	update_post_meta( $id, 'case_results', $c['results'] );
}

/* お知らせ（通常の投稿） */
$news = array(
	array( '2026-10-20 10:00:00', '年末年始休業のお知らせ', '<!-- wp:paragraph --><p>誠に勝手ながら、12月28日（月）〜1月4日（月）を年末年始休業とさせていただきます。休業期間中のお問い合わせは、1月5日（火）以降に順次ご対応いたします。</p><!-- /wp:paragraph -->' ),
	array( '2026-10-01 10:00:00', 'AIダッシュボードに新機能「異常値アラート」を追加しました', '<!-- wp:paragraph --><p>ダッシュボード上で設定したしきい値を超えた場合に、メールとチャットで通知する機能を追加しました。詳しくは事業内容ページをご覧ください。</p><!-- /wp:paragraph -->' ),
	array( '2026-09-15 10:00:00', 'オンラインセミナー「はじめてのデータ活用」を開催します', '<!-- wp:paragraph --><p>データ活用をこれから始める企業様向けに、無料のオンラインセミナーを開催します。お申し込みはお問い合わせフォームより承ります。</p><!-- /wp:paragraph -->' ),
);
foreach ( $news as list( $date, $title, $content ) ) {
	wp_insert_post( array(
		'post_type'    => 'post',
		'post_status'  => 'publish',
		'post_date'    => $date,
		'post_title'   => $title,
		'post_content' => $content,
	) );
}

/* グローバルメニュー */
$menu_id = wp_create_nav_menu( 'グローバルメニュー' );
$items   = array(
	array( 'page', $ids['company'], '会社概要' ),
	array( 'page', $ids['service'], '事業内容' ),
	array( 'archive', 0, '実績' ),
	array( 'page', $ids['news'], 'お知らせ' ),
	array( 'page', $ids['contact'], 'お問い合わせ' ),
);
foreach ( $items as $pos => list( $kind, $object_id, $label ) ) {
	$args = array(
		'menu-item-title'    => $label,
		'menu-item-status'   => 'publish',
		'menu-item-position' => $pos + 1,
	);
	if ( 'page' === $kind ) {
		$args += array( 'menu-item-type' => 'post_type', 'menu-item-object' => 'page', 'menu-item-object-id' => $object_id );
	} else {
		$args += array( 'menu-item-type' => 'post_type_archive', 'menu-item-object' => 'case' );
	}
	wp_update_nav_menu_item( $menu_id, 0, $args );
}
set_theme_mod( 'nav_menu_locations', array( 'global' => $menu_id ) );

flush_rewrite_rules();
