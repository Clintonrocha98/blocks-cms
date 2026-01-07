@props(['data' => []])

@php
    use App\ValueObjects\DividerBlockData;
    /** @var DividerBlockData $data */
@endphp

<div class="{{ $data->spacingClass() }}"></div>
