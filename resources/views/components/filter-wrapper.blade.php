@props(['title' => 'Filter'])

<div class="mb-4 card">
    <div class="flex-row card-header d-flex justify-content-between">
        <strong>{{ $title }}</strong>

        {{ $button ?? null }}
    </div>
    <div class="card-body">
        {{ $slot }}
    </div>

</div>
