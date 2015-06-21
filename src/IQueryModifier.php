<?php
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
