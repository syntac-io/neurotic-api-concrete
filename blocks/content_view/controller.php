<?php

namespace Concrete\Package\Neurotic\Block\ContentView;

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Block\BlockController;
use Concrete\Package\Neurotic\Src\Neurotic;
use Illuminate\Support\Collection;

class Controller extends BlockController
{
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
		$result = glob('packages/neurotic/cache/content_type/**/content/' . $this->bContentIdentifier . '.json');
		$content = $result ? json_decode(file_get_contents($result[0]), true) : null;
		$properties = [];

		if ($content) {
			$properties = (new Collection($content['properties']))->mapWithKeys(function ($property) {
				return [$property['identifier'] => $property['value']];
			})->all();
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
		$contentTypes = [];
		$contents = [];
		$contentTypeID = null;
		$contentID = $this->bContentIdentifier;

		foreach (Neurotic::get('/content_type')['items'] ?? [] as $contentType) {
			$contentTypes[$contentType['id']] = $contentType['name'];
			$contents[$contentType['id']] = [];

			foreach (Neurotic::get('/content_type/' . $contentType['identifier'] . '/content')['items'] ?? [] as $content) {
				$name = $content['properties'][array_search('name', array_column($content['properties'], 'identifier'))]['value'] ?? null;
				$title = $content['properties'][array_search('title', array_column($content['properties'], 'identifier'))]['value'] ?? null;
				$contents[$contentType['id']][$content['identifier']] = $name ?? $title ?? $content['identifier'];

				if ($contentID === $content['identifier']) {
					$contentTypeID = $contentType['id'];
				}
			}
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
