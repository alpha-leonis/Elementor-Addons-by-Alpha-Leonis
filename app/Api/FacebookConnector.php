<?php

namespace AlphaLeonisAddons\Api;

use Facebook\Facebook;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
* Facebook API class
*/
class FacebookConnector
{
	private $facebook;

	private $appId;

	private $appSecret;

	private $pageId;

	public function __construct($appId, $appSecret, $pageId)
	{
		$this->appId = $appId;
		$this->appSecret = $appSecret;
		$this->pageId = $pageId;

		$this->facebook = new Facebook([
			'app_id' => $appId,
			'app_secret' => $appSecret,
			'default_graph_version' => 'v2.10',
			//'default_access_token' => '', // optional
		]);
	}

	public function getPagePosts($numberOfPosts) {
		$helper = $this->facebook->getRedirectLoginHelper();
		
		try {
			$fields = 'created_time,attachments,message,object_attachment,likes.limit(0).summary(true),comments.limit(0).summary(true)';
			$response = $this->facebook->get('/'.$this->pageId.'?fields=feed.limit('.$numberOfPosts.'){'.$fields.'}', $this->appId.'|'.$this->appSecret);
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}

		$data = $response->getDecodedBody()['feed']['data'];

		return $data;
	}
}
