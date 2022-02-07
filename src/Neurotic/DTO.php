<?php

namespace Concrete\Package\Neurotic\Src\Neurotic;

defined('C5_EXECUTE') or die("Access Denied.");

class DTO
{
	/**
	 * @var array
	 */
	protected array $data = [];

	/**
	 * Create a new instance of DTO.
	 */
	public function __construct(array $data = [])
	{
		$this->data = $data;
	}

	/**
	 * Check if data exists.
	 */
	public function has(string $name): bool
	{
		return array_key_exists($name, $this->data);
	}

	/**
	 * Magic getter.
	 */
	public function __get(string $name)
	{
		return $this->has($name) ? $this->data[$name] : null;
	}
	
	/**
	 * Magic setter.
	 */
	public function __set(string $name, $value)
	{
		if ($this->has($name)) {
			$this->data[$name] = $value;
		}
	}
}