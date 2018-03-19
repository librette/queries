<?php declare(strict_types = 1);

namespace Librette\Queries;

/**
 * @author David Matejka
 */
interface IResultSetQuery extends IQuery
{

	/**
	 * @param IQueryable $queryable
	 * @return IResultSet
	 */
	public function fetch(IQueryable $queryable);

}
