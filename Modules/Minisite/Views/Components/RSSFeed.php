<?php

namespace Modules\Minisite\Views\Components;

use Illuminate\View\Component;

class RSSFeed extends Component
{
    public $block;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($block)
    {
        $this->block = $block;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('minisite::components.rss-feed');
    }
}
