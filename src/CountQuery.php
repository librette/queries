<?php
namespace Librette\Queries;

use Nette\Object;

/**
 * @author David Matejka
 */
class CountQuery extends Object implements IQuery, IOuterQuery
{

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
