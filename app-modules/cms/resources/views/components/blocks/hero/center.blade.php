@php
    use ClintonRocha\CMS\ValueObjects\HeroBlockData;
    /** @var HeroBlockData $data  */
@endphp
<section class="w-full bg-white py-24">
    <div class="mx-auto max-w-4xl px-6 text-center">
        <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">
            {{ $data->title }}
        </h1>

        @if ($data->subtitle)
            <p class="mt-6 text-lg leading-8 text-gray-600">
                {{ $data->subtitle }}
            </p>
        @endif

        @if ($data->ctaLabel && $data->ctaUrl)
            <div class="mt-10 flex justify-center">
                <a
                    href="{{ $data->ctaUrl }}"
                    class="rounded-md bg-indigo-600 px-6 py-3 text-base font-semibold text-white shadow-sm hover:bg-indigo-500 transition"
                >
                    {{ $data->ctaLabel }}
                </a>
            </div>
        @endif
    </div>
</section>
