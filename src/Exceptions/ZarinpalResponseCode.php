<?php

namespace RahmatWaisi\Zarinpal\Exceptions;

class ZarinpalResponseCode
{
    const VALIDATION_ERROR = -9;
    const INVALID_TERMINAL = -10;
    const TERMINAL_DISABLED = -11;
    const TOO_MANY_ATTEMPTS = -12;
    const TERMINAL_SUSPENDED = -15;
    const TERMINAL_LEVEL_IS_LOW = -16;
    const FLOATING_WAGES_IS_LOCKED = -30;
    const DEFAULT_BANK_NOT_DEFINED = -31;
    const FLOATING_WAGES_OVERLOADED = -32;
    const INVALID_FLOATING_WAGES = -33;
    const FIXED_WAGES_OVERLOADED = -34;
    const MAXIMUM_FLOATING_WAGE_PARTS_EXCEEDED = -35;
    const INVALID_EXTRA_PARAMETER = -40;
    const PAYMENT_AMOUNT_MISMATCH = -50;
    const FAILED = -51;
    const UNEXPECTED_SERVER_EXCEPTION = -52;
    const LACK_OF_AUTHORITY_OWNERSHIP = -53;
    const INVALID_AUTHORITY = -54;
    const SUCCESS = 100;
    const VERIFIED = 101;

    /**
     * Array of all possible successful response codes. $code => $message values.
     */
    public static $success = [
        self::SUCCESS => 'پرداخت با موفقیت انجام شد',
        self::VERIFIED => 'تراکنش معتبر است',
    ];

    /**
     * Array of all possible failed response codes. $code => $message values.
     */
    public static $errors = [
        self::VALIDATION_ERROR => 'خطای اعتبار سنجی',
        self::INVALID_TERMINAL => 'آی پی یا کد پذیرنگی پذیرنده صحیح نیست',
        self::TERMINAL_DISABLED => 'کد پذیرندگی فعال نیست، لطفا با پشتیبانی زرین پال تماس بگیرید',
        self::TOO_MANY_ATTEMPTS => 'تلاش بیش از حد',
        self::TERMINAL_SUSPENDED => 'درگاه پرداخت به حالت تعلیق در آمده است، لطفا با تیم پشتبانی تماس بگیرید',
        self::TERMINAL_LEVEL_IS_LOW => 'سطح تائید پذیرنده پایین تر از سطح نقره ای است',
        self::FLOATING_WAGES_IS_LOCKED => 'اجازه دسترسی به تسویه اشتراکی شناور ندارید',
        self::DEFAULT_BANK_NOT_DEFINED => 'حساب بانکی تسویه را به پنل اضافه کنید مقادیر وارد شده واسه تسهیم درست نیست',
        self::FLOATING_WAGES_OVERLOADED => 'دستمزد معتبر نیست، کل دستمزد شناور بیش از حداکثر مقدار است',
        self::INVALID_FLOATING_WAGES => 'درصدهای وارد شده صحیح نیست',
        self::FIXED_WAGES_OVERLOADED => 'دستمزد معتبر نیست، کل دستمزد ثابت از حداکثر مقدار بیشتر است',
        self::MAXIMUM_FLOATING_WAGE_PARTS_EXCEEDED => 'تعداد افراد دریافت کننده سهم بیش از حد مجاز است',
        self::INVALID_EXTRA_PARAMETER => 'پارامتر اضافی نامعتبر، زمان انقضا صحیح نیست',
        self::PAYMENT_AMOUNT_MISMATCH => 'مبلغ پرداخت شده با مقدار مبلغ در هنگام بررسی متفاوت است',
        self::FAILED => 'پرداخت ناموفق',
        self::UNEXPECTED_SERVER_EXCEPTION => 'خطای غیرمنتظره، با تیم پشتبانی زرین پال تماس بگیرید',
        self::LACK_OF_AUTHORITY_OWNERSHIP => 'کد اعتبارسنجی ارسال شده متعلق به درگاه پرداخت شما نیست',
        self::INVALID_AUTHORITY => 'کد اعتبار سنجی نامعتبر',
    ];

    /**
     * Gets message for $code
     * @param int $code
     * @return string message
     */
    public static function getErrorMessage(int $code): string
    {
        return sprintf(
            '%s - Error Code = [%d]'
            , self::$errors[$code]
            , $code
        );
    }

    /**
     * Gets message for $code
     * @param int $code
     * @return string message
     */
    public static function getSuccessMessage(int $code): string
    {
        return sprintf(
            '%s - Code = [%d]'
            , self::$success[$code]
            , $code
        );
    }
}
