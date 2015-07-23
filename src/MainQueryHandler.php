<?php
namespace Librette\Queries;

use Nette\Object;

/**
 * @author David Matejka
 */
class MainQueryHandler extends Object implements IQueryHandler
{

	/** @var IQueryHandler[] */
	private $typeHandlers = [];

	private $classHandlers = [];

	/** @var IQueryModifier[] */
	private $modifiers = [];


	/**
	 * @param string
	 * @param IQueryHandler
	 */
	public function addTypeHandler($type, IQueryHandler $handler)
	{
		$this->typeHandlers[$type] = $handler;
	}


	/**
	 * @param IQueryHandler
	 */
	public function addClassHandler(IQueryClassHandler $handler)
	{
		foreach ($handler->getSupportedClasses() as $class) {
			$class = ltrim(strtolower($class), '\\');
			$this->classHandlers[$class] = $handler;
		}
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
		$handler = NULL;
		if (isset($this->classHandlers[$cls = strtolower(get_class($query))])) {
			$handler = $this->classHandlers[$cls];
		} elseif ($query instanceof IQueryType && isset($this->typeHandlers[$type = $query->getQueryType()])) {
			$handler = $this->typeHandlers[$type];
		} elseif (!$query instanceof IOuterQuery) {
			throw new InvalidArgumentException("Unsupported query.");
		}

		foreach ($this->modifiers as $modifier) {
			$modifier->modify($query);
		}

		return $handler ? $handler->fetch($query) : $query->fetch(new InternalQueryable($this));
	}

}
