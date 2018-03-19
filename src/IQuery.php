<?php declare(strict_types = 1);

namespace Librette\Queries;

/**
 * @author David Matejka
 */
interface IQuery
{

	/**
	 * @param IQueryable
	 * @return mixed
	 */
	public function fetch(IQueryable $queryable);

}
