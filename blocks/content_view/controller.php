<?php

namespace Concrete\Package\Neurotic\Block\ContentView;

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Block\BlockController;

class Controller extends BlockController
{
	/**
	 * @var string
	 */
	protected $btDefaultSet = 'neurotic';
	
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
}
