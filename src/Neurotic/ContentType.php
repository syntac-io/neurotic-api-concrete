<?php

namespace Concrete\Package\Neurotic\Src\Neurotic;

use Concrete\Package\Neurotic\Src\Neurotic\Traits\DeliveryTrait;

class ContentType
{
	use DeliveryTrait;

	/**
	 * @var string
	 */
	protected string $basePath = '/content_type';
}