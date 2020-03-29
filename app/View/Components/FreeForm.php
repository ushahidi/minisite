<?php

namespace App\View\Components;

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
    public function __construct($block = null)
    {
        $json = $block->content->Content->content;
        $this->renderedHTML = (new \Scrumpy\ProseMirrorToHtml\Renderer)->render([
            'type' => 'doc',
            'content' => $json,
        ]);
        $this->block = $block;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        
        return view('components.free-form');
    }
}
