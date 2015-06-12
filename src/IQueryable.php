<?php
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
