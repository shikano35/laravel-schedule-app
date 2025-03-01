## schedule app

### 環境構築

1. リポジトリをクローン
   `git clone <リポジトリのURL>`
   `cd <プロジェクト名>`

2. プロジェクトを htdocs ディレクトリに配置

3. MAMP を起動

4. 依存関係のインストール

```bash
composer install
npm install
```

5. データベースのマイグレーション

```bash
php artisan migrate
```

6. シードの追加

```bash
php artisan db:seed
```

7. ローカルサーバーを起動する

```bash
npm run dev
php artisan serve
```

15. `http://localhost:8000`でアプリを起動
