<?php

header('Content-Type: application/json charset=utf-8', false);

if($_GET['captcha'] == true){
$output = shell_exec("python AsiaCell.py captcha");
$output = json_decode($output, 1)['captcha'];
$output = ['image'=>$output['originSource'] . $output['resourceUrl'], 'PID'=>explode("PID=", $output['resourceUrl'])[1]];
$output['captchaCode'] = file_get_contents("https://alshbg.ml/test/asiacell/cap.php?url=".$output['image']);
}

if($_GET['phone'] and $_GET['captchaCode']){
$output = shell_exec("python AsiaCell.py loginV2 {$_GET['captchaCode']} {$_GET['phone']} ");
#$output = shell_exec("python AsiaCell.py loginV2 319817 07703433551");
$output = json_decode($output, 1);
$output['PID'] = explode("PID=", $output['nextUrl'])[1];
}

if($_GET['PID'] and $_GET['code']){
$output = shell_exec("python AsiaCell.py smsvalidation {$_GET['code']} {$_GET['PID']} ");
#$output = shell_exec("python AsiaCell.py smsvalidation 319817 4718c2dd-b92c-40ce-ae31-72259d691f8e");
$output = json_decode($output, 1);
}

if($_GET['info'] == true and $_GET['access_token']){
$output = shell_exec("python AsiaCell.py profile {$_GET['access_token']}");
#$output = shell_exec("python AsiaCell.py profile eyJhbGciOiJIUzUxMiJ9.eyJ1c2VybmFtZSI6IjA3NzI1NzU3MjQ2IiwiZXhwIjoxNjU3MjM1MDQwfQ.h1kS8xpgGHsp0G0-hwEIeg0p5IsLdD0v_XbIMq-yox11oBfYUbFRsx8WQE8rVYAh1CVMoS_8i8d6TDP6dq_vow");
$output = json_decode($output, 1);
}

if($_GET['voucher'] and $_GET['access_token']){
$output = shell_exec("python AsiaCell.py top-up {$_GET['voucher']} {$_GET['access_token']}");
#$output = shell_exec("python AsiaCell.py top-up 12312312312312 eyJhbGciOiJIUzUxMiJ9.eyJ1c2VybmFtZSI6IjA3NzAzNDMzNTMxIiwiZXhwIjoxNjU3MTA2OTQ1fQ.ssVc5wQSYqVL_GFHoWW-YX6wO5rNj-zYepM_FZHWM_e0G1hRXBqufnCVkww8-_m0Oqh5Am1u7NNaBderingsjw");
$output = json_decode($output, 1);
}

if($_GET['transfer'] and $_GET['access_token'] and $_GET['amount']){
$output = shell_exec("python AsiaCell.py credit-transfer/start {$_GET['transfer']} {$_GET['access_token']} {$_GET['amount']}");
#$output = shell_exec("python AsiaCell.py credit-transfer/start 07703433532 eyJhbGciOiJIUzUxMiJ9.eyJ1c2VybmFtZSI6IjA3NzAzNDMzNTMxIiwiZXhwIjoxNjU3MTA2OTQ1fQ.ssVc5wQSYqVL_GFHoWW-YX6wO5rNj-zYepM_FZHWM_e0G1hRXBqufnCVkww8-_m0Oqh5Am1u7NNaBderingsjw 1000");
$output = json_decode($output, 1);
}

if($_GET['PID'] and $_GET['access_token'] and $_GET['code']){
$output = shell_exec("python AsiaCell.py credit-transfer/start {$_GET['PID']} {$_GET['access_token']} {$_GET['code']}");
#$output = shell_exec("python AsiaCell.py credit-transfer/do-transfer 07703433532 eyJhbGciOiJIUzUxMiJ9.eyJ1c2VybmFtZSI6IjA3NzAzNDMzNTMxIiwiZXhwIjoxNjU3MTA2OTQ1fQ.ssVc5wQSYqVL_GFHoWW-YX6wO5rNj-zYepM_FZHWM_e0G1hRXBqufnCVkww8-_m0Oqh5Am1u7NNaBderingsjw 121212");
$output = json_decode($output, 1);
}

echo json_encode($output, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);