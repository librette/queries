<?php
namespace LibretteTests\Queries;

use Librette\Queries\InvalidArgumentException;
use Librette\Queries\IQueryHandler;
use Librette\Queries\IResultSet;
use Librette\Queries\MainQueryHandler;
use LibretteTests\Queries\Mocks\QueryHandler;
use LibretteTests\Queries\Mocks\UserQuery;
use Nette;
use Tester;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';


/**
 * @testCase
 */
class QueryHandlerTestCase extends Tester\TestCase
{

	public function setUp()
	{

	}


	public function tearDown()
	{
		\Mockery::close();
	}


	public function testBasic()
	{
		$queryHandler = new MainQueryHandler();
		$queryHandler->addHandler(new QueryHandler());

		Assert::true($queryHandler->supports(new UserQuery()));
		$result = $queryHandler->fetch(new UserQuery());
		Assert::type(IResultSet::class, $result);
		Assert::same([['name' => 'John'], ['name' => 'Jack']], iterator_to_array($result));
	}


	public function testUnsupportedQuery()
	{
		$queryHandler = new MainQueryHandler();
		$queryHandler->addHandler(\Mockery::mock(IQueryHandler::class)->shouldReceive('supports')->andReturn(FALSE)->getMock());
		Assert::false($queryHandler->supports(new UserQuery()));
		Assert::throws(function () use ($queryHandler) {
			$queryHandler->fetch(new UserQuery());

		}, InvalidArgumentException::class, 'Unsupported query.');
	}

}


\run(new QueryHandlerTestCase());
