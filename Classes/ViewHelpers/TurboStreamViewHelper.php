<?php

namespace fucodo\hotwire\turbo\ViewHelpers;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\TagBuilder;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

class TurboStreamViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    /**
     * @var bool
     */
    protected $escapeOutput = false;

    public function initializeArguments()
    {
        $this->registerArgument('value', 'mixed', 'The value to output');
        $this->registerArgument('action', 'string', 'the action of the stream, one of append, prepend, replace, update, remove, before, after', true);
        $this->registerArgument('target', 'string', 'the target of the turbo stream');
        $this->registerArgument('targets', 'string', 'the targets of the turbo stream');
    }

    /**
     * @param array $arguments
     * @param \Closure $childClosure
     * @param RenderingContextInterface $renderingContext
     * @return string
     */
    public static function renderStatic(array $arguments, \Closure $childClosure, RenderingContextInterface $renderingContext)
    {
        if (!in_array($arguments['action'], ['append', 'prepend', 'replace', 'update', 'remove', 'before, after'])) {
            throw new \InvalidArgumentException('action musst be one of append, prepend, replace, update, remove, before, after');
        }
        if ((!isset($arguments['target'])) && (!isset($arguments['targets']))) {
            throw new \InvalidArgumentException('either attribute targets or target needs to be defined');
        }

        $tagBuilder = new TagBuilder(
            'turbo-stream',
            '<template>' . (string)$childClosure() . '</template>'
        );
        $tagBuilder->addAttribute('action', $arguments['action']);
        if (isset($arguments['target'])) {
            $tagBuilder->addAttribute('target', $arguments['target']);
        }
        if (isset($arguments['targets'])) {
            $tagBuilder->addAttribute('targets', $arguments['targets']);
        }

        return $tagBuilder->render();
    }
}
