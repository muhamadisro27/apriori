@props(['edit', 'destroy', 'model'])

<div class="flex-row gap-1 d-flex">
    @if (isset($edit))
        <a href="{{ $edit }}" class="btn btn-warning">
            <i class="text-white icon cil-pencil" title="Edit">
            </i>
        </a>
    @endif
    @if (isset($destroy))
        @if (auth()->user()->uuid != $model->uuid)
            <form action="{{ $destroy }}" method="POST" id="form-delete">
                <button type="submit" class="btn btn-danger">
                    <i class="text-white icon cil-trash" title="Delete">
                    </i>
                </button>
            </form>
        @endif
    @endif
</div>
