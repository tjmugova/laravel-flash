<?php

namespace Tjmugova\LaravelFlash;

use Illuminate\Support\Traits\Macroable;
use Livewire\Component;
class FlashNotifier
{
    use Macroable;

    /**
     * The session store.
     *
     * @var SessionStore
     */
    protected $session;

    /**
     * The messages collection.
     *
     * @var \Illuminate\Support\Collection
     */
    public $messages;

    /**
     * Create a new FlashNotifier instance.
     *
     * @param SessionStore $session
     */
    function __construct(SessionStore $session)
    {
        $this->session = $session;
        $this->messages = collect();
    }

    /**
     * Flash an information message.
     *
     * @param string|null $message
     * @return $this
     */
    public function info($message = null)
    {
        return $this->message($message ?? config('flash.messages.info'), 'info');
    }

    /**
     * Flash a success message.
     *
     * @param string|null $message
     * @return $this
     */
    public function success($message = null)
    {
        return $this->message($message ?? config('flash.messages.success'), 'success');
    }

    /**
     * Flash an error message.
     *
     * @param string|null $message
     * @return $this
     */
    public function error($message = null)
    {
        return $this->message($message ?? config('flash.messages.error'), 'danger');
    }

    /**
     * Flash a warning message.
     *
     * @param string|null $message
     * @return $this
     */
    public function warning($message = null)
    {
        return $this->message($message ?? config('flash.messages.warning'), 'warning');
    }

    /**
     * Flash a warning message.
     *
     * @param string|null $message
     * @return $this
     */
    public function stored($message = null)
    {
        return $this->message($message ?? config('flash.messages.stored'), 'success');
    }

    /**
     * Flash a warning message.
     *
     * @param string|null $message
     * @return $this
     */
    public function updated($message = null)
    {
        return $this->message($message ?? config('flash.messages.updated'), 'success');
    }

    /**
     * Flash a warning message.
     *
     * @param string|null $message
     * @return $this
     */
    public function deleted($message = null)
    {
        return $this->message($message ?? config('flash.messages.deleted'), 'success');
    }

    /**
     * Flash a warning message.
     *
     * @param string|null $message
     * @return $this
     */
    public function queued($message = null)
    {
        return $this->message($message ?? config('flash.messages.queued'), 'success');
    }

    /**
     * Flash a general message.
     *
     * @param string|null $message
     * @param string|null $level
     * @return $this
     */
    public function message($message = null, $level = null)
    {
        // If no message was provided, we should update
        // the most recently added message.
        if (!$message) {
            return $this->updateLastMessage(compact('level'));
        }

        if (!$message instanceof Message) {
            $message = new Message(compact('message', 'level'));
        }

        $this->messages->push($message);

        return $this->flash();
    }

    /**
     * Modify the most recently added message.
     *
     * @param array $overrides
     * @return $this
     */
    protected function updateLastMessage($overrides = [])
    {
        $this->messages->last()->update($overrides);

        return $this;
    }

    /**
     * Flash an overlay modal.
     *
     * @param string|null $message
     * @param string $title
     * @return $this
     */
    public function overlay($message = null, $title = 'Notice')
    {
        if (!$message) {
            return $this->updateLastMessage(['title' => $title, 'overlay' => true]);
        }

        return $this->message(
            new OverlayMessage(compact('title', 'message'))
        );
    }

    /**
     * Add an "important" flash to the session.
     *
     * @return $this
     */
    public function important()
    {
        return $this->updateLastMessage(['important' => true]);
    }

    /**
     * Set the dismissability of the last flash message.
     *
     * @param bool $dismissable
     *
     * @return $this
     */
    public function dismissable(bool $dismissable = true)
    {
        return $this->updateLastMessage(['dismissable' => $dismissable]);
    }

    /**
     * Convenience method to set dismissable = false on a message
     *
     * @return void
     */
    public function notDismissable()
    {
        return $this->dismissable(false);
    }

    /**
     * Clear all registered messages.
     *
     * @return $this
     */
    public function clear()
    {
        $this->messages = collect();

        return $this;
    }

    /**
     * Flash all messages to the session.
     */
    protected function flash()
    {
        $this->session->flash('flash_notification', $this->messages);

        return $this;
    }

    /**
     * Pop the last message off the stack and emit it to the Livewire component
     *
     * @param Livewire\Component $livewire
     * @return \Tjmugova\LaravelFlash\LivewireFlashNotifier
     */
    public function livewire(Component $livewire)
    {
        $livewire->emit('flashMessageAdded',$this->messages->pop());

        return $this;
    }


    /**
     * Magic __call: pass the method name called as the message type if it is configured
     *
     * @param mixed $method
     * @param mixed $arguments
     * @return \Tjmugova\LaravelFlash\FlashNotifier
     */
    public function __call($method, $arguments)
    {
        return $this->message(null, $method);
    }
}