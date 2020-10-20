<?
$googleCaptchaSecret = '6Le8B98UAAAAAF8CW8dDpLaFlmeQRBJRREA659fh';


if ($_POST['action'] == 'check-captcha'){

    $post_data = http_build_query(
        array('secret' => $googleCaptchaSecret,'response' => @$_POST['g-recaptcha-response'],'remoteip' => $_SERVER['REMOTE_ADDR'])
    );
    $opts = array('http' =>
        array('method'  => 'POST','header'  => 'Content-type: application/x-www-form-urlencoded','content' => $post_data)
    );
    $context  = stream_context_create($opts);
    $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
    $resultC = json_decode($response);
    //print_R($resultC);

    if (!$resultC || !$resultC->success){
        //die('inv');
        die(json_encode(['result' => 0]));
    }else{
        die(json_encode(['result' => 1]));
    }

    return $result;

}


if ($_POST['action'] == 'send-form'){

    $post_data = http_build_query(
        array('secret' => $googleCaptchaSecret,'response' => @$_POST['g-recaptcha-response'],'remoteip' => $_SERVER['REMOTE_ADDR'])
    );
    $opts = array('http' =>
        array('method'  => 'POST','header'  => 'Content-type: application/x-www-form-urlencoded','content' => $post_data)
    );
    $context  = stream_context_create($opts);
    $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
    $resultC = json_decode($response);

    if (!$resultC || !$resultC->success){
        die(json_encode([
            'result' => 0,
            'error' => 'captcha not valid',
            'data' => $resultC
        ]));
    }else{
        //Captcha OK

        $url = 'https://megacable.convertia.com/public/integration/process';
        $ch = curl_init($url);

        $data = $_POST;
        $payload = json_encode($data);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        $resultJ = json_decode($result);

        curl_close($ch);

        if ($resultJ->status){
            die(json_encode([
                'result' => 1,
            ]));
        }else{
            die(json_encode([
                'result' => 0,
                'error' => $resultJ->error,
                'data' => $resultJ
            ]));
        }
    }

    return $result;

}

die(json_encode([
    'result' => 0,
    'error' => 'Invalid action',
]));

?>