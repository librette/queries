<?php

namespace Librette\Queries;

use Nette\SmartObject;

/**
 * @author David Matejka
 */
class MainQueryHandler implements IQueryHandler
{
	use SmartObject;

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
		$handler = $this->resolveHandler($query);
		if ($handler === NULL) {
			throw new InvalidArgumentException("Unsupported query.");
		}

		foreach ($this->modifiers as $modifier) {
			$modifier->modify($query);
		}

		return $handler->fetch($query);
	}


	private function resolveHandler(IQuery $query)
	{
		foreach ($this->handlers as $handler) {
			if ($handler->supports($query)) {
				return $handler;
			}
		}

		return NULL;
	}
}
