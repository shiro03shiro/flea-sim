# flea-sim

## 環境構築

**Dockerビルド**

1. `git clone git@github.com:shiro03shiro/flea-sim.git`
2. DockerDesktopアプリを立ち上げる
3. `docker-compose up -d --build`

**Laravel環境構築**

1. `docker-compose exec php bash`
2. `composer install`
3. `cp .env.example .env`
4. .envに以下の環境変数を追加

```text
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

5. 必須コマンド

```bash
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
```

6. 権限設定

```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
touch storage/logs/laravel.log
chown www-data:www-data storage/logs/laravel.log
```

## 使用技術(実行環境)

- PHP 8.2
- Laravel 8.83.8
- jquery 3.7.1.min.js
- MySQL 8.0.26
- nginx 1.21.1

## ER図

![ER図](index.png)

## URL

- 開発環境：http://localhost/
- phpMyAdmin：http://localhost:8080/

## ユーザ情報

| ユーザ | メール            | パスワード | 状態                               |
| ------ | ----------------- | ---------- | ---------------------------------- |
| user1  | user1@example.com | password   | 会員登録・プロフィール設定のみ完了 |
| user2  | user2@example.com | password   | ダミー商品出品済み                 |
| user3  | user3@example.com | password   | いいね・コメント・購入済み         |

## その他

- 要件ID[FN012]<br>
  メール認証（応用機能）は未実装のためテーブル仕様書及びER図には記載なし。
  ただしマイグレーションファイル「email_verified_at」カラムはデフォルトのまま残しています。<br>
- 要件ID[FN006]<br>
  プロフィール未設定ユーザ判別のためusersテーブルに「is_profile_completed」カラム追加。
  直接usersテーブルに追記せず、「add_is_profile_completed_to_users_table」でカラムを追加しています。<br>
- 要件ID[FN024]<br>
  「テーブル内では各アイテムに送付先住所が紐づいている」はpurchasesテーブル内の外部キーで紐づいていると判断しました。<br>
