<?php
require_once 'vendor/autoload.php';


use Arifpay\Phpsdk\Arifpay;


use Arifpay\Phpsdk\Helper\ArifpaySupport;
use Arifpay\Phpsdk\Lib\ArifpayBeneficary;
use Arifpay\Phpsdk\Lib\ArifpayCheckoutItem;
use Arifpay\Phpsdk\Lib\ArifpayCheckoutRequest;
use Arifpay\Phpsdk\Lib\ArifpayOptions;

$arifpay = new Arifpay('your-api-key');

$expired = "2023-01-13T17:09:42.411";
$data = new ArifpayCheckoutRequest(
    cancel_url: 'https://api.arifpay.com',
    error_url: 'https://api.arifpay.com',
    notify_url: 'https://gateway.arifpay.net/test/callback',
    expireDate: $expired,
    nonce: floor(rand() * 10000) . "",
    beneficiaries: [
        ArifpayBeneficary::fromJson([
            "accountNumber" => '01320811436100',
            "bank" => 'AWINETAA',
            "amount" => 10.0,
        ]),
    ],
    paymentMethods: ["CARD"],
    success_url: 'https://gateway.arifpay.net',
    items: [
        ArifpayCheckoutItem::fromJson([
            "name" => 'Bannana',
            "price" => 10.0,
            "quantity" => 1,
        ]),
    ],
);
$session =  $arifpay->checkout->create($data, new ArifpayOptions(sandbox: true));
echo $session->session_id;

?>