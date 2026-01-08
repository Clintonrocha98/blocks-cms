@props(['data' => []])

@php
    use ClintonRocha\CMS\ValueObjects\ClientLogoItem;use ClintonRocha\CMS\ValueObjects\LogosBlockData;
    /** @var LogosBlockData $data */
    /** @var ClientLogoItem $item */
@endphp

<section class="w-full py-16 bg-gray-50">
    <div class="mx-auto max-w-7xl overflow-hidden px-6">
        <div class="flex items-center gap-12 overflow-x-auto">
            @foreach ($data->items as $item)
                @if ($item->hasLink())
                    <a href="{{ $item->url }}" target="_blank" rel="noopener">
                        <img
                            src="{{ $item->logo }}"
                            alt="{{ $item->name }}"
                            class="h-10 shrink-0 grayscale opacity-80 hover:opacity-100 transition"
                        >
                    </a>
                @else
                    <img
                        src="{{ $item->logo }}"
                        alt="{{ $item->name }}"
                        class="h-10 shrink-0 grayscale opacity-80"
                    >
                @endif
            @endforeach
        </div>
    </div>
</section>
