<?php

define('DEBUG',0);                  //   1 为调试模式
define('APPID',getAppid());         //   Appid
define('TIM',time());               //   当前时间戳
define('UNSTR','wxSdkuniqidStr');   //   随即字串串

//获取微信配置
function wx(){

    global $db;

    //网站基本信息
    $option = $db->get_all('gh_option','WHERE optionType="wx"');
    if($option){
        foreach($option as $k => $v){
            $wx[$v['optionKey']] = $v['optionValue'];
        }
    }
    return $wx;

}

// 统一配置
function getConfig($conf){

    $confKey = strtolower($conf);

    switch ($confKey){
        case 'debug':
            $confVal = DEBUG;
            break;
        case 'appid':
            $confVal = '\''.APPID.'\'';
            break;
        case 'timestamp':
            $confVal = TIM;
            break;
        case 'noncestr':
            $confVal = '\''.UNSTR.'\'';
            break;
        case 'signature':
            $confVal = '\''.getSignature().'\'';
            break;
        case 'jsapilist':
            $confVal = '\'onMenuShareAppMessage\',\'onMenuShareTimeline\'';
            break;
        default:
            $confVal = false;
    }

    return $confVal;

}

// 获取 signature
function getSignature(){
    $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

    $signature = 'jsapi_ticket='.getCheed(2).'&noncestr='.UNSTR.'&timestamp='.TIM.'&url='.$url;

    return sha1($signature);
}

// 参数 1  返回 AccessToken
// 参数 2  返回 Ticket
function getCheed($num){

    global $db;

    $row = wx();

    if($row['lasttime']+6000 > time()){
        $AccessToken = $row['accesstoken'];
        $Ticket      = $row['ticket'];
    }else{
        // 更新 AccessToken 和 Ticket
        $AccessToken = getAccessToken();
        $Ticket      = getTicket($AccessToken);

        $array = array(
            'accesstoken' => $AccessToken,
            'ticket' => $Ticket
        );

        foreach($array as $k => $v){

            $info_array = array(
                'optionValue'=> $v
            );   

            $db->update('gh_option', $info_array,"WHERE optionType='wx' AND optionKey='{$k}'");
        }

        $info_array = array(
            'optionValue'=> TIM
        );   

        $db->update('gh_option', $info_array,"WHERE optionType='wx' AND optionKey='lasttime'");

    }

    if($num == 1){
        return $AccessToken;
    }elseif($num == 2){
        return $Ticket;
    }else{
        return false;
    }

}

// 获取 Ticket
function getTicket($AccessToken){
    $access_token = $AccessToken;
    $url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$access_token.'&type=jsapi';
    $output = Get_curls($url);
    $jsoninfo = json_decode($output, true);
    $ticket = $jsoninfo['ticket'];
    return $ticket;
}

// 获取 AccessToken
function getAccessToken(){
    $row = wx();
    $appid = $row['appid'];
    $appsecret = $row['appsecret'];
    $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsecret;
    $output = Get_curls($url);
    $jsoninfo = json_decode($output, true);
    $access_token = $jsoninfo["access_token"];
    return $access_token;
}

// 获取 Appid
function getAppid(){
    $row = wx();
    return $row['appid'];
}

?>