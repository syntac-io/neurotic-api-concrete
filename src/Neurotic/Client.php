<?php

namespace Concrete\Package\Neurotic\Src\Neurotic;

use Concrete\Core\Feed\GuzzleClient;
use Concrete\Package\Neurotic\Src\Neurotic\Repository\Content;
use Concrete\Package\Neurotic\Src\Neurotic\Repository\ContentType;

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
	public function fetch(string $path, array $query = []): ?array
	{
		$cacheDir = __DIR__ . '/../../../../application/files/cache/neurotic';
		$fileDir = $cacheDir . $path;
		$filePath = $fileDir . '/index.json';

		if (!file_exists($filePath)) {
			try {
				$url = $this->origin . '/api' . $path . '?api_token=' . $this->token;
				$response = (new GuzzleClient())->get($url);
				
				if (!is_dir($fileDir)) {
					mkdir($fileDir, 0777, true);
				}

				touch($filePath);
				file_put_contents($filePath, $response->getBody());

				return json_decode($response->getBody(), true);
			} catch(\Throwable $e) {
				dd($e);
			}
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