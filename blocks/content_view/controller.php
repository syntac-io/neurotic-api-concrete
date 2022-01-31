<?php

namespace Concrete\Package\Neurotic\Block\ContentView;

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
		$content = Neurotic::get('/content/' . $this->bContentIdentifier);

		$this->set('content', $content);
	}
}
