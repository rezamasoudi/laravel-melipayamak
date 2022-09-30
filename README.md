[![Latest Version on Packagist](https://img.shields.io/packagist/v/masoudi/melipayamak.svg?style=flat)](https://packagist.org/packages/masoudi/melipayamak)
[![Total Downloads](https://img.shields.io/packagist/dt/masoudi/melipayamak.svg?style=flat)](https://packagist.org/packages/masoudi/melipayamak)
[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg?style=flat)](https://opensource.org/licenses/MIT)

# Laravel Meli Payamak - پکیج لاراول ملی پیامک
[ملی پیامک](https://www.melipayamak.com) یک سرویس ارسال پیامک است. این پکیج به شما کمک می کند با استفاده از این سرویس در لاراول برای کاربران خود پیامک ارسال کنید.

## \# نصب و راه اندازی
ابتدا پکیج را با دستور زیر از کامپوزر نصب کنید

```bash
composer require masoudi/melipayamak
```
سپس فایل کافیگ پکیج را با دستور زیر ایجاد کنید

```bash
php artisan vendor:publish --tag=melipayamak 
```

در فایل تنظیمات `config/melipayamak.php` اطلاعات حساب خودتان را قرار دهید

```php
    'uri' => 'http://api.payamak-panel.com/post/send.asmx?wsdl',
    'user' => '09123456789',
    'password' => 'Pass#123',
```

## \# ارسال پیامک
اکنون می توانید به این صورت پیامک ارسال کنید. با دستور آرتیسان یک ناتیفیکیشن بسازید

```bash
php artisan make:notification VerificationCodeNotification
```
 فایل ناتیفیکیشن ایجاد شده در مسیر `app/Notifications/VerificationCodeNotification.php` را ویرایش کنید.

 ```php
 use Masoudi\Melipayamak\Channels\MeliPayamakChannel;
use Masoudi\Melipayamak\Contracts\SMSNotification;
use Masoudi\Melipayamak\MeliPayamak;

 class VerificationCodeNotification extends Notification implements SMSNotification {

    private $verificationCode;

    public function __construct($code)
    {
        $this->verificationCode = $code;
    }

    public function via($notifiable)
    {
        // کانال ملی پیامک را اضافه کنید
        return [MeliPayamakChannel::class];
    }

    // این متد اس ام اس را ارسال میکند
    public function toSMS(mixed $notifiable, MeliPayamak $meliPayamak)
    {
        // ار سال اس ام اس
        $meliPayamak->sendPatternSms(
            "9112345678", // شماره کاربر
            "48222", // کد پترن که در پنل ملی پیامک ساختید
            [$this->verificationCode] // آرایه متغییرهای پترن به ترتیب
        );
    }
 }
 ```

 در نهایت هر جا نیاز به ارسال ناتیفیکیشن دارید آن را ارسال کنید 
 
 ```php
    $verifyCode = 2345;
    
    $user->notify(new VerificationCodeNotification($verifyCode));
 ```