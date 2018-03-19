<?php declare(strict_types = 1);

namespace Librette\Queries;

/**
 * @author David Matejka
 */
interface IQueryModifier
{

	/**
	 * @param IQuery
	 * @return void
	 */
	public function modify(IQuery $query);

}
