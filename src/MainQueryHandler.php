<?php declare(strict_types = 1);

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


	public function addHandler(IQueryHandler $handler): void
	{
		$this->handlers[] = $handler;
	}


	public function addModifier(IQueryModifier $queryModifier): void
	{
		$this->modifiers[] = $queryModifier;
	}


	public function supports(IQuery $query): bool
	{
		foreach ($this->handlers as $handler) {
			if ($handler->supports($query)) {
				return TRUE;
			}
		}

		return FALSE;
	}


	/**
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


	private function resolveHandler(IQuery $query): ?IQueryHandler
	{
		foreach ($this->handlers as $handler) {
			if ($handler->supports($query)) {
				return $handler;
			}
		}

		return NULL;
	}
}
