<p align="center"><a href="https://zarinpal.com" target="_blank"><img src="https://www.zarinpal.com/assets/images/logo-white.svg" width="320"></a></p>

<div align="center">
<img alt="GitHub repo size" src="https://img.shields.io/github/repo-size/mr648/zarinpal?style=for-the-badge">
<img alt="License" src="https://img.shields.io/github/license/mr648/zarinpal?style=for-the-badge">
<img alt="Packagist Version" src="https://img.shields.io/packagist/v/rahmatwaisi/zarinpal?style=for-the-badge">
<img alt="Total Downloads" src="https://img.shields.io/packagist/dt/rahmatwaisi/zarinpal?logo=composer&&color=green&&style=for-the-badge">
</div>

<div dir="rtl">

# پکیج اتصال به درگاه پرداخت زرین پال [zarinpal.com](https://www.zarinpal.com/payment-gateway.html)

برای اتصال به درگاه پرداخت اینترنتی زرین پال و استفاده از api های آن می توانید از این پکیج استفاده کنید.

**توجه:**
این پکیج برای لاراول 6 به بعد قابل استفاده است.

---

**نصب**

برای نصب پکیج توسط `composer` مراحل زیر را به دقت دنبال کنید:

**مرحله اول**
</div>

```shell
composer require rahmatwaisi/zarinpal
```

---

<div dir="rtl">

**مرحله دوم - انتقال فایل های مورد نیاز**

</div>


```shell

php artisan vendor:publish
# now choose: ZarinpalServiceProvider

```

---

<div dir="rtl">

**مرحله سوم**

در این مرحله باید تنظیمات مربوط به درگاه و درج کلید پذیرندگی را انجام دهید که برای اینکار باید فایل
`config/zarinpal.php` را ویرایش کنید.

</div>

```php 
    
    /**
     * کد پذیرندگی
     * Merchant ID
     */

    'merchant_id' => 'INSERT_YOUR_KEY_HERE',
```

---

<div dir="rtl">

**مرحله چهارم**

باید متد `callback` را در کنترلر `app\Http\Controllers\Zarinpal\PaymentCallbackController::class` طبق نیاز خود ویرایش کنید.
چند راهکار به صورت `TODO` پیشنهاد شده است.

</div>

---

<div dir="rtl">

**مرحله پایانی - اضافه کردن یک مسیر برای دریافت اطلاعات پرداخت از درگاه**

_باید توجه داشت که این route نباید دارای هیچ middleware ی باشد._

مسیر `/zarinpal/payments/callback` به عنوان `callback_route` به صورت پیشفرض در فایل کانفیگ پل کارت `config/zarinpal.php` درج شده است
که می توانید آن را تغییر داده و مسیر جدید را به عنوان `callback_route` انتخاب کنید.
</div>

```php
\Illuminate\Support\Facades\Route::any(
    // TODO change this path if you want
    //   so if you changed this path, open config/pol.php and edit  callback_route key.
    '/zarinpal/payments/callback'
    , [
        Http\Controllers\Zarinpal\PaymentCallbackController::class
        , 'callback'
    ]
);
```


<div dir="rtl">    

**نحوه استفاده**

</div>

```php
// ابتدا فاساد پکیج را ایمپورت کنید
use RahmatWaisi\Zarinpal\Facade\Zarinpal;


/*
 | در کنترلر یا متد مورد نظر کدهای زیر را استفاده کنید
 */
 
$price = 6480000; // 648 هزار تومان
$description = 'some description'; // تا حداکثر 30 کاراکتر
$mobile = '09012345678';
$email = 'rahmatwaisi@example.com';

// درخواست توکن پرداخت
$authorityResponse  = Zarinpal::authority($price, $description,null,$mobile, $email);

// $code = $authorityResponse['code']; // کد پاسخ درگاه
// $message = $authorityResponse['message']; // پیغام درگاه
$authority = $authorityResponse['authority'];

// برای هدایت به صفحه پرداخت
Zarinpal::pay($authority);

// برای بررسی صحت تراکنش
Zarinpal::verify($price, $authority);

// برای اصلاحیه پرداخت ناموفق و درخواست لغو تراکنش و برگشت مبلغ به حساب دارنده کارت
Zarinpal::refund($authority);
```


---

<div dir="rtl">

**در صورت تمایل جهت همکاری در توسعه شامل:**

1. توسعه مستندات پکیج.
2. گزارش باگ و خطا.
3. افزودن سرویس های دیگر
4. ارتقاء کدها
5. نوشتن تست

درصورت بروز هر گونه
[باگ](https://github.com/mr648/zarinpal/issues)
ما را آگاه سازید .

---

### ارتباط با ما

- [Telegram](https://t.me/rahmatwaisi)
- [Email](mailto:rahmatwaisi@gmail.com)

---
</div>



<div dir="rtl">

### لایسنس

<p align="center">

پکیج اتصال به درگاه زرین پال بصورت متن باز و تحت لایسنس [MIT license](https://opensource.org/licenses/MIT) قرار دارد.

</p>

</div>

