<?php

namespace Concrete\Package\Neurotic\Src\Neurotic\Traits;

use Concrete\Package\Neurotic\Src\Neurotic\Client;

defined('C5_EXECUTE') or die("Access Denied.");

trait WithNeurotic
{
	/**
	 * @var Client
	 */
	protected static $client;

	/**
	 * Get or create new instance of Neurotic Client.
	 */
	public function neurotic(): Client
	{
		$client = static::$client;

		if (!$client instanceof Client) {
			$config = \Config::get('neurotic');
			static::$client = $client = new Client($config['origin'], $config['api_token']);
		}

		return $client;
	}
}