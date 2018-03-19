<?php declare(strict_types = 1);

namespace Librette\Queries;

/**
 * @author David Matejka
 */
interface IOuterQuery extends IQuery
{

	/**
	 * @return IQuery
	 */
	public function getInnerQuery();

}
