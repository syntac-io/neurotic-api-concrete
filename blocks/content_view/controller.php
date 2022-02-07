<?php

namespace Concrete\Package\Neurotic\Block\ContentView;

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Block\BlockController;
use Concrete\Package\Neurotic\Src\Neurotic\Client as Neurotic;
use Concrete\Package\Neurotic\Src\Neurotic\Traits\NeuroticAwareTrait;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class Controller extends BlockController
{
	use NeuroticAwareTrait;

	/**
	 * @var string
	 */
	protected $btDefaultSet = 'neurotic';
	
	/**
	 * @var string
	 */
	protected $btTable = 'btContentViews';
	
	/**
	 * Block type name.
	 * 
	 * @return string
	 */
	public function getBlockTypeName(): string
    {
        return t('Content View');
    }

	/**
	 * Block type description.
	 * 
	 * @return string
	 */
    public function getBlockTypeDescription(): string
    {
        return t('Adds a content view to your page.');
    }

	/**
	 * Show content view.
	 * 
	 * @return void
	 */
	public function view()
	{
		$content = $this->neurotic()->content->get($this->bContentIdentifier);
		$properties = [];

		if ($content) {
			$properties = collect($content->properties)
				->mapWithKeys(function ($property) {
					return [$property['identifier'] => $property['value']];
				})
				->all();
		}

		$this->set('content', $content);
		$this->set('properties', $properties);
	}

	/**
	 * Initialize block form.
	 * 
	 * @return void
	 */
	public function form()
	{
		$contentID = $this->bContentIdentifier;
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
	 * Initialize add block form.
	 * 
	 * @return void
	 */
	public function add(): void
	{
		$this->form();
	}
	
	/**
	 * Initialize edit block form.
	 * 
	 * @return void
	 */
	public function edit(): void
	{
		$this->form();
	}
}
