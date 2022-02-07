<?php

namespace Concrete\Package\Neurotic\Src\Neurotic\DTO;

defined('C5_EXECUTE') or die("Access Denied.");

use Concrete\Package\Neurotic\Src\Neurotic\DTO;

class Content extends DTO
{
	/**
	 * Get all property values.
	 */
	public function properties()
	{
		return collect($this->properties)->mapWithKeys(function ($property) {
			return [$property['identifier'] => $property['value']];
		})->all();
	}

	/**
	 * Get property value.
	 */
	public function property(string $identifier, $default = null)
	{
		return $this->properties()[$identifier] ?? $default;
	}
}