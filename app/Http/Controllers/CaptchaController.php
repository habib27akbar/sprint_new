<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mews\Captcha\Captcha;

class CaptchaController extends Controller
{
    public function showCaptcha(Captcha $captcha)
    {
        return $captcha->create('default', true);
    }
}
