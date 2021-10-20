@if ($message['overlay'])
    @include('flash::tailwind.overlay', [
        'modalClass' => 'flash-modal',
        'title'      => $message['title'],
        'body'       => $message['message']
    ])
@else
    <div x-data="{ open: true }" x-show="open"
         class="p-4 rounded {{ config('flash.classes.tailwind.'.$message['level'].'.bg-color') }} border-l-4 {{ config('flash.classes.tailwind.'.$message['level'].'.border-color') }} mb-3">
        <div class="flex">
            @if (config('flash.classes.tailwind.'.$message['level'].'.icon') ?? false)
                <div class="flex-shrink-0">
                    <p class="{{ config('flash.classes.tailwind.'.$message['level'].'.icon-color') }}">
                        <i class="{{ config('flash.classes.tailwind.'.$message['level'].'.icon') }}"></i>
                    </p>
                </div>
            @endif
            <div class="ml-3 text-sm leading-5 font-medium {{ config('flash.classes.tailwind.'.$message['level'].'.text-color') }}">
                {!! $message['message'] !!}
            </div>
            @if ($message['important']||config('flash.dismissible') ?? false)
                <div class="ml-auto pl-3">
                    <div class="-mx-1.5 -my-1.5">
                        <button class="inline-flex rounded-md p-1.5 {{ config('flash.classes.tailwind.'.$message['level'].'.text-color') }} focus:outline-none transition ease-in-out duration-150"
                                @click="open =!open">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endif

