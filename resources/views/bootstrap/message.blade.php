@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::bootstrap.overlay', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        <div class="alert
                    alert-{{ config('flash.classes.bootstrap.'.$message['level']) }}
        {{ $message['important']||config('flash.dismissible') ? 'alert-important' : '' }}"
             role="alert"
        >
            @if ($message['important']||config('flash.dismissible'))
                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-hidden="true"
                >&times;
                </button>
            @endif

            {!! $message['message'] !!}
        </div>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}