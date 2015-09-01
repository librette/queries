<?php
namespace LibretteTests\Queries;

use Librette\Queries\IQueryModifier;
use Librette\Queries\MainQueryHandler;
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
class QueryModifierTestCase extends Tester\TestCase
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
		$handler = new MainQueryHandler();
		$query = new UserQuery();
		$handler->addModifier(\Mockery::mock(IQueryModifier::class)->shouldReceive('modify')->with($query)->once()->getMock());
		$handler->addHandler(new QueryHandler());
		$handler->fetch($query);

		Assert::true(TRUE);
	}

}


\run(new QueryModifierTestCase());
