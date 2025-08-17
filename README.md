# test1

## 環境構築
1 docker compose up -d --build
2 composer install
3 laravelプロジェクトインストール
4 時間設定
5 .env.exampleファイルから.envファイルの作成、環境変数を変更
6 php artisan migrate
7 php artisan db:seed

## 使用技術
laravel:8.83.29
php:8.1.33
mysql:8.0.26

## ER図
![alt text](https://file%2B.vscode-resource.vscode-cdn.net/Users/yu/coachtech/test1/test1.svg?version%3D1755424533886)

## URL
・お問い合わせフォーム入力ページ:http://localhost
・お問い合わせフォーム確認ページ:
・サンクスページ:http://localhost/contacts/thanks
・登録ページ:http://localhost/register
・ログインページ:http://localhost/login
・管理ページ:http://localhost/admin
・phpMyAdmin:http://localhost:8080