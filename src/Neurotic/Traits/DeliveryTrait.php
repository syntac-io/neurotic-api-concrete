<?php

namespace Concrete\Package\Neurotic\Src\Neurotic\Traits;

use Concrete\Package\Neurotic\Src\Neurotic\Client;
use Illuminate\Support\Collection;

defined('C5_EXECUTE') or die("Access Denied.");

trait DeliveryTrait
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
	public function get($id): ?array
	{
		return $this->client->fetch(($this->basePath) . '/' . $id);
	}

	/**
	 * Find entries.
	 */
	public function find(array $query): array
	{
		return $this->client->fetch($this->basePath, $query);
	}
}