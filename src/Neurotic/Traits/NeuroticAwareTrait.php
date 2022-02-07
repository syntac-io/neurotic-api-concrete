<?php

namespace Concrete\Package\Neurotic\Src\Neurotic\Traits;

use Concrete\Package\Neurotic\Src\Neurotic\Client;

defined('C5_EXECUTE') or die("Access Denied.");

trait NeuroticAwareTrait
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
			$config = \Core::make('config');

			static::$client = $client = new Client(
				$config->get('neurotic.origin'),
				$config->get('neurotic.api_token')
			);
		}

		return $client;
	}
}