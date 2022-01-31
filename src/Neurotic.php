<?php

namespace Concrete\Package\Neurotic\Src;

defined('C5_EXECUTE') or die('Access Denied');

class Neurotic
{
	/**
	 * Get JSON data.
	 * 
	 * @param string $path
	 * @return null|array
	 */
	public static function get(string $path)
	{
		$filePath = __DIR__ . '/../cache' . $path . '.json';

		return file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : null;
	}

	/**
	 * Fetch API call.
	 * 
	 * @param string $path
	 * @return null|array
	 */
	public static function fetch(string $path): ?array
	{
		$config = \Core::make('config');
		$origin = $config->get('neurotic.origin');
		$token = $config->get('neurotic.api_token');

		$url = $origin . '/api' . $path . '?api_token=' . $token;
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);

		$result = curl_exec($ch);

		return json_decode($result, true);
	}

	/**
	 * Sync Neurotic files.
	 * 
	 * @return void
	 */
	public static function sync()
	{
		$cachePath = __DIR__ . '/../cache';
		$contentTypes = static::fetch('/content_type');

		if (is_dir($cachePath)) {
			system("rm -rf " . escapeshellarg($cachePath));
		}

		mkdir($cachePath, 0777);
		touch($cachePath . '/content_type.json');
		file_put_contents($cachePath . '/content_type.json', json_encode($contentTypes));

		if (isset($contentTypes['items'])) {
			foreach ($contentTypes['items'] as $contentType) {
				mkdir($cachePath . '/content_type/' . $contentType['identifier'] . '/content', 0777, true);

				$contentType = static::fetch('/content_type/' . $contentType['identifier']);

				touch($cachePath . '/content_type/' . $contentType['identifier'] . '.json');
				file_put_contents($cachePath . '/content_type/' . $contentType['identifier'] . '.json', json_encode($contentType));

				$contents = static::fetch('/content_type/' . $contentType['identifier'] . '/content');

				touch($cachePath . '/content_type/' . $contentType['identifier'] . '/content.json');
				file_put_contents($cachePath . '/content_type/' . $contentType['identifier'] . '/content.json', json_encode($contents));
				
				if (isset($contents['items'])) {
					foreach ($contents['items'] as $content) {
						$content = static::fetch('/content_type/' . $contentType['identifier'] . '/content/' . $content['identifier']);
						
						touch($cachePath . '/content_type/' . $contentType['identifier'] . '/content/' . $content['identifier'] . '.json');
						file_put_contents($cachePath . '/content_type/' . $contentType['identifier'] . '/content/' . $content['identifier'] . '.json', json_encode($content));
					}
				}
			}
		}
	}
}
