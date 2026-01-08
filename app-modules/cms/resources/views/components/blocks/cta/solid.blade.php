@props(['data' => []])

@php
    use ClintonRocha\CMS\ValueObjects\CtaBlockData;
    /** @var CtaBlockData $data */
@endphp

<section class="w-full bg-indigo-600 py-16">
    <div class="mx-auto max-w-4xl px-6 {{ $data->alignClass() }}">
        <h2 class="text-3xl font-bold text-white">
            {{ $data->title }}
        </h2>

        @if ($data->text)
            <p class="mt-4 text-lg text-indigo-100">
                {{ $data->text }}
            </p>
        @endif

        <div class="mt-8">
            <a
                href="{{ $data->url }}"
                class="inline-block rounded-md bg-white px-6 py-3 text-base font-semibold text-indigo-600 hover:bg-indigo-50 transition"
            >
                {{ $data->label }}
            </a>
        </div>
    </div>
</section>
