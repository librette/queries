<?php
namespace LibretteTests\Queries\Mocks;

use Librette\Queries\IResultSet;
use Nette\Utils\Paginator;

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


	public function applyPaginator(Paginator $paginator): IResultSet
	{
		$this->applyPaging($paginator->getOffset(), $paginator->getLength());
		$paginator->setItemsPerPage($this->getTotalCount());
		return $this;
	}


	public function applyPaging(int $offset, int $limit): IResultSet
	{
		$this->paginated = array_slice($this->data, $offset, $limit);
		return $this;
	}


	public function getTotalCount(): int
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
