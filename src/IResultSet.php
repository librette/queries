<?php
namespace Librette\Queries;

use Nette\Utils\Paginator;


/**
 * Lazy collection
 *
 * @author David Matejka
 */
interface IResultSet extends \Traversable, \Countable
{

	/**
	 * @param Paginator
	 * @throws InvalidStateException
	 * @return self
	 */
	public function applyPaginator(Paginator $paginator);


	/**
	 * @param int
	 * @param int
	 * @throws InvalidStateException
	 * @return self
	 */
	public function applyPaging($offset, $limit);


	/**
	 * @return int
	 */
	public function getTotalCount();

}
