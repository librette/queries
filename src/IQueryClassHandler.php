<?php
namespace Librette\Queries;

/**
 * @author David Matejka
 */
interface IQueryClassHandler extends IQueryHandler
{

	public function getSupportedClasses();

}
