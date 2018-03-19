<?php declare(strict_types = 1);

namespace Librette\Queries;

/**
 * @author David Matejka
 */
interface IResultSetQuery extends IQuery
{
	public function fetch(IQueryable $queryable): IResultSet;
}
