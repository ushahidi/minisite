<?php

namespace Modules\Minisite\Views\Components;

use Illuminate\View\Component;

class EmailForm extends Component
{
    public $block;
    public $minisite;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($block, $minisite)
    {
        $this->block = $block;
        $this->minisite = $minisite;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('minisite::components.email-form');
    }
}
