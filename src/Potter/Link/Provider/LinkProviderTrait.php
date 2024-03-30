<?php

declare(strict_types=1);

namespace Potter\Link\Provider;

use \Psr\Link\LinkInterface, \Traversable;

trait LinkProviderTrait 
{
    private array $links;
    
    final public function getFirstLink(): LinkInterface
    {
        return array_values($this->links)[0];
    }
    
    final public function getLastLink(): LinkInterface
    {
        return array_values($this->reverseLinks())[0];
    }
    
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
    
    final public function hasLink(LinkInterface $link): bool
    {
        foreach ($this->links as $linked) {
            if ($link != $linked) {
                continue;
            }
            return true;
        }
        return false;
    }
    
    private function reverseLinks(): array
    {
        return array_reverse($this->links);
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