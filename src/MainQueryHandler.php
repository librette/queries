<?php
namespace Librette\Queries;

use Nette\Object;

/**
 * @author David Matejka
 */
class MainQueryHandler extends Object implements IQueryHandler
{

	/** @var IQueryHandler[] */
	public $handlers = [];

	/** @var IQueryModifier[] */
	public $modifiers = [];


	/**
	 * @param string
	 * @param IQueryHandler
	 */
	public function addHandler($type, IQueryHandler $handler)
	{
		$this->handlers[$type] = $handler;
	}


	/**
	 * @param IQueryModifier
	 */
	public function addModifier(IQueryModifier $queryModifier)
	{
		$this->modifiers[] = $queryModifier;
	}


	/**
	 * @param IQuery
	 * @return mixed|IResultSet
	 */
	public function fetch(IQuery $query)
	{
		if (!$query instanceof IQueryType && !$query instanceof IOuterQuery) {
			throw new InvalidArgumentException('Unsupported query');
		}
		$type = NULL;
		if ($query instanceof IQueryType && !isset($this->handlers[$type = $query->getQueryType()])) {
			throw new InvalidArgumentException("Unsupported query type $type");
		}

		foreach ($this->modifiers as $modifier) {
			$modifier->modify($query);
		}

		return $type ? $this->handlers[$type]->fetch($query) : $query->fetch(new InternalQueryable($this));
	}

}
