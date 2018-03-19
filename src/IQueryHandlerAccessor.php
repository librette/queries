<?php declare(strict_types = 1);

namespace Librette\Queries;

/**
 * @author David Matejka
 */
interface IQueryHandlerAccessor
{
	public function get(): IQueryHandler;
}
