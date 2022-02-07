<?php

namespace Concrete\Package\Neurotic\Controller\SinglePage\Dashboard;

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Package\Package;
use Concrete\Core\Page\Controller\DashboardPageController;

class Neurotic extends DashboardPageController
{
	/**
	 * Show neurotic dashboard page.
	 * 
	 * @return void
	 */
    public function view()
    {
        $package = Package::getByHandle('neurotic');
		$config = \Core::make('config');
		$apiToken = $config->get('neurotic.api_token');
		$origin = $config->get('neurotic.origin');

		$this->set('package', $package);
		$this->set('apiToken', $apiToken);
		$this->set('origin', $origin);
    }

	/**
	 * Submit method.
	 */
	public function submit()
	{
		$origin = $this->post('origin');
		$apiToken = $this->post('api_token');
		$errors = [];
		
		if (!$origin) {
			$errors['origin'] = t('The origin field is required and cannot be empty.');
		}
		else if (!filter_var($origin, FILTER_VALIDATE_URL)) {
			$errors['origin'] = t('The origin field must be a valid url.');
		}
		
		if (!$apiToken) {
			$errors['api_token'] = t('The API token field is required and cannot be empty.');
		}

		if (!$errors) {
			$config = \Core::make('config');
			$config->save('neurotic.api_token', $apiToken);
			$config->save('neurotic.origin', $origin);

			$this->set('success', t('Settings are successfully saved.'));
		}

		$this->set('errors', $errors);
		$this->view();
	}
}
