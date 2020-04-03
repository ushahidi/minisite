<?php

namespace Modules\Minisite\View\Components;

use Illuminate\View\Component;

class FeaturedYoutubeVideo extends Component
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
        return view('minisite::components.featured-youtube-video');
    }
}
