<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "fanli");
$wechatObj = new wechatCallbackapiTest();
//$wechatObj->valid();
$wechatObj->responseMsg();

class wechatCallbackapiTest
{
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
		}else{
			echo "<h>This is default response!</h1>";
		}
    }

    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		if (!empty($postStr)){
                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                   the best way is to check the validity of xml by yourself */
                libxml_disable_entity_loader(true);
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                //$keyword = trim($postObj->Content);
				$rcvMsgtype=$postObj->MsgType;
				if($rcvMsgtype=="image"){
					$rcvPicUrl=$postObj->PicUrl;
				}
				if($rcvMsgtype=="text"){
					$keyword = trim($postObj->Content);
				}
                $time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";             
				if($rcvMsgtype=="text"&&!empty( $keyword ))
                {
              		$msgType = "text";
					$contentStr = "欢迎关注书儿~";
					//$dinfo="to:".$toUsername." from:".$fromUsername." keyword".$keyword." Type:".$rcvMsgtype;

					//$dinfo="to:".$toUsername." from:".$fromUsername."Type:".$rcvMsgtype."picUrl:".$rcvPicUrl;
					if($rcvMsgtype=="text"){
						$dinfo="text response!";
					}else{
						$dinfo="image response!";
					}
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $dinfo);
                	echo $resultStr;
                }else if($rcvMsgtype=="image"){
              		$msgType = "text";
					$contentStr = "Image haha!".$rcvPicUrl;

                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                	echo $resultStr;
				}else{
					//default response--
              		$msgType = "text";
					$contentStr = "您的消息书儿我看不懂哦~";

                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                	echo $resultStr;
				}

        }else {
        	echo "";
        	exit;
        }
    }
		
	private function checkSignature()
	{
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}

?>
