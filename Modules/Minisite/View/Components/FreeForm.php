<?php

namespace Modules\Minisite\View\Components;

use Illuminate\View\Component;

class FreeForm extends Component
{
    public $block;
    public $renderedHTML;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($block)
    {
        
        $this->block = $block;
        if (!$block->content->Content) {
            $this->renderedHTML = "";
        } else {
            $json = $block->content->Content->content;
            $this->renderedHTML = (new \Scrumpy\ProseMirrorToHtml\Renderer)->render([
                'type' => 'doc',
                'content' => $json,
            ]);
        }
        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        
        return view('minisite::components.free-form');
    }
}