<?php declare(strict_types = 1);

namespace Librette\Queries;

interface IOuterQuery extends IQuery
{
	public function getInnerQuery(): IQuery;
}
