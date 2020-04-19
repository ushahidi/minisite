<?php

namespace Modules\Minisite\View\Components;

use Illuminate\View\Component;

class PinnedInformation extends Component
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
        return view('minisite::components.pinned-information');
    }
}
