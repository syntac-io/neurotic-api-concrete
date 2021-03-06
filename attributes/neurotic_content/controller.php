<?php

namespace Concrete\Package\Neurotic\Attribute\NeuroticContent;

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Attribute\Text\Controller as TextAttribute;
use Concrete\Core\Attribute\FontAwesomeIconFormatter;
use Concrete\Package\Neurotic\Src\Neurotic\DTO\Content;
use Concrete\Package\Neurotic\Src\Neurotic\Traits\WithNeurotic;

class Controller extends TextAttribute
{
	use WithNeurotic;

	/**
	 * Get attribute icon.
	 * 
	 * @return string
	 */
	public function getIconFormatter()
	{
		return new FontAwesomeIconFormatter('file-alt');
	}

	/**
	 * Show attribute form.
	 * 
	 * @return void
	 */
	public function form()
	{
		$contentID = $this->attributeValue ? $this->getValue()->identifier : null;
		$contentTypeID = null;

		$contentTypes = collect($this->neurotic()->contentTypes->all()['items'] ?? [])
			->mapWithKeys(function ($type) {
				return [$type['id'] => $type['name']];
			})->all();
		
		$contents = $this->neurotic()->content->all()['items'] ?? [];

		if ($contentID) {
			$content = $contents[array_search($contentID, array_column($contents, 'identifier'))];
			$contentTypeID = $content['content_type']['id'];
		}

		$this->set('contentTypes', $contentTypes);
		$this->set('contents', $contents);
		$this->set('contentTypeID', $contentTypeID);
		$this->set('contentID', $contentID);
	}

	/**
	 * Get attribute value.
	 */
	public function getValue(): ?Content
	{
		if ($value = $this->attributeValue->getValueObject()) {
			return $this->neurotic()->content->get($value->getValue());
		}

		return null;
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
