@props(['data'=>[]])
@php
    use ClintonRocha\CMS\Blocks\Text;
    /** @var TextData $data  */
@endphp
<section class="w-full py-16">
    <div class="mx-auto px-6 {{ $data->containerWidth() }} {{ $data->textAlign() }}">
        <div class="prose prose-lg max-w-none">
            {!! $data->text !!}
        </div>
    </div>
</section>

