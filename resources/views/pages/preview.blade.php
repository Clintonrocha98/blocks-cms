@foreach ($page->blocks as $block)
    @php
        //TODO: colocar 'cms::' em uma config para caso tenha mudança de modulo ou algo do tipo
    @endphp
    <x-dynamic-component
        :component="'cms::'.$block->data->view()"
        :data="$block->data"
    />
@endforeach
