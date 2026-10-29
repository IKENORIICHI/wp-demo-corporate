// ローカルで動かしている WordPress（ログインなし）を巡回し、静的HTMLとして書き出す
// 使い方：node scripts/export-static.mjs http://127.0.0.1:9400 static
import fs from "node:fs";
import path from "node:path";

const origin = (process.argv[2] || "http://127.0.0.1:9400").replace(/\/$/, "");
const outDir = process.argv[3] || "static";

// 書き出し対象外（管理画面・API・フィードなど）
const SKIP = /^\/(wp-admin|wp-login\.php|wp-json|xmlrpc\.php|feed|comments\/feed)|\/feed\/?$|[?#]/;

fs.rmSync(outDir, { recursive: true, force: true });

const queue = ["/"];
const seen = new Set();
const assets = new Set();

const toLocal = (html) => html.split(origin).join("");

// お問い合わせフォームは静的サイトでは送れないため、送信ボタンを止めて注記を出す
const disableForm = (html) =>
  html
    .replace(/<form class="form fade-in" method="post" action="[^"]*">/,
      '<p class="form__notice form__notice--error">このページは表示用の書き出し版のため、送信はできません（WordPress上では送信内容が管理画面に保存され、メールで通知されます）。</p>\n<form class="form fade-in" onsubmit="return false;">')
    .replace(/<button type="submit" class="btn btn--primary">/, '<button type="submit" class="btn btn--primary" disabled>');

while (queue.length) {
  const p = queue.shift();
  if (seen.has(p)) continue;
  seen.add(p);
  const res = await fetch(origin + p, { redirect: "follow" });
  if (!res.ok || !(res.headers.get("content-type") || "").includes("text/html")) continue;
  let html = await res.text();

  for (const m of html.matchAll(/(href|src)=(["'])([^"']+)\2/g)) {
    const isLink = m[1] === "href";
    const raw = m[3].replace(/&#038;|&amp;/g, "&");
    if (!raw.startsWith(origin) && !raw.startsWith("/")) continue;
    const u = new URL(raw, origin + "/");
    if (u.origin !== origin) continue;
    if (/\.(css|js|png|jpe?g|svg|webp|gif|woff2?|ico)$/.test(u.pathname)) {
      assets.add(u.pathname);
    } else if (isLink && !SKIP.test(u.pathname + u.search) && !u.pathname.includes(".")) {
      queue.push(u.pathname.endsWith("/") ? u.pathname : u.pathname + "/");
    }
  }

  html = toLocal(html)
    // 静的サイトでは不要な WordPress のヘッダー情報を削る
    .replace(/<link rel=['"](https:\/\/api\.w\.org\/|EditURI|alternate|wlwmanifest|shortlink)['"][^>]*>\n?/g, "")
    .replace(/<meta name="generator"[^>]*>\n?/g, "")
    .replace(/<link rel='dns-prefetch'[^>]*>\n?/g, "");
  if (p === "/contact/") html = disableForm(html);

  const file = path.join(outDir, p, "index.html");
  fs.mkdirSync(path.dirname(file), { recursive: true });
  fs.writeFileSync(file, html);
  console.log("page ", p);
}

for (const a of assets) {
  const res = await fetch(origin + a);
  if (!res.ok) { console.log("skip ", a, res.status); continue; }
  const file = path.join(outDir, a);
  fs.mkdirSync(path.dirname(file), { recursive: true });
  fs.writeFileSync(file, Buffer.from(await res.arrayBuffer()));
  console.log("asset", a);
}
