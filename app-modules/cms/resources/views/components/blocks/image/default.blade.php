@props(['data' => []])

@php
    use ClintonRocha\CMS\ValueObjects\ImageBlockData;
    /** @var ImageBlockData $data */
@endphp

<section class="w-full py-16">
    <div class="mx-auto px-6 {{ $data->containerWidth() }} {{ $data->alignClass() }}">
        <img
            src="{{ $data->src }}"
            alt="{{ $data->alt }}"
            class="{{ $data->imageAlignClass() }} rounded-xl shadow-sm"
        >

        @if ($data->caption)
            <p class="mt-4 text-sm text-gray-500">
                {{ $data->caption }}
            </p>
        @endif
    </div>
</section>
