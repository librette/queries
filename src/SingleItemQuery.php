<?php declare(strict_types = 1);

namespace Librette\Queries;

use Nette\SmartObject;

class SingleItemQuery implements IQuery, IOuterQuery
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


	/**
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
