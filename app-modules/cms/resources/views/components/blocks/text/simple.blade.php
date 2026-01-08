@props(['data'=>[]])
@php
    use ClintonRocha\CMS\ValueObjects\TextBlockData;
    /** @var TextBlockData $data  */
@endphp
<section class="w-full py-16">
    <div class="mx-auto px-6 {{ $data->containerWidth() }} {{ $data->textAlign() }}">
        <p class="text-lg leading-8 text-gray-700">
            {{ $data->text }}
        </p>
    </div>
</section>
