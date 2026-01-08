@props(['data' => []])

@php
    use ClintonRocha\CMS\ValueObjects\AnchorItem;use ClintonRocha\CMS\ValueObjects\AnchorsData;
    /** @var AnchorsData $data */
    /** @var AnchorItem $item */
@endphp

<section class="w-full py-6 bg-white">
    <div class="mx-auto max-w-5xl px-6 flex flex-wrap gap-3">
        @foreach ($data->items as $item)
            <a
                    href="{{ $item->href() }}"
                    class="rounded-md border border-gray-300 px-4 py-2 text-sm hover:bg-gray-100"
            >
                {{ $item->label }}
            </a>
        @endforeach
    </div>
</section>
