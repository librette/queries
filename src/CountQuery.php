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


	/**
	 * @param IResultSetQuery
	 */
	public function __construct(IResultSetQuery $query)
	{
		$this->query = $query;
	}


	/**
	 * @return IQuery
	 */
	public function getInnerQuery()
	{
		return $this->query;
	}


	/**
	 * @param IQueryable
	 * @return int
	 */
	public function fetch(IQueryable $queryable)
	{
		$result = $queryable->getHandler()->fetch($this->query);

		return $result->getTotalCount();
	}

}
