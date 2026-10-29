# テスト株式会社 WordPress テーマ（制作サンプル）

静的HTMLのコーポレートサイト（my-hp）を、WordPress のオリジナルテーマに作り替えたデモ。会社名・数値・実績はすべて架空。

## できること

- トップ・会社概要・事業内容・導入実績・お知らせ・お問い合わせ の6ページ構成
- **導入実績**はカスタム投稿タイプ。管理画面で「業種・課題・導入内容・成果」を入力すると、一覧・詳細・トップに反映される（プラグイン不要）
- **お知らせ**は通常の投稿。トップに最新3件を表示
- **お問い合わせフォーム**はテーマ内で実装（nonce・スパム対策の隠し欄つき）。送信内容は管理画面の「お問い合わせ」に保存し、管理者へメール通知
- メニューは「外観 → メニュー」から編集可能
- スマホ対応

## ローカルで動かす

```bash
npx @wp-playground/cli@3.1.61 server --port=9400 \
  --mount=./theme/test-inc:/wordpress/wp-content/themes/test-inc \
  --mount=./setup:/wordpress/setup \
  --blueprint=./blueprint.local.json
```

http://127.0.0.1:9400 で表示。管理画面は /wp-admin/（自動ログイン）。

## 構成

- `theme/test-inc/` … テーマ本体
- `setup/seed.php` … デモ用の初期データ（ページ・実績・お知らせ・メニュー）
- `blueprint.local.json` … WordPress Playground の起動設定
