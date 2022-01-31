<?php

namespace Concrete\Package\Neurotic\Block\ContentList;

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Block\BlockController;
use Concrete\Package\Neurotic\Src\Neurotic;

class Controller extends BlockController
{
	/**
	 * @var string
	 */
	protected $btDefaultSet = 'neurotic';
	
	/**
	 * @var string
	 */
	protected $btTable = 'btContentLists';

	/**
	 * Block type name.
	 * 
	 * @return string
	 */
	public function getBlockTypeName(): string
    {
        return t('Content List');
    }

	/**
	 * Block type description.
	 * 
	 * @return string
	 */
    public function getBlockTypeDescription(): string
    {
        return t('Adds a content list to your page.');
    }

	/**
	 * Show block type default view.
	 * 
	 * @return void
	 */
	public function view(): void
	{
		$contents = Neurotic::get('/content_type/' . $this->bContentTypeIdentifier . '/content');

		$this->set('contents', $contents);
	}
	
	/**
	 * Show add form.
	 * 
	 * @return void
	 */
	public function add(): void
	{
		$result = Neurotic::get('/content_type');
		$contentTypes = [];

		if (isset($result['items'])) {
			foreach ($result['items'] as $contentType) {
				$contentTypes[$contentType['identifier']] = $contentType['name'];
			}
			asort($contentTypes);
		}

		$this->set('contentTypes', $contentTypes);
	}
	
	/**
	 * Show add form.
	 * 
	 * @return void
	 */
	public function edit(): void
	{
		$this->add();
	}
}
