<?php
    ob_start();

    include 'include/common.php';

    $code = $_GET['code'];

    if(empty($code)){
    	header("Location:error.php");
    	echo "<script>location.href='error.php';</script>";
    	exit;
    }

    //$state = $_GET['state'];

    //接口信息
    $row = wx();
    $appid = $row['appid'];  
    $appsecret = $row['appsecret']; 

    $token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code';

    $token = json_decode(file_get_contents($token_url));

    if (isset($token->errcode)) {
        echo '<h1>错误：</h1>'.$token->errcode;
        echo '<br/><h2>错误信息：</h2>'.$token->errmsg;
        exit;
    }

    //openid
    $openid = $token->openid;
    setcookie('openid',$openid,time()+3600*24*30);
    header("Location:index.php");
    echo "<script>location.href='index.php';</script>";
?>