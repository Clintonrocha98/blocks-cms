@props(['data' => []])

@php
    use ClintonRocha\CMS\ValueObjects\DividerBlockData;
    /** @var DividerBlockData $data */
@endphp

<div class="{{ $data->spacingClass() }}">
    <hr class="border-gray-200">
</div>
