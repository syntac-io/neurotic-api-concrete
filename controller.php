<?php

namespace Concrete\Package\Neurotic;

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Block\BlockType\BlockType;
use Concrete\Core\Block\BlockType\Set;
use Concrete\Core\Package\Package;
use Concrete\Core\Page\Single;

class Controller extends Package
{
	/**
	 * @var string
	 */
	protected $pkgHandle = 'neurotic';
	protected $appVersionRequired = '5.8';
	protected $pkgVersion = '1.0.0';

	/**
	 * Get package name.
	 * 
	 * @return string
	 */
	public function getPackageName(): string
	{
		return t('Neurotic');
	}

	/**
	 * Get package description.
	 * 
	 * @return string
	 */
	public function getPackageDescription()
	{
		return t('Adds Neurotic API support to your ConcreteCMS installation.');
	}

	/**
	 * Install package.
	 * 
	 * @return void
	 */
	public function install(): void
	{
		$pkg = parent::install();

		// Install block type set
		Set::add('neurotic', 'Neurotic', $pkg);
		
		// Install block types
		BlockType::installBlockType('content_list', $pkg);
		BlockType::installBlockType('content_view', $pkg);

		// Install single pages
		Single::add('/dashboard/neurotic', $pkg);

		// Generate configuration file
		$config = \Core::make('config');
		$config->save('neurotic.origin', null);
		$config->save('neurotic.api_token', null);
	}
}
