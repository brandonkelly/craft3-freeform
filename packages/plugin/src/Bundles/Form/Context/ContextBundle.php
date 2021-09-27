<?php

namespace Solspace\Freeform\Bundles\Form\Context;

use Solspace\Freeform\Bundles\Form\Context\Pages\PageContext;
use Solspace\Freeform\Bundles\Form\Context\Request\OverrideContext;
use Solspace\Freeform\Bundles\Form\Context\Request\RequestContext;
use Solspace\Freeform\Bundles\Form\Context\Session\SessionContext;
use Solspace\Freeform\Library\Bundles\BundleInterface;

class ContextBundle implements BundleInterface
{
    public function __construct()
    {
        new OverrideContext();
        new SessionContext();
        new PageContext();
        new RequestContext();
    }
}