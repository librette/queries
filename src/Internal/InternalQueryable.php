<?php declare(strict_types = 1);

namespace Librette\Queries\Internal;

use Librette\Queries\IQueryable;
use Librette\Queries\IQueryHandler;
use Nette\SmartObject;

class InternalQueryable implements IQueryable
{
	use SmartObject;

	/** @var IQueryHandler */
	private $queryHandler;


	public function __construct(IQueryHandler $queryHandler)
	{
		$this->queryHandler = $queryHandler;
	}


	public function getHandler(): IQueryHandler
	{
		return $this->queryHandler;
	}
}
