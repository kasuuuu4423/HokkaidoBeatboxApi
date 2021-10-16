<?php
namespace Original\Library;

class Util{
    static function curlGet($baseUrl, $params){
        $url = $baseUrl.'?';
        $curl = curl_init();
        
        foreach($params as $index => $param){
            $url .= $index.'='.$param.'&';
        }

        $option = [
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
        ];
        curl_setopt_array($curl, $option);

        
        $response = curl_exec($curl);
        curl_close($curl);
        
        return $response;
    }

    static function pre_dump($array){
        echo '<pre>';
        var_dump($array);
        echo '</pre>';
    }

    static function checkNull($var){
        return $var != null ? $var : null;
    }
}