<?php

namespace Concrete\Package\Neurotic\Src\Neurotic\Repository;

use Concrete\Package\Neurotic\Src\Neurotic\DTO\ContentType as DTOContentType;
use Concrete\Package\Neurotic\Src\Neurotic\Repository;

class ContentType extends Repository
{
	/**
	 * @var string
	 */
	protected string $basePath = '/content_type';

	/**
	 * @var string
	 */
	protected string $DTO = DTOContentType::class;
}