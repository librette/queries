<?php
namespace LibretteTests\Queries;

use Librette\Queries\CountQuery;
use Librette\Queries\IQueryHandler;
use Librette\Queries\IQueryHandlerAccessor;
use Librette\Queries\IResultSet;
use Librette\Queries\MainQueryHandler;
use LibretteTests\Queries\Mocks\QueryModifier;
use LibretteTests\Queries\Mocks\UserQuery;
use Nette;
use Tester;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';


/**
 * @author David Matějka
 * @testCase
 */
class ExtensionTestCase extends Tester\TestCase
{

	public function setUp()
	{
	}


	public function testConfig()
	{
		$loader = new Nette\DI\ContainerLoader(TEMP_DIR);
		$cls = $loader->load('', function (Nette\DI\Compiler $compiler) {
			$compiler->addExtension('extensions', new Nette\DI\Extensions\ExtensionsExtension());
			$compiler->loadConfig(__DIR__ . '/configs/config.neon');
		});
		/** @var Nette\DI\Container $container */
		$container = new $cls;
		/** @var IQueryHandler $handler */
		Assert::type(MainQueryHandler::class, $handler = $container->getByType(IQueryHandler::class));
		Assert::type(IQueryHandlerAccessor::class, $accessor = $container->getByType(IQueryHandlerAccessor::class));

		Assert::same($handler, $accessor->get());

		Assert::true($handler->supports(new UserQuery()));
		Assert::true($handler->supports(new CountQuery(new UserQuery())));

		/** @var QueryModifier $modifier */
		$modifier = $container->getByType(QueryModifier::class);

		Assert::type(IResultSet::class, $handler->fetch($q = new UserQuery()));
		Assert::same([$q], $modifier->queries);
	}


}


\run(new ExtensionTestCase());
