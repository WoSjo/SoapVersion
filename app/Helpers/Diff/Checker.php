<?php

namespace SoapVersion\Helpers\Diff;

use Diff;
use Diff_Renderer_Html_Array;
use Diff_Renderer_Html_Inline;
use Diff_Renderer_Html_SideBySide;
use Diff_Renderer_Text_Context;
use Diff_Renderer_Text_Unified;

class Checker
{
    const DEFAULT_RENDER_OPTIONS = [
        'ignoreWhitespace' => true,
        'ignoreCase' => true,
    ];

    const HTML_INLINE_RENDERER = Diff_Renderer_Html_Inline::class;
    const HTML_ARRAY_RENDERER = Diff_Renderer_Html_Array::class;
    const HTML_SIDE_BY_SIDE_RENDERER = Diff_Renderer_Html_SideBySide::class;

    const TEXT_CONTEXT_RENDERER = Diff_Renderer_Text_Context::class;
    const TEXT_UNIFIED_RENDERER = Diff_Renderer_Text_Unified::class;

    /** @var Diff */
    private $diff;

    /** @var string */
    private $renderer;

    /** @var array */
    private $oldVersion;

    /** @var array */
    private $newVersion;

    /** @var array */
    private $renderOptions;

    public function __construct(string $oldVersion, string $newVersion, string $renderer, array $renderOptions)
    {
        $this->setOldVersion($oldVersion);
        $this->setNewVersion($newVersion);
        $this->setRenderer($renderer);
        $this->setRenderOptions($renderOptions);

        $this->diff = new Diff(
            $this->oldVersion,
            $this->newVersion,
            $this->renderOptions
        );
    }

    /**
     * @param string $oldVersion
     */
    public function setOldVersion(string $oldVersion)
    {
        $this->oldVersion = explode("\n", $oldVersion);
    }

    /**
     * @param string $newVersion
     */
    public function setNewVersion(string $newVersion)
    {
        $this->newVersion = explode("\n", $newVersion);
    }

    /**
     * @param string $renderer
     */
    public function setRenderer(string $renderer)
    {
        $this->renderer = new $renderer;
    }

    /**
     * @param array $renderOptions
     */
    public function setRenderOptions(array $renderOptions)
    {
        $this->renderOptions = $renderOptions;
    }

    /**
     * @return string|array
     */
    public function render()
    {
        return $this->diff->render($this->renderer);
    }

    /**
     * @return bool
     */
    public function hasDifferences()
    {
        return !empty($this->diff->getGroupedOpcodes());
    }
}