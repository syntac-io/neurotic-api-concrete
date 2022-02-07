<?php

namespace Concrete\Package\Neurotic\Src\Neurotic;

use Concrete\Package\Neurotic\Src\Neurotic\Traits\DeliveryTrait;

class Content
{
	use DeliveryTrait;

	/**
	 * @var string
	 */
	protected string $basePath = '/content';
}