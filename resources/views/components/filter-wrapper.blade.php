<div class="mb-4 card">
    <div class="flex-row card-header d-flex justify-content-between">
        <strong>Filter</strong>
        {{-- <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-coreui-toggle="modal" data-coreui-target="#modal">
            <i class='cil-note-add'></i> Import Data
        </button> --}}
    </div>
    <div class="card-body">
        {{ $slot }}

        {{ $footer_button }}
    </div>

</div>
