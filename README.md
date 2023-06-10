# Rese

飲食店についての店舗情報を閲覧したり、予約やお気に入り店舗の登録ができます。

## 作成した目的

Laravel と Vue.js を用いたアプリ作成方法を学ぶため。

## 機能一覧

-   ログイン機能
-   飲食店お気に入り機能
-   飲食店検索機能
-   飲食店予約機能

## 使用技術（実行環境）

-   Laravel Framework 8.83.27
-   vue@3.3.4

## テーブル設計

<img width="700" alt="スクリーンショット 2023-06-04 15 50 50" src="https://github.com/koyama-anna/Rese_vue/assets/118032025/c99e7c36-73bc-4ee1-8da6-61cd09593e77">

## ER 図

<img width="700" alt="スクリーンショット 2023-06-04 15 49 26" src="https://github.com/koyama-anna/Rese_vue/assets/118032025/b2c550b3-42fa-4aa4-b9ab-3e94eec554ce">

# 環境構築

以下のコマンドで必要なパッケージをインストール後、サーバーを起動する。

フロント側(Vue.js)

-   npm install
-   yarn serve

バックエンド側(Laravel)

-   composer install
-   php artisan serve
