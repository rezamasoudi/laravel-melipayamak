[![Latest Version on Packagist](https://img.shields.io/packagist/v/masoudi/melipayamak.svg?style=flat)](https://packagist.org/packages/masoudi/melipayamak)
[![Total Downloads](https://img.shields.io/packagist/dt/masoudi/melipayamak.svg?style=flat)](https://packagist.org/packages/masoudi/melipayamak)
[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg?style=flat)](https://opensource.org/licenses/MIT)

# Laravel Meli Payamak - پکیج لاراول ملی پیامک

[ملی پیامک](https://www.melipayamak.com) یک سرویس ارسال پیامک است. این پکیج به شما کمک می کند با استفاده از سرویس ملی
پیامک در لاراول برای کاربران خود پیامک ارسال کنید.

<b align="center">مشاهده آموزش پکیج در آپارات</b>

<div id="32820575219"><script type="text/JavaScript" src="https://www.aparat.com/embed/Kljys?data[rnddiv]=32820575219&data[responsive]=yes&titleShow=true"></script></div>

## \# نصب و راه اندازی

ابتدا پکیج را با دستور زیر از کامپوزر نصب کنید

```bash
composer require masoudi/melipayamak
```

سپس فایل کافیگ پکیج را با دستور زیر ایجاد کنید

```bash
php artisan vendor:publish --tag=melipayamak 
```

در فایل `.env` اطلاعات حساب خودتان را قرار دهید

```dotenv
MELIPAYAMAK_URI=http://api.payamak-panel.com/post/send.asmx?wsdl
MELIPAYAMAK_USER=username
MELIPAYAMAK_PASSWORD=password
```

## \# ارسال پیامک

اکنون می توانید به دو صورت پیامک ارسال کنید.

### از طریق کلاس MeliPayamak

```php
use Masoudi\Melipayamak\MeliPayamak;

$meliPayamak = resolve(MeliPayamak::class);
$meliPayamak->sendPatternSms(
      "9112345678", // شماره کاربر
      "48222", // کد پترن که در پنل ملی پیامک ساختید
      ['1234'] // آرایه متغییرهای پترن به ترتیب
  );

```

### از طریق ناتیفیکیشن

با دستور آرتیسان یک ناتیفیکیشن بسازید

```bash
php artisan make:notification VerificationCodeNotification
```

فایل ناتیفیکیشن ایجاد شده در مسیر `app/Notifications/VerificationCodeNotification.php` را ویرایش کنید.

 ```php
use Masoudi\Melipayamak\Notifications\MelipayamakNotification;
use Masoudi\Melipayamak\MeliPayamak;

// کلاس را از MelipayamakNotification ارث بری کنید
 class VerificationCodeNotification extends MelipayamakNotification {

    private $verificationCode;

    public function __construct($code)
    {
        $this->verificationCode = $code;
    }

    // این متد را اضافه کنید
    public function toSMS(mixed $notifiable, MeliPayamak $meliPayamak)
    {
        $meliPayamak->sendPatternSms(
            "9112345678", // شماره کاربر
            "48222", // کد پترن که در پنل ملی پیامک ساختید
            [$this->verificationCode] // آرایه متغییرهای پترن به ترتیب
        );
    }
 }
 ```

در نهایت در کنترلر بدین صورت از ناتیفیکیشن استفاده کنید

 ```php
    $user = User::where('mobile', $request->mobile)->first();
    
    $verifyCode = 2345;
    $user->notify(new VerificationCodeNotification($verifyCode));
 ```