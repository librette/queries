<?php
namespace Librette\Queries;

use Nette\Object;

/**
 * @author David Matejka
 */
class QueryByTypeHandler extends Object implements IQueryHandler
{

	/** @var IQueryHandler[] */
	public $handlers = [];


	/**
	 * @param string
	 * @param IQueryHandler
	 */
	public function addHandler($type, IQueryHandler $handler)
	{
		$this->handlers[$type] = $handler;
	}


	/**
	 * @param IQuery
	 * @return mixed|IResultSet
	 */
	public function handle(IQuery $query)
	{
		if (!$query instanceof IQueryType) {
			throw new InvalidArgumentException("Unsupported query");
		}
		if (!isset($this->handlers[$type = $query->getQueryType()])) {
			throw new InvalidArgumentException("Unsupported query type $type");
		}

		return $this->handlers[$type]->handle($query);
	}

}
