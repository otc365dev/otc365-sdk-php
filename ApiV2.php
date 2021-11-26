<?php

require_once('Utils.php');

class ApiV2{
    
    private $privateKey;

    function __construct($privateKey)
    {
        $this->privateKey = $privateKey;
    }

    function call($url,$params){

        $baseString = getBaseString($params);

        $sign = getRSASign($baseString,$this->privateKey);

        $params['sign'] = $sign;

        return httpPost($url,$params);
    }
}