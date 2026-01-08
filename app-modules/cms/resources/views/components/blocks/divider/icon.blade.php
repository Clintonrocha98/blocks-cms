@props(['data' => []])

@php
    use ClintonRocha\CMS\ValueObjects\DividerBlockData;
    /** @var DividerBlockData $data */
@endphp

<div class="flex items-center justify-center {{ $data->spacingClass() }}">
    <span class="text-gray-400 text-xl">•</span>
</div>
