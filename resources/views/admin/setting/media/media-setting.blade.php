@extends('layouts.admin.layout')

@push('styles')
    <style>
        .hover_image {
            position: relative
        }

        .hover_image:hover {
            border: 2px solid #0d6efd !important;
        }

        .hover_image:hover::before {
            position: absolute;
            content: '';
            top: 0;
            right: 0;
            height: 10px;
            width: 10px;
            background-color: blue
        }

        .hover_image:hover .image_delete_button {
            display: flex !important;
        }
    </style>
@endpush

@section('content')
    <main class="main" id="main">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5>Media Library</h5>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger p-0 mb-0 text-center">{{ $error }}</div>
                    @endforeach
                @endif
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#newImage">Upload
                    Images</button>
                {{-- new images --}}
                <div class="modal fade" id="newImage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Multiple Images</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('admin.media.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Upload Images</label>
                                        <input placeholder="Image Name .." type="file" class="form-control"
                                            name="images[]" multiple>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-outline-primary">Add Image</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body pt-4">
                @if ($images->count() > 0)
                    <div class="row">
                        @foreach ($images as $image)
                            <div class="col-md-2">
                                <div class="card position-relative hover_image">
                                    <input type="checkbox" class="form-check-input position-absolute top-0 end-0"
                                        style="z-index: 1;" autocomplete="off">
                                    <img src="{{ asset('storage/images') }}/{{ $image->image_name }}" alt="image">
                                    {{-- <div class="card-footer">
                                        <button data-id="{{ $image->id }}"
                                            class="btn d-flex justify-content-center align-items-center btn-outline-danger position-absolute bottom-0 end-0 d-none image_delete_button"
                                            style="height:20px;width:20px;">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <form action="{{ route('admin.media.destroy', $image->id) }}" method="POST"
                                            id="image-delete-{{ $image->id }}">
                                            @csrf
                                            @method('DELETE')

                                        </form>
                                    </div> --}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <h4 class="card-heading">No images uploaded at</h4>
                @endif
            </div>
        </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.image_delete_button').on('click', function(event) {
                var id = $(this).attr('data-id');
                var form = $(`#image-delete-${id}`);
                console.log('before delete');
                event.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit()
                        // Swal.fire(
                        //     'Deleted!',
                        //     'Your file has been deleted.',
                        //     'success'
                        // )
                    }
                })

            });
        });
    </script>
@endpush
