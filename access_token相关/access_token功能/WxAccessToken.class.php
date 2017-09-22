<?php

    class WxAccessToken
	{
		private $access_token;
		private $appid;
		private $appsecret;
		
		public function __construct($appid, $appsecret)
		{
			if(!$appid || $appsecret)
			{
				exit('param error!');
			}
            $this->appid = $appid;
            $this->appsecret = $appsecret;			
		}
		
		private function getAccessTokenData()
		{
			$url = 'https://api.weixin.qq.com/cig-bin/token?grant_type=client_credential&appid='.$this->appid.'&secret='.$this->appsecret;
			return json_decode(file_get_contents($url), true);
		}
		
		public function getAccessToken()
		{
			$a_t_data = $this->getAccessTokenData();
			return $a_t_data['acess_token'];
		}
		
	}
	
	
	