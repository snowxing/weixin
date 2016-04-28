<?php
header("Content-type: text/html; charset=utf-8"); 
$appid = 'wxe3943d2e971c7d5a';
$secret = '062c3a28393424421debd25fbb2a2479';
$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret."";

$token = getinfo($url);
$token = (array)json_decode($token)  ;
//echo $token["access_token"];   //得到token
$token = $token["access_token"];
//echo $token;
//获得IP
$urlip="https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token=".$token."";
//echo $urlip;
$weixinip = getinfo($urlip);
//print_r($weixinip);
$weixinip = (array)json_decode($weixinip);
$weixinip = $weixinip["ip_list"];

foreach ($weixinip as $key => $value) {
  $valuearr.=$value."#";
  // echo "<br />";
}
//echo $valuearr ;

/**$valuearr = implode($weixinip);  //把数组改成字符串
echo $valuearr ;
*/
 $ipa="101.226.62.77";

if(strpos("#$".$valuearr,$ipa) > 0)
{
    echo "验证成功";
}else
{
    echo "非法请求";exit;
}





function getinfo($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.172 Safari/537.22");
    curl_setopt($ch, CURLOPT_ENCODING ,'gzip'); //加入gzip解析
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}


function getpost($url,$data){ // 模拟提交数据函数
    $curl = curl_init(); // 启动一个CURL会话
    curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
    curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)'); // 模拟用户使用的浏览器
    // curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
    // curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
    curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包x
    curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
    curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
    $tmpInfo = curl_exec($curl); // 执行操作
    if (curl_errno($curl)) {
       echo 'Errno'.curl_error($curl);//捕抓异常
    }
    curl_close($curl); // 关闭CURL会话
    return $tmpInfo; // 返回数据
}
//$result = getpost($url,$xjson);
//var_dump($result);
?>
