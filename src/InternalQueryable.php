<?php
namespace Librette\Queries;

/**
 * @author David Matejka
 */
class InternalQueryable implements IQueryable
{

	/** @var IQueryHandler */
	private $queryHandler;


	public function __construct(IQueryHandler $queryHandler)
	{
		$this->queryHandler = $queryHandler;
	}


	/**
	 * @return IQueryHandler
	 */
	public function getHandler()
	{
		return $this->queryHandler;
	}

}
