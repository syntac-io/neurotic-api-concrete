<?php

namespace Concrete\Package\Neurotic\Attribute\NeuroticContent;

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Attribute\Text\Controller as TextAttribute;
use Concrete\Core\Attribute\FontAwesomeIconFormatter;
use Concrete\Package\Neurotic\Src\Neurotic;

class Controller extends TextAttribute
{
	/**
	 * Get attribute icon.
	 * 
	 * @return string
	 */
	public function getIconFormatter()
	{
		return new FontAwesomeIconFormatter('home');
	}

	/**
	 * Show attribute form.
	 * 
	 * @return void
	 */
	public function form()
	{
		// Set default values
		$contentID = null;
		$contents = [];
		$contentTypeID = null;
		$contentTypes = [];

		// Set content ID if available
		if (is_object($this->attributeValue)) {
			$contentID = $this->attributeValue->getValue();
		}

		// Hybernate content types and contents
		foreach (Neurotic::get('/content_type')['items'] ?? [] as $contentType) {
			$contentTypes[$contentType['id']] = $contentType['name'];
			$contents[$contentType['id']] = [];

			foreach (Neurotic::get('/content_type/' . $contentType['identifier'] . '/content')['items'] ?? [] as $content) {
				$name = $content['properties'][array_search('name', array_column($content['properties'], 'identifier'))]['value'] ?? null;
				$title = $content['properties'][array_search('title', array_column($content['properties'], 'identifier'))]['value'] ?? null;
				$contents[$contentType['id']][$content['identifier']] = $name ?? $title ?? $content['identifier'];

				// Set current content type ID
				if ($content['identifier'] === $contentID) {
					$contentTypeID = $contentType['id'];
				}
			}
		}

		// Set form variables
		$this->set('contentID', $contentID);
		$this->set('contents', $contents);
		$this->set('contentTypes', $contentTypes);
		$this->set('contentTypeID', $contentTypeID);
	}

	/**
	 * Get attribute value.
	 */
	public function getValue()
	{
		if ($value = $this->attributeValue->getValueObject()) {
			$contentID = $value->getValue();
			
			return Neurotic::get('/content/' . $contentID);
		}
	}

	/**
	 * Get search index value.
	 * 
	 * @return mixed
	 */
	public function getSearchIndexValue()
	{
		if ($this->attributeValue) {
			// @TODO Make sure that this returns the actual JSON object
			return $this->attributeValue->getValueObject()->getValue();
		}
	}
}
