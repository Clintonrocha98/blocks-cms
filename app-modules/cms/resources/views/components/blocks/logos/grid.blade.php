@props(['data' => []])

@php
    use ClintonRocha\CMS\ValueObjects\ClientLogoItem;use ClintonRocha\CMS\ValueObjects\LogosBlockData;
    /** @var LogosBlockData $data */
    /** @var ClientLogoItem $item */
@endphp

<section class="w-full py-16 bg-white">
    <div class="mx-auto max-w-7xl px-6">
        <div class="grid items-center gap-8 {{ $data->gridClass() }}">
            @foreach ($data->items as $item)
                @if ($item->hasLink())
                    <a href="{{ $item->url }}" target="_blank" rel="noopener">
                        <img
                            src="{{ $item->logo }}"
                            alt="{{ $item->name }}"
                            class="mx-auto h-10 grayscale opacity-80 transition hover:opacity-100"
                        >
                    </a>
                @else
                    <img
                        src="{{ $item->logo }}"
                        alt="{{ $item->name }}"
                        class="mx-auto h-10 grayscale opacity-80"
                    >
                @endif
            @endforeach
        </div>
    </div>
</section>
