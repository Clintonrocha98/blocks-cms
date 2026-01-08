@props(['data' => []])

@php
    use ClintonRocha\CMS\Forms\FormRegistry;use ClintonRocha\CMS\ValueObjects\FormBlockData;
    /** @var FormBlockData $data */
    $form = FormRegistry::get($data->formId);
@endphp

<section class="w-full py-16">
    <div class="mx-auto max-w-md rounded-xl bg-white p-6 shadow">
        <h2 class="text-xl font-semibold">{{ $data->title }}</h2>

        @if ($data->description)
            <p class="mt-2 text-gray-600">{{ $data->description }}</p>
        @endif

        <form method="POST" action="{{ url("/forms/{$data->formId}") }}" class="mt-6 space-y-4">
            @csrf

            @foreach ($form->fields() as $name => $label)
                <input
                    name="{{ $name }}"
                    placeholder="{{ $label }}"
                    class="w-full rounded-md border px-3 py-2"
                >
            @endforeach

            <button class="w-full rounded-md bg-indigo-600 py-2 text-white">
                {{ $data->submitLabel }}
            </button>
        </form>
    </div>
</section>
