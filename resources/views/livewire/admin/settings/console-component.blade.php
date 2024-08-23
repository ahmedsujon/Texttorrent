@section('page_title') Console @endsection
<div>

    <style>
        .console-output {
            background-color: #000;
            padding: 10px;
            margin-top: 10px;
            overflow: auto;
            white-space: pre-wrap;
            width: auto !important;
        }
    </style>

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Console</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Console</a></li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Commands</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                    <button type="button" class="btn btn-dark btn-md w-100" wire:loading.attr='disabled' wire:click.prevent='migrate'>{!! loadingStateWithText('migrate', 'Migrate') !!}</button>
                                </div>
                                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                    <button type="button" class="btn btn-dark btn-md w-100" wire:loading.attr='disabled' wire:click.prevent='dbSeed'>{!! loadingStateWithText('dbSeed', 'DB:Seed') !!}</button>
                                </div>
                                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                    <button type="button" class="btn btn-dark btn-md w-100" wire:loading.attr='disabled' wire:click.prevent='migrateFreshSeed'>{!! loadingStateWithText('migrateFreshSeed', 'Migrate:Fresh --Seed') !!}</button>
                                </div>

                                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                    <button type="button" class="btn btn-dark btn-md w-100" wire:loading.attr='disabled' wire:click.prevent='optimizeClear'>{!! loadingStateWithText('optimizeClear', 'Optimize:clear') !!}</button>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                @if ($output)
                    <div class="col-md-12">
                        <div class="card card-body">
                            <div class="console-output">
                                <pre style="color: #00ff00 !important;">{{ $output }}</pre>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>

</div>
@push('scripts')
    <script>
        window.addEventListener('closeModal', event => {
            $('#customCommandModal').modal('hide');
        });
    </script>
@endpush
