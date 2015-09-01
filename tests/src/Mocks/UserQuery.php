<?php
namespace LibretteTests\Queries\Mocks;

use Librette\Queries\IQuery;
use Librette\Queries\IQueryable;
use Librette\Queries\IResultSetQuery;

/**
 * @author David Matejka
 */
class UserQuery implements IResultSetQuery
{

	public function fetch(IQueryable $queryable)
	{
		return new ResultSet([['name' => 'John'], ['name' => 'Jack']]);
	}

}
