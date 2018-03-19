<?php declare(strict_types = 1);

namespace Librette\Queries;

interface IQueryHandlerAccessor
{
	public function get(): IQueryHandler;
}
