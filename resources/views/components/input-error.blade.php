@props(['messages'])

@if ($messages)
    @foreach ((array) $messages as $message)
        <span class="text-sm text-danger">{{ $message }}</span>
    @endforeach
@endif
