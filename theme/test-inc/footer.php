	<!-- フッター -->
	<footer class="footer">
		<div class="container">
			<div class="footer__inner">
				<div>
					<div class="footer__logo"><span>TEST</span> Inc.</div>
					<p class="footer__desc">AI・機械学習を活用したデータ分析基盤で、<br>企業のDXを推進します。</p>
				</div>
				<div class="footer__links">
					<div>
						<div class="footer__links-title">Company</div>
						<ul>
							<li><a href="<?php echo esc_url( home_url( '/company/' ) ); ?>">会社概要</a></li>
							<li><a href="<?php echo esc_url( home_url( '/achievements/' ) ); ?>">実績</a></li>
							<li><a href="<?php echo esc_url( home_url( '/news/' ) ); ?>">お知らせ</a></li>
						</ul>
					</div>
					<div>
						<div class="footer__links-title">Service</div>
						<ul>
							<li><a href="<?php echo esc_url( home_url( '/service/' ) ); ?>">事業内容</a></li>
						</ul>
					</div>
					<div>
						<div class="footer__links-title">Contact</div>
						<ul>
							<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">お問い合わせ</a></li>
						</ul>
					</div>
				</div>
			</div>
			<p class="footer__demo">※このサイトは WordPress の制作サンプル（デモ）です。会社名・数値・実績はすべて架空のものです。</p>
			<div class="footer__bottom">
				&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> テスト株式会社 All Rights Reserved.
			</div>
		</div>
	</footer>

<?php wp_footer(); ?>
</body>
</html>
