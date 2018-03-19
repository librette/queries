<?php declare(strict_types = 1);

namespace Librette\Queries;

/**
 * @author David Matejka
 */
interface IQueryable
{

	/**
	 * @return IQueryHandler
	 */
	public function getHandler();

}
