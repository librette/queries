<?php
namespace LibretteTests\Queries\Mocks;

use Librette\Queries\IQuery;
use Librette\Queries\IQueryable;
use Librette\Queries\IQueryHandler;

/**
 * @author David Matejka
 */
class QueryHandler implements IQueryHandler
{

	public function supports(IQuery $query)
	{
		return $query instanceof UserQuery;
	}


	public function fetch(IQuery $query)
	{
		return $query->fetch(\Mockery::mock(IQueryable::class));
	}

	}
