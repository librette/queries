<?php declare(strict_types = 1);

namespace Librette\Queries;

use Nette\SmartObject;

/**
 * @author David Matejka
 */
class CountQuery implements IQuery, IOuterQuery
{
	use SmartObject;

	/** @var IResultSetQuery */
	private $query;


	public function __construct(IResultSetQuery $query)
	{
		$this->query = $query;
	}


	public function getInnerQuery(): IQuery
	{
		return $this->query;
	}


	public function fetch(IQueryable $queryable): int
	{
		$result = $queryable->getHandler()->fetch($this->query);

		return $result->getTotalCount();
	}
}
