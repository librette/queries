<?php
namespace LibretteTests\Queries\Mocks;

use Librette\Queries\IQuery;
use Librette\Queries\IQueryable;
use Librette\Queries\IResultSet;
use Librette\Queries\IResultSetQuery;

class UserQuery implements IResultSetQuery
{

	public function fetch(IQueryable $queryable): IResultSet
	{
		return new ResultSet([['name' => 'John'], ['name' => 'Jack']]);
	}
}
