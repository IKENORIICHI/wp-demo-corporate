<?php
/**
 * お問い合わせページ（スラッグ：contact）
 * 送信内容は functions.php の test_inc_handle_contact() で処理する
 */
get_header();
test_inc_page_header( 'お問い合わせ', 'Contact' );

$sent     = isset( $_GET['sent'] ) ? sanitize_key( $_GET['sent'] ) : '';
$messages = array(
	'ok'      => array( 'success', 'お問い合わせありがとうございます。内容を確認のうえ、担当者よりご連絡いたします。' ),
	'invalid' => array( 'error', '必須項目が未入力、またはメールアドレスの形式が正しくありません。' ),
	'error'   => array( 'error', '送信に失敗しました。お手数ですが、もう一度お試しください。' ),
);
?>

	<!-- フォーム -->
	<section class="section">
		<div class="container">
			<div class="section__header section__header--center fade-in">
				<span class="section__label">Get in Touch</span>
				<h2 class="section__title">お気軽にご相談ください</h2>
				<p class="section__subtitle">製品のデモや導入に関するご質問など、以下のフォームよりお問い合わせください。</p>
			</div>

			<?php if ( isset( $messages[ $sent ] ) ) : ?>
			<p class="form__notice form__notice--<?php echo esc_attr( $messages[ $sent ][0] ); ?>"><?php echo esc_html( $messages[ $sent ][1] ); ?></p>
			<?php endif; ?>

			<form class="form fade-in" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
				<input type="hidden" name="action" value="test_inc_contact">
				<?php wp_nonce_field( 'test_inc_contact', 'test_inc_contact_nonce' ); ?>
				<div class="form__hp" aria-hidden="true">
					<label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
				</div>
				<div class="form__group">
					<label class="form__label" for="type">
						お問い合わせ種別<span class="required">*</span>
					</label>
					<select class="form__select" id="type" name="type" required>
						<option value="" disabled selected>選択してください</option>
						<?php foreach ( test_inc_contact_types() as $value => $label ) : ?>
						<option value="<?php echo esc_attr( $value ); ?>"><?php echo esc_html( $label ); ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form__group">
					<label class="form__label" for="company">
						会社名<span class="required">*</span>
					</label>
					<input type="text" class="form__input" id="company" name="company" placeholder="例：テスト株式会社" required>
				</div>
				<div class="form__group">
					<label class="form__label" for="your_name">
						お名前<span class="required">*</span>
					</label>
					<input type="text" class="form__input" id="your_name" name="your_name" placeholder="例：山田 太郎" required>
				</div>
				<div class="form__group">
					<label class="form__label" for="email">
						メールアドレス<span class="required">*</span>
					</label>
					<input type="email" class="form__input" id="email" name="email" placeholder="例：yamada@example.com" required>
				</div>
				<div class="form__group">
					<label class="form__label" for="tel">
						電話番号
					</label>
					<input type="tel" class="form__input" id="tel" name="tel" placeholder="例：03-1234-5678">
				</div>
				<div class="form__group">
					<label class="form__label" for="message">
						お問い合わせ内容<span class="required">*</span>
					</label>
					<textarea class="form__textarea" id="message" name="message" placeholder="お問い合わせ内容をご記入ください" required></textarea>
				</div>
				<div class="form__submit">
					<button type="submit" class="btn btn--primary">
						送信する
						<span class="btn__arrow">→</span>
					</button>
				</div>
			</form>
		</div>
	</section>

<?php
get_footer();
