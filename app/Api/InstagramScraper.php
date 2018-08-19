<?php

namespace AlphaLeonisAddons\Api;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Instagram scraper
 */
class InstagramScraper
{
	/**
	 * Get user data
	 *
	 * @param string $username
	 */
	private function getUserData($username)
	{
		$username = strtolower($username);

		if (false === ($data = get_transient('instagram-a5-'.sanitize_title_with_dashes($username)))) {
			$insta_source = file_get_contents('http://instagram.com/'.$username);
			$shards = explode('window._sharedData = ', $insta_source);
			$insta_json = explode(';</script>', $shards[1]); 
			$data = json_decode($insta_json[0], TRUE);

			if (!empty($data)) {
				$hashData = base64_encode(serialize($data));
				set_transient('instagram-a5-'.sanitize_title_with_dashes($username), $hashData, apply_filters('null_instagram_cache_time', HOUR_IN_SECONDS * 2));
			}

			return $data;
		} 

		if (!empty($data)) {
			return unserialize(base64_decode($data));
		} 
	}

	/**
	 * Get images of instagram users
	 * 
	 * @param  string $username
	 * @param  int $limit
	 * @return array
	 */
	public function getUserImages($username, $limit = 12)
	{
		$instagramData = $this->getUserData($username);

		$scrapedImages = $instagramData['entry_data']['ProfilePage'][0]['user']['media']['nodes'];

		$images = array();

		$imagesCount = 0;

		foreach ($scrapedImages as $scrapedImage) {

			$scrapedImage['thumbnail_src'] = preg_replace('/^https?\:/i', '', $scrapedImage['thumbnail_src']);
			$scrapedImage['display_src'] = preg_replace('/^https?\:/i', '', $scrapedImage['display_src']);

			$images[] = array(
				'description'   => !empty($scrapedImage['caption']) ? $scrapedImage['caption'] : __('Instagram Image', 'al-el-addons'),
				'link'		  	=> trailingslashit('//instagram.com/p/'.$scrapedImage['code']),
				'time'		  	=> $scrapedImage['date'],
				'comments'	  	=> $scrapedImage['comments']['count'],
				'likes'		 	=> $scrapedImage['likes']['count'],
				'large'			=> $scrapedImage['thumbnail_src'],
				'original'		=> $scrapedImage['display_src'],
				'type'		  	=> $scrapedImage['is_video'] == true ? 'video' : 'image',
				'date'			=> $scrapedImage['date']
			);

			if(++$imagesCount == $limit) break;
		}

		return $images;
	}
}