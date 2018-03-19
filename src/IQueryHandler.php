<?php declare(strict_types = 1);

namespace Librette\Queries;

interface IQueryHandler
{
	public function supports(IQuery $query): bool;

	/**
	 * @return mixed
	 */
	public function fetch(IQuery $query);
}
