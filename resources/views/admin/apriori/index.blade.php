@section('title', 'Proses Apriori')

<x-app-layout>

    <x-slot name="breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="mb-4 breadcrumb">
                <li class="breadcrumb-item">
                    <!-- if breadcrumb is single--><span>
                        <a href="{{ route('admin.') }}">Home</a>
                    </span>
                </li>
                <li class="breadcrumb-item active"><span>Apriori Process</span></li>
            </ol>
        </nav>
        @if (session()->has('message'))
            <div class="alert alert-info" role="alert">
                {{ session()->get('message') }}
            </div>
        @endif
        <x-filter-wrapper title="Apriori">

            <form id="form" method="post" action="{{ route('admin.apriori-process.') }}">
                @csrf
                <div class="row">
                    <div class="mb-3 col-sm-6 col-md-6 col-lg-3">
                        <label for="date-start">Date Start :</label>
                        <div class="mb-1 input-group">
                            <span class="input-group-text"><i class='cil-calendar'></i></span>
                            <input type="text" class="form-control" name="date-start" value="{{ $date_start }}"
                                id="date-start">
                        </div>
                        <x-input-error :messages="$errors->get('date-start')" class="mt-2" />
                    </div>
                    <div class="mb-3 col-sm-6 col-md-6 col-lg-3">
                        <label for="date-end">Date End :</label>
                        <div class="mb-1 input-group">
                            <span class="input-group-text"><i class='cil-calendar'></i></span>
                            <input type="text" class="form-control" name="date-end" value="{{ $date_end }}"
                                id="date-end">
                        </div>
                        <x-input-error :messages="$errors->get('date-end')" class="mt-2" />
                    </div>

                    <div class="mb-3 col-sm-6 col-md-6 col-lg-3">
                        <label for="support">Minimum Support :</label>
                        <div class="mb-1 input-group">
                            <input type="text" class="form-control" name="support"
                                placeholder="masukkan angka support.." onkeypress="validate_keypress(event)"
                                id="support" value="{{ old('support', isset($support) ? $support : null) }}">
                            <span class="input-group-text">%</span>
                        </div>
                        <x-input-error :messages="$errors->get('support')" class="mt-2" />
                    </div>
                    <div class="mb-3 col-sm-6 col-md-6 col-lg-3">
                        <label for="confidence">Minimum Confidence :</label>
                        <div class="mb-1 input-group">
                            <input type="text" class="form-control" name="confidence"
                                placeholder="masukkan angka confidence.." onkeypress="validate_keypress(event)"
                                id="confidence" value="{{ old('confidence', isset($confidence) ? $confidence : null) }}">
                            <span class="input-group-text">%</span>
                        </div>
                        <x-input-error :messages="$errors->get('confidence')" class="mt-2" />
                    </div>
                </div>


                <div class="mt-3 row">
                    <div class="flex-row-reverse gap-1 col-md-12 d-flex">
                        <button type="submit" class="btn btn-primary">Proses</button>
                    </div>
                </div>
            </form>

        </x-filter-wrapper>
    </x-slot>


</x-app-layout>

<script defer>
    $(document).ready(function() {
        datePicker($('#date-start'), $('#date-end'), false);
    })
</script>
