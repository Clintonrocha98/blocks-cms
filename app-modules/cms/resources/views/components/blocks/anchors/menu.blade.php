@props(['data' => []])

@php
    use ClintonRocha\CMS\ValueObjects\AnchorItem;use ClintonRocha\CMS\ValueObjects\AnchorsData;
    /** @var AnchorsData $data */
    /** @var AnchorItem $item */
@endphp

<nav class="w-full border-b border-gray-200 bg-white">
    <div class="mx-auto max-w-7xl px-6">
        <ul class="flex gap-6 py-4 text-sm font-medium text-gray-700">
            @foreach ($data->items as $item)
                <li>
                    <a href="{{ $item->href() }}" class="hover:text-indigo-600">
                        {{ $item->label }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>
