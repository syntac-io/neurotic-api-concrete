<?php

namespace Concrete\Package\Neurotic\Block\ContentList;

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Block\BlockController;
use Concrete\Package\Neurotic\Src\Neurotic;
use Concrete\Package\Neurotic\Src\Neurotic\Traits\WithNeurotic;

class Controller extends BlockController
{
	use WithNeurotic;

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
		$contentType = $this->neurotic()->contentTypes->get($this->bContentTypeIdentifier);
		$contents = $contentType->contents();

		if ($this->get('order_by') === 'date_asc') {
			usort($contents, function ($a, $b) {
				return $a->created_at > $b->created_at ? 1 : -1;
			});
		}
		
		if ($this->get('order_by') === 'date_desc') {
			usort($contents, function ($a, $b) {
				return $a->created_at > $b->created_at ? -1 : 1;
			});
		}

		$this->set('contents', $contents);
	}
	
	/**
	 * Show add form.
	 * 
	 * @return void
	 */
	public function add(): void
	{
		$contentTypes = collect($this->neurotic()->contentTypes->all()['items'] ?? [])
			->mapWithKeys(function ($type) {
				return [$type['identifier'] => $type['name']];
			})->all();

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
