<?php
namespace LibretteTests\Queries\Mocks;

use Librette\Queries\IQuery;
use Librette\Queries\IQueryModifier;

class QueryModifier implements IQueryModifier
{
	public $queries = [];


	public function modify(IQuery $query): void
	{
		$this->queries[] = $query;
	}
}
