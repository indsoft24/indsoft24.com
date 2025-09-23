<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TiptapEditor extends Component
{
    public $content;

    /**
     * Create a new component instance.
     *
     * @param string $content
     * @return void
     */
    public function __construct($content = '')
    {
        $this->content = $content;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tiptap-editor');
    }
}