<div>
    <div wire:ignore.self class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" data-bs-backdrop="static"
        data-bs-keyboard="false" aria-labelledby="modelTitleId">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: white;">
                    <h5 class="modal-title m-0" id="mySmallModalLabel">Admin Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-md-11">
                            <form wire:submit.prevent='updateProfile' enctype="multipart/form-data">
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input class="form-control mb-2" id="name" type="text" wire:model.blur="name" placeholder="Enter name" autocomplete='off'>
                                        @error('name')
                                            <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                            <br>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input class="form-control mb-2" id="email" type="text" wire:model.blur="email" placeholder="Enter email" autocomplete='off'>
                                        @error('email')
                                            <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                            <br>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="phone" class="col-sm-3 col-form-label">Phone</label>
                                    <div class="col-sm-9">
                                        <input class="form-control mb-2" type="text" id="phone" wire:model.blur="phone" placeholder="Enter phone" autocomplete='off'>
                                        @error('phone')
                                            <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                            <br>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm-9">
                                        <input class="form-control mb-2" type="text" id="password" wire:model.blur="password" placeholder="Enter new password" wire:model.blur='password' autocomplete='off'>
                                        @error('password')
                                            <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                            <br>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="avatar" class="col-sm-3 col-form-label">Avatar</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" id="avatar" wire:model.blur='avatar' />
                                        @error('avatar')
                                            <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                        @enderror

                                        <div wire:loading wire:target='avatar' wire:key='avatar'>
                                            <span class="spinner-border spinner-border-xs" role="status" aria-hidden="true"></span> <small>Uploading</small>
                                        </div>
                                        @if ($avatar)
                                            <img src="{{ $avatar->temporaryUrl() }}" class="img-fluid mt-2" style="height: 55px; width: 55px;"/>
                                        @elseif ($uploadedAvatar)
                                            <img src="{{ asset($uploadedAvatar) }}" class="img-fluid mt-2" style="height: 55px; width: 55px;"/>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3 row mt-4">
                                    <span class="col-sm-3 col-form-label"></span>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            {!! loadingStateWithText('updateProfile', 'Update Profile') !!}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        window.addEventListener('closeModal', event => {
            $('#editProfileModal').modal('hide');
        });
    </script>
@endpush
