<?php

define('ORANGE_URL','http://api.orange.sc/api');
define('ORANGE_TOKEN','xcWYPqddd3Kawqm37oZA3dB1gTEENKub15aaa083zc');
define('ORANGE_SALT','11bNXFUssiNHag==');
define('ORANGE_SESSION','YEtlyPBcaGHshCFzFcMdMtY199Y+');


class APIclient {

	// @CNRT 2018 v0.3

    var $variable = array();

    private function _request($method, $service, $parameters){

        $curl = curl_init();
     curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 2);

        $curl_header = array();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'X-API-Session: '.$this->sessionToken,
            'X-API-Token: '.$this->token,
        ));
        curl_setopt($curl, CURLOPT_TIMEOUT, 20);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 20);

        //curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        //curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
        //curl_setopt($curl, CURLOPT_HEADER, true);
        //curl_setopt($curl, CURLOPT_MAXREDIRS,1);
        //curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

        curl_setopt($curl, CURLOPT_URL, $this->url.'/api'.$service);


        switch($method){
            case 'GET': {
                //curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
                curl_setopt($curl, CURLOPT_POST, 0);
                curl_setopt($curl, CURLOPT_URL, $this->url.'/api/'.$service.'?'.http_build_query($parameters));

                //echo $this->url.'/api/'.$service.'?'.http_build_query($parameters);die();
                break;
            }
            case 'POST': {
                //curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS,http_build_query($parameters));
                break;
            }
            case 'PUT': {
                //TEST, nginx timeout curlopt_customrequest
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                break;
            }
            case 'DELETE': {
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                break;
            }
        }

        $result = curl_exec($curl);

        if (curl_error($curl)){
            return [
                'error' => curl_error($curl)
            ];
        }

        curl_close($curl);

        $json_response = json_decode($result);

        if(json_last_error() == JSON_ERROR_NONE){
            $this->variable = array();

            foreach($json_response->response as $variable => $value){
                $this->variable[$variable] = $value;
            }

            return $json_response;
        }else{
            return $result;
        }
    }

    public function setSessionToken($token){
        $this->sessionToken = $token;
    }

    public function request($method, $service,$parameters){
        return $this->_request($method, $service, $parameters);

    }

    public function get($variable_name){
        return $this->variable[$variable_name];
    }

    public function variables(){
        return $this->variable;
    }

}
?>