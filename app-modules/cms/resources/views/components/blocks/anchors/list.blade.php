@props(['data' => []])

@php
    use ClintonRocha\CMS\ValueObjects\AnchorItem;use ClintonRocha\CMS\ValueObjects\AnchorsBlockData;
    /** @var AnchorsBlockData $data */
    /** @var AnchorItem $item */
@endphp

<section class="w-full py-6 bg-gray-50">
    <div class="mx-auto max-w-4xl px-6">
        <ul class="space-y-2">
            @foreach ($data->items as $item)
                <li>
                    <a href="{{ $item->href() }}" class="text-indigo-600 hover:underline">
                        {{ $item->label }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</section>
