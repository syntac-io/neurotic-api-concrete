<?php

namespace Concrete\Package\Neurotic\Src\Neurotic;

defined('C5_EXECUTE') or die("Access Denied.");

use Concrete\Package\Neurotic\Src\Neurotic\Client;

class Repository
{
	/**
	 * @var Client
	 */
	protected Client $client;

	/**
	 * Create new delivery instance.
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	/**
	 * Get all entries.
	 */
	public function all(): array
	{
		return $this->client->fetch($this->basePath ?? '/');
	}
	
	/**
	 * Get entry.
	 */
	public function get($id)
	{
		$result = $this->client->fetch(($this->basePath) . '/' . $id);
		
		return $result ? new $this->DTO($result) : null;
	}
}