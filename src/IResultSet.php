<?php declare(strict_types = 1);

namespace Librette\Queries;

use Nette\Utils\Paginator;


/**
 * Lazy collection
 */
interface IResultSet extends \Traversable, \Countable
{
	public function applyPaginator(Paginator $paginator): self;

	public function applyPaging(int $offset, int $limit): self;

	public function getTotalCount(): int;
}
