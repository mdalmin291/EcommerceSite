@push('css')
@endpush
<div>
    <x-slot name="title">
        Slider Image
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4>Slider Image List</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-right">
                                <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2" wire:click="sliderImageModal"><i class="mdi mdi-plus mr-1"></i> New Slider Image</button>
                            </div>
                        </div><!-- end col-->
                    </div>
                    <div wire:ignore class="table-responsive">
                        <div wire:ignore class="table-responsive">
                            <table class="table table-bordered dt-responsive nowrap" id="sliderTable" style="border-collapse: collapse; border-spacing: 0; width: 100%;"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                <!--  Modal content for the above example -->
                <div wire:ignore.self class="modal fade" id="sliderImage" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title mt-0" id="myLargeModalLabel">Slider Image</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form wire:submit.prevent="sliderImageSave">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="basicpill-firstname-input">Title</label>
                                                <input class="form-control" type="text" wire:model.lazy="title" placeholder="Title">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="control-label">Image (517.38*492 jpg)</label>
                                                <div class="custom-file">
                                                    {{-- <input type="file" wire:model.lazy="image" class="custom-file-input" id="customFile"> --}}

                                                    <input type="file" wire:model.lazy="image" >
                                                    @error('image') <span class="error">{{ $message }}</span> @enderror
                                                    @if (!$image)
                                                    @if($QueryUpdate)
                                                    <img src="{{ asset('storage/photo')}}/{{ $QueryUpdate->image }}"  style="height:30px; weight:30px;" alt="Image" class="img-circle img-fluid">
                                                    @endif
                                                    @endif
                                                    @if ($image)
                                                    <img src="{{ $image->temporaryUrl() }}" style="height:30px; weight:30px;" alt="Image" class="img-circle img-fluid">
                                                    @endif
                                                    {{-- <label class="custom-file-label" for="customFile">Choose file</label> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="basicpill-firstname-input">Position</label>
                                                <input class="form-control" type="number" wire:model.lazy="position" placeholder="Position">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="basicpill-lastname-input">Status</label>
                                                <select class="form-control" wire:model.lazy="is_active">
                                                    {{-- <option value="">Select Status</option> --}}
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                                @error('is_active') <span class="error">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" wire:target="image" wire:loading.attr="disabled">Submit</button>
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
</div>
@push('scripts')
    <script>
    function callEdit(id) {
        @this.call('sliderImageEdit', id);
    }
    function callDelete(id) {
        @this.call('sliderImageDelete', id);
    }
        $(document).ready(function () {
            var datatable = $('#sliderTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('data.slider_table')}}",
                columns: [
                    {
                        title: 'SL',
                        data: 'id'
                    },
                    {
                        title: 'Title',
                        data:   'title',
                        name:   'title'
                    },
                    {
                        title: 'Image',
                        data:  'image',
                        name:  'image'
                    },
                    {
                        title: 'Position',
                        data:  'position',
                        name:  'position'
                    },
                    {
                        title: 'Status',
                        data:  'is_active',
                        name:  'is_active'
                    },
                    {
                        title: 'Action',
                        data:  'action',
                        name:  'action'
                    },
                ]
            });

            window.livewire.on('success', message => {
                datatable.draw(true);
            });
        });
    </script>
@endpush
