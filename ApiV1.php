<?php

require_once('Utils.php');

class ApiV1{
    
    private $secretKey;

    function __construct($secretKey)
    {
        $this->secretKey = $secretKey;
    }

    function call($url,$params){

        $params['secretKey'] = $this->secretKey;

        $baseString = getBaseString($params);

        $sign = '';

        if($params['signType'] == 1) {
            $sign = hash_hmac('sha256', $baseString, $this->secretKey);
        }else{
            $sign = md5($baseString);
        }

        unset($params['secretKey']);
        $params['sign'] = $sign;

        return httpPost($url,$params);
    }
}