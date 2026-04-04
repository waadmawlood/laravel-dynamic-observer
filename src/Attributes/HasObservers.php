<?php

namespace Waad\Observer\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class HasObservers
{
    public function __construct(public array|string|null $observer = null) {}
}
