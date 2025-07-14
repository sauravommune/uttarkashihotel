@props(['messages'])
@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-danger mt--6 ps-0']) }}>
        @foreach ((array) $messages as $message)
            <li class="list-unstyled fs-6">{{ $message }}</li>
        @endforeach
    </ul>
@endif
