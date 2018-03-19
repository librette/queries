<?php declare(strict_types = 1);

namespace Librette\Queries;

/**
 * @author David Matejka
 */
interface IQueryModifier
{
	public function modify(IQuery $query): void;
}
