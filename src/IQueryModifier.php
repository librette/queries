<?php declare(strict_types = 1);

namespace Librette\Queries;

interface IQueryModifier
{
	public function modify(IQuery $query): void;
}
