@props(['data'=>[]])
<section class="hero">
    <h1>{{ $data['title'] ?? '' }}</h1>
    <p>{{ $data['subtitle'] ?? '' }}</p>
</section>
