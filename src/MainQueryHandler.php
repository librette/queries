<?php
namespace Librette\Queries;

use Nette\Object;

/**
 * @author David Matejka
 */
class MainQueryHandler extends Object implements IQueryHandler
{

	/** @var IQueryHandler[] */
	private $handlers = [];

	/** @var IQueryModifier[] */
	private $modifiers = [];


	/**
	 * @param IQueryHandler
	 */
	public function addHandler(IQueryHandler $handler)
	{
		$this->handlers[] = $handler;
	}


	/**
	 * @param IQueryModifier
	 */
	public function addModifier(IQueryModifier $queryModifier)
	{
		$this->modifiers[] = $queryModifier;
	}


	public function supports(IQuery $query)
	{
		foreach ($this->handlers as $handler) {
			if ($handler->supports($query)) {
				return TRUE;
			}
		}

		return FALSE;
	}


	/**
	 * @param IQuery
	 * @return mixed|IResultSet
	 */
	public function fetch(IQuery $query)
	{
		$handler = NULL;
		foreach ($this->handlers as $handler) {
			if ($handler->supports($query)) {
				break;
			}
		}
		if ($handler === NULL) {
			throw new InvalidArgumentException("Unsupported query.");
		}

		foreach ($this->modifiers as $modifier) {
			$modifier->modify($query);
		}

		return $handler->fetch($query);
	}

}
