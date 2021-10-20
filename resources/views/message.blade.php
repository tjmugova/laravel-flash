<div>
    @if(session()->has('flash_notification'))
        @foreach (session('flash_notification', collect())->toArray() as $message)
            @if(config('flash.framework') === 'tailwind')
                @include('flash::tailwind.message')
            @else
                @include('flash::bootstrap.message')
            @endif
        @endforeach
        {{ session()->forget('flash_notification') }}
    @endif
    @if(!empty($messages))
        @foreach ($messages as $message)
            @if(config('flash.framework') === 'tailwind')
                @include('flash::tailwind.message')
            @else
                @include('flash::bootstrap.message')
            @endif
        @endforeach
    @endif
    @if(config('flash.validations.enabled'))
        @include(config('flash.validations.view'))
    @endif
</div>