<?php

namespace Alipay\OpenAPISDKV2\Test;

use Alipay\OpenAPISDKV2\AlipayConfig;
use Alipay\OpenAPISDKV2\AopCertClient;
use Alipay\OpenAPISDKV2\AopClient;

use Alipay\OpenAPISDKV2\request\AlipayTradePrecreateRequest;


//$dir = __DIR__ . '/../request/';
//// 打开目录
//if ($handle = opendir($dir)) {
//    $num = 0;
//    // 循环读取目录下的文件
//    while (false !== ($file = readdir($handle))) {
//
//        // 忽略"."和".."以及非文件类型的项
//        if ($file != "." && $file != ".." && is_file($dir . '/' . $file)) {
//            $num++;
//            // 获取文件完整路径
//            $filePath = $dir . '/' . $file;
//
//            // 读取文件内容
//            $content = file_get_contents($filePath);
//
//            // 修改文件内容（这里仅为示例，添加了一些文本）
//            $modifiedContent = substr_replace($content, "<?php \n namespace Alipay\\OpenAPISDKV2\\request;", 0, 5);
//
//            // 将修改后的内容写回文件
//            file_put_contents($filePath, $modifiedContent);
//
//            echo "文件 {$file} 修改成功。\n";
////            break;
//        }
//    }
//
//    // 关闭目录
//    closedir($handle);
//}
////echo $dir;
//echo "文件总数量:(" . $num . ')---';
//die();


require_once __DIR__ . '/../../../vendor/autoload.php';

$app_cert_path = "/Users/YuanHong/Desktop/mlzf/zfb/appCertPublicKey_2021004162657720.crt";
$alipay_cert_path = "/Users/YuanHong/Desktop/mlzf/zfb/alipayCertPublicKey_RSA2.crt";
$alipay_root_cert_path = "/Users/YuanHong/Desktop/mlzf/zfb/alipayRootCert.crt";
$url = "https://openapi.alipay.com/gateway.do";
$app_id = "";
$privateKey = "";

// 证书模式的测试
$alipayConfig = new AlipayConfig();
$alipayConfig->setAppId($app_id);
$alipayConfig->setCharset("utf-8");
$alipayConfig->setFormat("json");
$alipayConfig->setSignType("RSA2");
$alipayConfig->setServerUrl($url);
$alipayConfig->setPrivateKey($privateKey);

// content 和 path 只需要设置一个即可
$alipayConfig->setAppCertPath($app_cert_path);
//$alipayConfig->setAppCertContent()
$alipayConfig->setAlipayPublicCertPath($alipay_cert_path);
//$alipayConfig->setAlipayPublicCertContent()
$alipayConfig->setRootCertPath($alipay_root_cert_path);
//$alipayConfig->setRootCertContent()
$aop = new AopCertClient($alipayConfig);
$aop->isCheckAlipayPublicCert = true;
$parameter = "{" .
    "\"out_trade_no\":\"20140320010107002\"," .
    "\"total_amount\":\"12225\"," .
    "\"subject\":\"Iphone6 65G\"," .
    "\"store_id\":\"CD_001\"," .
    "\"timeout_express\":\"100m\"}";
$request = new AlipayTradePrecreateRequest();
$request->setBizContent($parameter);
$response = $aop->execute($request);
$responseApiName = str_replace(".", "_", $request->getApiMethodName()) . "_response";
// 拿到结果
$responseResult = $response->$responseApiName;
var_dump($responseResult);

die();
//普通方式的测试

$$url = "https://openapi.alipaydev.com/gateway.do";
$app_id = "your_appId";
$privateKey = "your_privateKey";
$publicKey = "your_publicKey";

$config = new AlipayConfig();
$config->setAppId($app_id);
$config->setCharset("utf-8");
$config->setFormat("json");
$config->setSignType("RSA2");
$config->setServerUrl($url);
$config->setPrivateKey($privateKey);
$config->setAlipayPublicKey($publicKey);


$aop = new AopClient($config);

$parameter = "{" .
    "\"out_trade_no\":\"20140320010107002\"," .
    "\"total_amount\":\"12225\"," .
    "\"subject\":\"Iphone6 65G\"," .
    "\"store_id\":\"CD_001\"," .
    "\"timeout_express\":\"100m\"}";
$request = new AlipayTradePrecreateRequest ();
$request->setBizContent($parameter);
$response = $aop->execute($request);
$responseApiName = str_replace(".", "_", $request->getApiMethodName()) . "_response";
// 拿到结果
$responseResult = $response->$responseApiName;
echo var_dump($responseResult), PHP_EOL;
