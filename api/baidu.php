<?php
/*
 * @link       http://www.girltm.com/
 * @since      1.0.0
 * @package    APOYL_AIARTICLE
 * @subpackage APOYL_AIARTICLE/includes
 * @author     凹凸曼 <jar-c@163.com>
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
class Apoyl_Aiarticle_Baidu {

	
	public function run($cache,$subject,$selrole='') {
		$this->apikey=$cache['apikey'];
		$this->secretkey=$cache['secretkey'];

		$system='';
		if($selrole=='one'){
			$system=',"system":"'.$cache['roleonedesc'].'"';
		}elseif ($selrole=='two'){
			$system=',"system":"'.$cache['roletwodesc'].'"';
		}
		
		$url="https://aip.baidubce.com/rpc/2.0/ai_custom/v1/wenxinworkshop/chat/completions_pro?access_token={$this->getAccessToken()}";
		$postData='{"messages":[{"role":"user","content":"'.$subject.'"}]'.$system.'}';
		$response = $this->httpPost($url,$postData);
		return json_decode($response);
	}
	
	private function getAccessToken(){
		
		$postData = array(
				'grant_type' => 'client_credentials',
				'client_id' => $this->apikey,
				'client_secret' => $this->secretkey
		);

		$url='https://aip.baidubce.com/oauth/2.0/token';
		$response = $this->httpPost($url,$postData);
		$rtn = json_decode($response);

		return $rtn->access_token;
	}
	private function httpPost($url,$param=array())
	{
	     
	    $res = wp_remote_retrieve_body(wp_remote_post($url, array(
	        'timeout' => 30,
	        'body' =>  $param,
	    )));
	     
	
	    return $res;
	}
}

?>
