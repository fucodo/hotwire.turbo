<?php

namespace fucodo\hotwire\turbo\View;

use Neos\FluidAdaptor\View\TemplateView;

class TurboView extends TemplateView
{
    /**
     * Loads the template source and render the template.
     * If "layoutName" is set in a PostParseFacet callback, it will render the file with the given layout.
     *
     * @param null $actionName
     * @return string Rendered Template
     * @api
     */
    public function render($actionName = null): string
    {
        $this->controllerContext->getResponse()->setContentType('text/vnd.turbo-stream.html');
        return parent::render($actionName);
    }
}
