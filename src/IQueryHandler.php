<?php
namespace Librette\Queries;

/**
 * @author David Matejka
 */
interface IQueryHandler
{

	/**
	 * @param IQuery
	 * @return bool
	 */
	public function supports(IQuery $query);


	/**
	 * @param IQuery
	 * @return mixed
	 */
	public function fetch(IQuery $query);

}
