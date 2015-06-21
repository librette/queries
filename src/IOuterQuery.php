<?php
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
