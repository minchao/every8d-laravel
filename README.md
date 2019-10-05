# every8d-laravel

[![Build Status](https://travis-ci.org/silviayc/every8d-laravel.svg?branch=master)](https://travis-ci.org/silviayc/every8d-laravel)
[![Latest Stable Version](https://poser.pugx.org/silviayc/every8d-laravel/v/stable)](https://packagist.org/packages/silviayc/every8d-laravel)
[![Latest Unstable Version](https://poser.pugx.org/silviayc/every8d-laravel/v/unstable)](https://packagist.org/packages/silviayc/every8d-laravel)
[![composer.lock](https://poser.pugx.org/silviayc/every8d-laravel/composerlock)](https://packagist.org/packages/silviayc/every8d-laravel)

這是一個簡單的 Laravel service provider，讓您在 Laravel 或 Lumen 應用中更容易的使用 [EVERY8D SDK](https://github.com/minchao/every8d-php)。

## 執行環境

* PHP >= 7.0
* [Laravel](https://laravel.com/docs/5.5) >= 5.5

## 安裝

建議透過 [Composer](https://getcomposer.org/) 安裝：

```
$ composer require silviayc/every8d-laravel
```

安裝後，您必須在應用啟動時註冊這個套件，請參考以下步驟說明。

### Laravel

在 Laravel 5.5 或以上版本，這個套件可以自動註冊 provider 與 facade。

### Lumen

由於 Lumen 沒有自動註冊機制，請在專案的 `bootstrap/app.php` 檔案中加入 `Every8d\Laravel\Every8dServiceProvider`：

```php
    $app->register(Every8d\Laravel\Every8dServiceProvider::class);
```

複製 `every8d.php` 設定擋：(非必要)

```
$ mkdir config
$ cp vendor/silviayc/every8d-laravel/config/every8d.php config/every8d.php
```

## 設定

使用 Artisan 指令產生套件設定擋（Lumen 未支援）。

```
$ php artisan vendor:publish --provider="Every8d\Laravel\Every8dServiceProvider"
```

然後在 `config/every8d.php` 設定檔內填入您的 EVERY8D SMS API 帳號密碼。另一個選擇，您也可以在 `.env` 檔案中透過環境變數設定：

```
EVERY8D_USERNAME=username
EVERY8D_PASSWORD=password
```

## 使用

在應用內使用時，您可以從 service container 中取得 EVERY8D SDK 實例：

```php
$every8d = app(\Every8d\Client::class);

$sms = new \Every8d\Message\SMS('+886987654321', 'Hello, Laravel IoC Container');
$result = $every8d->sendSMS($sms);
```

或，您也可以使用 facade：

```php
use Every8d;

$sms = new \Every8d\Message\SMS('+886987654321', 'Hello, Facade');
$result = Every8d::sendSMS($sms);
```

## License

See the [LICENSE](LICENSE) file for license rights and limitations (BSD 3-Clause).
