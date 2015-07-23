<?php
namespace Librette\Queries;

/**
 * @author David Matejka
 */
interface IQueryHandler
{

	/**
	 * @param IQuery
	 * @return mixed|IResultSet
	 */
	public function fetch(IQuery $query);

}