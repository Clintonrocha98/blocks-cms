<h1>{{ $page->title }}</h1>
@foreach ($page->blocks as $block)
    <x-dynamic-component
        :component="'blocks.' . $block->type"
        :data="$block->data"
    />
@endforeach
