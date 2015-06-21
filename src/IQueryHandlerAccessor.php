<?php
namespace Librette\Queries;

/**
 * @author David Matejka
 */
interface IQueryHandlerAccessor
{

	/**
	 * @return IQueryHandler
	 */
	public function get();

}
