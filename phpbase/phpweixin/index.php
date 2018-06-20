<?php
include_once "wxBizMsgCrypt.php";
/*
 *
 * url填写：http://外网IP：端口号/wx 。外网IP请到腾讯云购买成功处查询，
 * http的端口号固定使用80，不可填写其他。
Token：自主设置，这个token与公众平台wiki中常提的access_token不是一回事。
这个token只用于验证开发者服务器。
 * */
    //获得参数 signature nonce token timestamp echostr
if(is_array($_GET)&&count($_GET)>0){
	if (isset($_GET['nonce'])) {
		# code...
		 $nonce = $_GET['nonce'];
	}
	
    $token     = 'yananding20170920';
    	if (isset($_GET['timestamp'])) {
		# code...
		 $timestamp = $_GET['timestamp'];
	}
       	if (isset($_GET['echostr'])) {
		# code...
		 $echostr = $_GET['echostr'];
	 }
	    	if (isset($_GET['signature'])) {
		# code...
		 $signature = $_GET['signature'];
	}
  
  
    //形成数组，然后按字典序排序
    $array = array();
    $array = array($token, $timestamp,$nonce );
    sort($array);
    //拼接成字符串,sha1加密 ，然后与signature进行校验
    $str = sha1( implode( $array ) );
}else
{

    echo '不是来自微信的请求 注意';
}
   
    if(is_array($_GET)&&count($_GET)>0&&isset($_GET['signature'])&&
        $str == $signature && $echostr ){
        //第一次接入weixin api接口的时候
    
    //echo json_encode($echostr);
echo $echostr;
        return;

    }