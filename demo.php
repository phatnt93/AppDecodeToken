<?php 

$appleDecodeToken = new AppleDecodeToken();
$appleDecode = $appleDecodeToken->decode($jwt);
if (!$appleDecode) {
    return $this->respError('Invalid apple token');
}
$socialId = $appleDecode['sub'];
$socialEmail = $appleDecode['email'];