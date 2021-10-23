<?php 

// $jwt Format
// {
//     "code" : "...",
//     "id_token" : "...",
//     "nonce" : "...",
//     "state" : "..."
// }
$jwt = 'This is id_token of apple response after login by app on mobile (IOS or android)';

$appleDecodeToken = new AppleDecodeToken();
$appleDecode = $appleDecodeToken->decode($jwt);
if (!$appleDecode) {
    return $this->respError('Invalid apple token');
}
$socialId = $appleDecode['sub'];
$socialEmail = $appleDecode['email'];
