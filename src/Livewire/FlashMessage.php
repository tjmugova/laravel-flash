<?php

namespace Tjmugova\LaravelFlash\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class FlashMessage extends Component
{
    public $messages = [];
    protected $listeners = ['flashMessageAdded'];
    public $shown = true;

    public function mount()
    {
        // grab any normal flash messages and render them
        $this->messages = session('flash_notification', collect())->toArray();
        session()->forget('flash_notification');
    }

    public function render()
    {
        return view('flash::message', ['messages' => $this->messages]);
    }

    public function flashMessageAdded($message)
    {
        $this->messages[] = $message;
    }

    public function dismiss()
    {
        $this->shown = false;
    }

    public function dismissMessage($key)
    {
        unset($this->messages[$key]);
    }
}