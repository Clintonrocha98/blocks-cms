@props(['data' => []])

@php
    use ClintonRocha\CMS\ValueObjects\TestimonialItem;use ClintonRocha\CMS\ValueObjects\TestimonialsBlockData;
    /** @var TestimonialsBlockData $data */
    /** @var TestimonialItem $item */
@endphp

<section class="w-full py-20 bg-gray-50">
    <div class="mx-auto max-w-5xl px-6 space-y-10">
        @foreach ($data->items as $item)

            <div class="rounded-xl bg-white p-6 shadow-sm">
                <blockquote class="text-lg text-gray-700">
                    “{{ $item->quote }}”
                </blockquote>

                <div class="mt-6 flex items-center gap-4">
                    @if ($item->hasAvatar())
                        <img
                            src="{{ $item->avatar }}"
                            alt="{{ $item->name }}"
                            class="h-12 w-12 rounded-full object-cover"
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
                </div>
            </div>
        @endforeach
    </div>
</section>
