<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $type;
    public $name;
    public $checked;
    public $value;
    public $props;
    public $label;
    public function __construct($type = 'text', $name, $value = "", $props = "", $label = false)
    {
        $this->type = $type;
        $this->name = $name;
        $this->value = old($name) ?? $value;
        $this->props = $props;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.input');
    }
}
