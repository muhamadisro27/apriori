@props(['id', 'value', 'required' => true])

<label for="{{ $id }}" {{ $attributes->merge(['class' => 'form-label']) }}>
    {{ $value ?? $slot }}
    @if ($required)
        <span class="text-danger">*</span>
    @endif
</label>
