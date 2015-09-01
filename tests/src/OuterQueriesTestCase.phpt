<?php
namespace LibretteTests\Queries;

use Librette\Queries\CountQuery;
use Librette\Queries\Internal\InternalQueryHandler;
use Librette\Queries\IQueryHandler;
use Librette\Queries\IQueryHandlerAccessor;
use Librette\Queries\MainQueryHandler;
use Librette\Queries\SingleItemQuery;
use LibretteTests\Queries\Mocks\QueryHandler;
use LibretteTests\Queries\Mocks\UserQuery;
use Nette;
use Tester;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';


/**
 * @author David Matějka
 * @testCase
 */
class OuterQueriesTestCase extends Tester\TestCase
{

	/** @var IQueryHandler */
	private $queryHandler;


	public function setUp()
	{
		$this->queryHandler = $queryHandler = new MainQueryHandler();
		$internalQh = new InternalQueryHandler(\Mockery::mock(IQueryHandlerAccessor::class)->shouldReceive('get')->andReturn($queryHandler)->getMock());
		$queryHandler->addHandler($internalQh);
		$queryHandler->addHandler(new QueryHandler());
	}


	public function tearDown()
	{
		\Mockery::close();
	}


	public function testCount()
	{
		Assert::same(2, $this->queryHandler->fetch(new CountQuery(new UserQuery())));
	}


	public function testFirst()
	{
		Assert::same(['name' => 'John'], $this->queryHandler->fetch(new SingleItemQuery(new UserQuery())));
	}

}


\run(new OuterQueriesTestCase());
