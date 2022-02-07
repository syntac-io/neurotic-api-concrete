<?php

namespace Concrete\Package\Neurotic\Controller\SinglePage\Dashboard;

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Package\PackageService;
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
        $this->set('package', $this->app->make(PackageService::class)->getByHandle('neurotic'));
		$this->set('apiToken', \Config::get('neurotic.api_token'));
		$this->set('origin', \Config::get('neurotic.origin'));
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
			\Config::save('neurotic.api_token', $apiToken);
			\Config::save('neurotic.origin', $origin);

			$this->set('success', t('Settings are successfully saved.'));
		}

		$this->set('errors', $errors);
		$this->view();
	}
}
