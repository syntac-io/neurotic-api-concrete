<?php

namespace Concrete\Package\Neurotic\Src\Neurotic;

use Concrete\Core\Feed\GuzzleClient;

defined('C5_EXECUTE') or die("Access Denied.");

class Client
{
	/**
	 * @var string
	 */
	protected string $origin, $token;

	/**
	 * @var Content
	 */
	protected Content $content;
	
	/**
	 * @var ContentType
	 */
	protected ContentType $contentTypes;

	/**
	 * Create new new instance of Neurotic.
	 */
	public function __construct(string $origin, string $token)
	{
		$this->origin = $origin;
		$this->token = $token;
		$this->content = new Content($this);
		$this->contentTypes = new ContentType($this);
	}

	/**
	 * Fetch data from API.
	 */
	public function fetch(string $path, array $query = []): array
	{
		$cacheDir = __DIR__ . '/../../../../application/files/cache/neurotic';
		$filePath = $cacheDir . $path . '.json';

		if (!is_dir($cacheDir . '/content_type')) {
			mkdir($cacheDir . '/content_type', 0777, true);
		}
		if (!is_dir($cacheDir . '/content')) {
			mkdir($cacheDir . '/content', 0777, true);
		}

		if (!file_exists($filePath)) {
			$url = $this->origin . '/api' . $path . '?api_token=' . $this->token;
			$response = (new GuzzleClient())->get($url);
			
			touch($filePath);
			file_put_contents($filePath, $response->getBody());

			return json_decode($response->getBody(), true);
		}
		
		return json_decode(file_get_contents($filePath), true);
	}

	/**
	 * Magic getter.
	 */
	public function __get(string $name)
	{
		if ('content' === $name) {
			return $this->content;
		}
		if ('contentTypes' === $name) {
			return $this->contentTypes;
		}
	}
}