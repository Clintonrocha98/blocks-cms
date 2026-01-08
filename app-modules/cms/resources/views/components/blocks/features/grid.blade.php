@props(['data' => []])
@php
    use ClintonRocha\CMS\ValueObjects\FeaturesBlockData;
    /** @var FeaturesBlockData $data */
@endphp

<section class="w-full py-20 bg-white">
    <div class="mx-auto max-w-7xl px-6">
        <div class="grid gap-12 {{ $data->gridClass() }}">
            @foreach ($data->items as $item)
                <div class="rounded-xl border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900">
                        {{ $item['title'] }}
                    </h3>

                    <p class="mt-2 text-gray-600">
                        {{ $item['description'] }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>
