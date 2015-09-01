<?php
namespace Librette\Queries;

use Nette\Object;

/**
 * @author David Matejka
 */
class SingleItemQuery extends Object implements IQuery, IOuterQuery
{

	/** @var IResultSetQuery */
	private $query;


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
	 * @return mixed|null
	 */
	public function fetch(IQueryable $queryable)
	{
		/** @var IResultSet $result */
		$result = $queryable->getHandler()->fetch($this->query);
		$result->applyPaging(0, 1);
		$items = iterator_to_array($result);

		return $items ? reset($items) : NULL;
	}

}
