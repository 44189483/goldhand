<?php
if(!defined('SdkVer')){	exit;}


define('DEBUG',0);                  //   1 为调试模式
define('APPID',getAppid());         //   Appid
define('TIM',time());               //   当前时间戳
define('UNSTR','wxSdkuniqidStr');   //   随即字串串

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

    $sql = 'SELECT * FROM gh_option WHERE optionType="wx"';
    $query = mysql_query($sql);
    $wx = mysql_fetch_array($query);
    if($wx){
        foreach($option as $k => $v){
            $row[$v['optionKey']] = $v['optionValue'];
        }
    }

    if($row['lasttime']+6000>time()){
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
            $sql = sprintf('UPDATE gh_option SET optionValue = \'%s\' WHERE optionKey = %s',$v,$k);
            $res = mysql_query($sql);
        }

        $sql = sprintf('UPDATE gh_option SET optionValue = \'%s\' WHERE optionKey = %s',strtotime("now"),'lasttime');
        $res = mysql_query($sql);
        if(!res){ return false; }

    }

    if($num==1){
        return $AccessToken;
    }elseif($num==2){
        return $Ticket;
    }else{
        return false;
    }

}

// 获取 Ticket
function getTicket($AccessToken){

    $access_token = $AccessToken;

    $url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$access_token.'&type=jsapi';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    $jsoninfo = json_decode($output, true);
    $ticket = $jsoninfo['ticket'];
    return $ticket;

}


// 获取 AccessToken
function getAccessToken(){

    $sql = 'SELECT * FROM gh_option WHERE optionType="wx"';
    $query = mysql_query($sql);
    $wx = mysql_fetch_array($query);
    if($wx){
        foreach($option as $k => $v){
            $row[$v['optionKey']] = $v['optionValue'];
        }
    }

    $appid = $row['appid'];
    $appsecret = $row['appsecret'];
    $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsecret;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    $jsoninfo = json_decode($output, true);
    $access_token = $jsoninfo["access_token"];
    return $access_token;

}

// 获取 Appid
function getAppid(){

    $sql = 'SELECT * FROM gh_option WHERE optionType="wx"';
    $query = mysql_query($sql);
    $wx = mysql_fetch_array($query);
    if($wx){
        foreach($option as $k => $v){
            $row[$v['optionKey']] = $v['optionValue'];
        }
    }

    return $row['appid'];

}

?>