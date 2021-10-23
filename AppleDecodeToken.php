<?php
namespace App\Library\Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\JWK;

class AppleDecodeToken{
    private $urlKey = 'https://appleid.apple.com/auth/keys';

    function __construct(){
        
    }

    public function decode($jwt){
        try {
            $alg = $this->getAlg($jwt);
            if (!$alg) {
                throw new \Exception("Not found Alg");
            }
            $appleKey = $this->getAppleKey();
            if (!$alg) {
                throw new \Exception("Not found Apple Keys");
            }
            $decoded = JWT::decode($jwt, JWK::parseKeySet($appleKey), [$alg]);
            return (array)$decoded;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function getAlg($jwt){
        $header_segment = json_decode(base64_decode(explode('.', $jwt)[0]), true);
        if (!isset($header_segment['alg'])) {
            return false;
        }
        return $header_segment["alg"];
    }

    private function getAppleKey(){
        $apple_response = json_decode(file_get_contents($this->urlKey), true);
        if (!is_array($apple_response)) {
            return false;
        }
        return $apple_response;
    }
}
