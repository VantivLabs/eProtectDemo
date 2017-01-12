<?php
/*
Credentials for eProtect and Vantiv eCommerce
*/
$ecomm_merchant_id = "1268016";
$ecomm_login = "u82918854344049902";
$ecomm_password = "QVtHWtb6UGk5XCz";

/* 
This paypageid is configured for use with Litle, returning a Litle format LVT
*/
$eprotect_paypageid_litle = "pGdxWrykrdvNkBK3";
/* 
This paypageid is configured for use with Mercury, returning a 19 character format LVT
*/
$eprotect_paypageid_mercury = "iwxJPDXr58uVB9kj";

$eprotect_url = "https://request-prelive.np-securepaypage-litle.com/LitlePayPage/litle-api2.js";
$applepay_csr = "-----BEGIN CERTIFICATE REQUEST-----
MIG5MGICAQAwADBZMBMGByqGSM49AgEGCCqGSM49AwEHA0IABAitWjNlJUB2b11B
vj5scmqGMsrAqALDKnGvNFuSJAbNpQTT5KPUAZztS6egvotnYlVm+D9UrAA/kQ9O
0tYpmTagADAJBgcqhkjOPQQBA0gAMEUCIQDI1X+dtOmIgQaCFLmg2X0ndaijQg5n
jCkYC/fTKVVcRAIgYpTUW55EkDgBGKqSjOQlOECKBao0V4RGSmljzS24kC0=
-----END CERTIFICATE REQUEST-----";

/*
Credentials for the MercuryPay endpoint
*/
//$mercury_merchantId = "019588466313922";
$mercury_merchantId = "337234003";

$mercury_endpoint = "https://w1.mercurycert.net/PaymentsAPI";
?>