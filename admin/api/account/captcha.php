<?php
session_start();
require(dirname(__FILE__)."/./php-captcha/CaptchaBuilderInterface.php");
require(dirname(__FILE__)."/./php-captcha/CaptchaBuilder.php");
use Minho\Captcha\CaptchaBuilder;

$captch = new CaptchaBuilder();

$captch->initialize([
    'width' => 200,     // 宽度
    'height' => 80,     // 高度
    'line' => false,    // 直线
    'curve' => false,    // 曲线
    'noise' => 1,       // 噪点背景
    'fonts' => []       // 字体
]);

$captch->create();
$captch->output(1);
$_SESSION["captcha"] = $captch->getText();
?>