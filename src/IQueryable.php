<?php declare(strict_types = 1);

namespace Librette\Queries;

interface IQueryable
{
	public function getHandler(): IQueryHandler;
}
