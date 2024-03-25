<?php

declare(strict_types=1);

namespace Potter\Link\Provider;

use \Psr\Link\LinkInterface;

trait LinkProviderTrait 
{
    private array $links;
    
    final public function getLinks(): array|Traversable
    {
        return $this->links ?? [];
    }
    
    final public function getLinksByRel(string $rel): array|Traversable
    {
        $links = [];
        foreach ($this->links as $link)
        {
            if (!$this->linkHasRel($link, $rel)) {
                continue;
            }
            array_push($links, $link);
        }
    }
    
    final protected function setLinks(array|Traversable $links): void
    {
        $this->links = $links;
    }
    
    private function linkHasRel(LinkInterface $link, string $rel): bool
    {
        return in_array($rel, $link->getRels());
    }
}