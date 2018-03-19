<?php declare(strict_types = 1);

namespace Librette\Queries\DI;

use Librette\Queries\Internal\InternalQueryHandler;
use Librette\Queries\IQueryHandlerAccessor;
use Librette\Queries\MainQueryHandler;
use Nette\DI\CompilerExtension;

/**
 * @author David Matejka
 */
class QueriesExtension extends CompilerExtension
{

	const TAG_QUERY_HANDLER = 'librette.queries.handler';
	const TAG_QUERY_MODIFIER = 'librette.queries.modifier';


	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();
		$builder->addDefinition($this->prefix('queryHandler'))
			->setClass(MainQueryHandler::class);
		$builder->addDefinition($this->prefix('queryHandlerAccessor'))
			->setImplement(IQueryHandlerAccessor::class)
			->setFactory($this->prefix('@queryHandler'));
		$builder->addDefinition($this->prefix('internalQueryHandler'))
			->setClass(InternalQueryHandler::class)
			->setAutowired(FALSE);
	}


	public function beforeCompile()
	{
		$builder = $this->getContainerBuilder();
		$queryHandler = $builder->getDefinition($this->prefix('queryHandler'));
		foreach ($builder->findByTag(self::TAG_QUERY_HANDLER) as $name => $args) {
			$def = $builder->getDefinition($name);
			$def->setAutowired(FALSE);
			$queryHandler->addSetup('addHandler', [$def]);
		}
		$queryHandler->addSetup('addHandler', [$this->prefix('@internalQueryHandler')]);

		foreach ($builder->findByTag(self::TAG_QUERY_MODIFIER) as $name => $args) {
			$def = $builder->getDefinition($name);
			$queryHandler->addSetup('addModifier', [$def]);
		}
	}

}
