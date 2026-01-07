@props(['data' => []])

@php
    use App\ValueObjects\DividerBlockData;
    /** @var DividerBlockData $data */
@endphp

<div class="{{ $data->spacingClass() }}">
    <hr class="border-gray-200">
</div>
