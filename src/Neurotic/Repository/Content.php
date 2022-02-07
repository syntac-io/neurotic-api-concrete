<?php

namespace Concrete\Package\Neurotic\Src\Neurotic\Repository;

use Concrete\Package\Neurotic\Src\Neurotic\DTO\Content as DTOContent;
use Concrete\Package\Neurotic\Src\Neurotic\Repository;

class Content extends Repository
{
	/**
	 * @var string
	 */
	protected string $basePath = '/content';
	
	/**
	 * @var string
	 */
	protected string $DTO = DTOContent::class;

	/**
	 * Get content by content type.
	 */
	public function getByContentType(string $identifier)
	{
		return $this->client->fetch('/content_type/' . $identifier . '/content');
	}
}