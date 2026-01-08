@props(['data' => []])

@php
    use ClintonRocha\CMS\ValueObjects\FooterBlockData;use ClintonRocha\CMS\ValueObjects\FooterLinkItem;use ClintonRocha\CMS\ValueObjects\FooterSocialItem;
    /** @var FooterLinkItem $link */
    /** @var FooterSocialItem $social */
    /** @var FooterBlockData $data */
@endphp

<footer class="w-full border-t border-gray-200 bg-gray-50">
    <div class="mx-auto max-w-7xl px-6 py-12 space-y-8">

        {{-- Links --}}
        @if ($data->links)
            <nav class="flex flex-wrap gap-6 text-sm text-gray-600">
                @foreach ($data->links as $link)
                    <a href="{{ $link->url }}" class="hover:text-indigo-600">
                        {{ $link->label }}
                    </a>
                @endforeach
            </nav>
        @endif

        {{-- Redes sociais --}}
        @if ($data->socials)
            <div class="flex gap-4">
                @foreach ($data->socials as $social)
                    <a
                        href="{{ $social->url }}"
                        aria-label="{{ $social->label }}"
                        class="text-gray-500 hover:text-indigo-600"
                    >
                        <span class="{{ $social->iconClass() }} text-xl"></span>
                    </a>
                @endforeach
            </div>
        @endif

        {{-- Políticas + copyright --}}
        <div
            class="flex flex-col gap-4 border-t border-gray-200 pt-6 text-sm text-gray-500 sm:flex-row sm:items-center sm:justify-between">
            @if ($data->policies)
                <div class="flex flex-wrap gap-4">
                    @foreach ($data->policies as $policy)
                        <a href="{{ $policy->url }}" class="hover:text-indigo-600">
                            {{ $policy->label }}
                        </a>
                    @endforeach
                </div>
            @endif

            <div>
                {{ $data->copyright }}
            </div>
        </div>

    </div>
</footer>
