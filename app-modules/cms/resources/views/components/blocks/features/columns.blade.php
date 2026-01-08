@props(['data' => []])
@php
    use ClintonRocha\CMS\ValueObjects\FeaturesBlockData;
    /** @var FeaturesBlockData $data */
@endphp

<section class="w-full py-20 bg-gray-50">
    <div class="mx-auto max-w-5xl px-6">
        <div class="space-y-12">
            @foreach ($data->items as $item)
                <div class="flex flex-col gap-4 sm:flex-row">
                    <div class="font-semibold text-gray-900 sm:w-1/3">
                        {{ $item['title'] }}
                    </div>

                    <div class="text-gray-600 sm:w-2/3">
                        {{ $item['description'] }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
