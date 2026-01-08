<!doctype html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
@foreach ($page->blocks as $block)
    @php
        //TODO: colocar 'cms::' em uma config para caso tenha mudança de modulo ou algo do tipo
    @endphp
    <x-dynamic-component
        :component="$block->view()"
        :data="$block->content()"
    />
@endforeach
</body>
</html>
