@props(['data' => []])

@php
    use ClintonRocha\CMS\ValueObjects\TestimonialItem;use ClintonRocha\CMS\ValueObjects\TestimonialsBlockData;
    /** @var TestimonialsBlockData $data */
    /** @var TestimonialItem $item */
@endphp

<section class="w-full py-20 bg-white">
    <div class="mx-auto max-w-7xl px-6">
        <div class="grid gap-10 {{ $data->gridClass() }}">
            @foreach ($data->items as $item)

                <figure class="rounded-xl border border-gray-200 p-6">
                    <blockquote class="text-gray-700">
                        “{{ $item->quote }}”
                    </blockquote>

                    <figcaption class="mt-4 flex items-center gap-4">
                        @if ($item->hasAvatar())
                            <img
                                src="{{ $item->avatar }}"
                                alt="{{ $item->name }}"
                                class="h-10 w-10 rounded-full object-cover"
                            >
                        @endif

                        <div>
                            <div class="font-semibold text-gray-900">
                                {{ $item->name }}
                            </div>

                            @if ($item->role)
                                <div class="text-sm text-gray-500">
                                    {{ $item->role }}
                                </div>
                            @endif
                        </div>
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </div>
</section>
