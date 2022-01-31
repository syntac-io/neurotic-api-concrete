<?php

namespace Concrete\Package\Neurotic\Src;

defined('C5_EXECUTE') or die('Access Denied');

use Concrete\Core\Feed\GuzzleClient;

class Neurotic
{
	/**
	 * Create new HTTP request.
	 * 
	 * @param string $path
	 * @return null|array
	 */
	public static function get(string $path)
	{
		$config = \Core::make('config');	
		$apiToken = $config->get('neurotic.api_token');
		$origin = $config->get('neurotic.origin');
		$url = $origin . '/api' . $path . '?api_token=' . $apiToken;
 
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		$result = curl_exec($ch);

		return json_decode($result, true);
	}
}