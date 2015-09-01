<?php
namespace LibretteTests\Queries\Mocks;

use Librette\Queries\IResultSet;
use Nette\Utils\Paginator;

/**
 * @author David Matejka
 */
class ResultSet implements \IteratorAggregate, IResultSet
{
	/** @var array */
	private $data;

	/** @var array */
	private $paginated;


	public function __construct($data)
	{
		$this->data = $this->paginated = $data;
	}


	public function applyPaginator(Paginator $paginator)
	{
		$this->applyPaging($paginator->getOffset(), $paginator->getLength());
		$paginator->setItemsPerPage($this->getTotalCount());
	}


	public function applyPaging($offset, $limit)
	{
		$this->paginated = array_slice($this->data, $offset, $limit);
	}


	public function getTotalCount()
	{
		return count($this->data);
	}


	public function count()
	{
		return count($this->paginated);
	}


	public function getIterator()
	{
		return new \ArrayIterator($this->data);
	}

}
