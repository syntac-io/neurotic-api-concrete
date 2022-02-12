<?php

namespace Concrete\Package\Neurotic\Src\Neurotic\DTO;

defined('C5_EXECUTE') or die("Access Denied.");

use Concrete\Package\Neurotic\Src\Neurotic\DTO;

class ContentType extends DTO
{
	/**
	 * Get all content items.
	 */
	public function contents(): array {
		$result = $this->neurotic()->contents->getByContentType($this->data['identifier']);
		$payload = [];
		
		foreach ($result['items'] ?? [] as $content) {
			$payload[$content['identifier']] = new Content($content);
		}

		return $payload;
	}
}