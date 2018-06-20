<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/9/15
 * Time: 下午5:58
 */

require '../vendor/autoload.php';
use Qiniu\Auth;
// 用于签名的公钥和私钥
$accessKey = 'cL34D_5gNicmbuFtPkxklXxfqxE_d_R6PkdSlSFr';
$secretKey = '2xd6d0jUdr1VI1EmBWAD9WqTCzGOXNrFk-9_aTfD';
// 初始化签权对象
$auth = new Auth($accessKey, $secretKey);
$bucket = 'zyq20170909';
// 生成上传Token
$token = $auth->uploadToken($bucket);

/* web ke yi var_dump tiao shi ; API bu ke yi hui ying xiang jiao hu*/
//var_dump($token);

echo json_encode($token);