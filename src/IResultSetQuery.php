<?php declare(strict_types = 1);

namespace Librette\Queries;

interface IResultSetQuery extends IQuery
{
	public function fetch(IQueryable $queryable): IResultSet;
}
