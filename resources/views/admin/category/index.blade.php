@extends('layouts.admin.layout')

@section('content')
    <main class="main" id="main">
        <div class="pagetitle">
            <h1>News Category</h1>
            <nav class="d-flex justify-content-between">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">category</li>
                </ol>
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#newCategory">New
                    Category</button>
            </nav>
        </div><!-- End Page Title -->
        {{-- new category --}}
        <div class="modal fade" id="newCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('admin.category.store') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Category</label>
                                <input placeholder="Category Name .." type="text" class="form-control"
                                    name="category_name">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-outline-primary">Add Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card card-body">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger p-0 mb-0 text-center">{{ $error }}</div>
                @endforeach
            @endif
            @if (count($categories) > 0)
                <!-- Default Table -->
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">News Counts</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($categories as $category)
                            <tr>
                                <th>{{ ++$i }}</th>
                                <td class="text-Capitalize">{{ $category->category_name }}</td>
                                <td>28</td>
                                <td>
                                    <a href="#" class="btn btn-outline-primary button_padding" data-bs-toggle="modal"
                                        data-bs-target="#edit-category-{{ $category->id }}"
                                        onclick="event.preventDefault();document.getElementById('edit-category-{{ $category->id }}').submit()"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <a href="{{ route('admin.category.index') }}"
                                        class="btn btn-outline-danger delete-category button_padding"
                                        onclick="event.preventDefault();" data-id="{{ $category->id }}"><i
                                            class="bi bi-trash-fill"></i></a>
                                </td>
                                <form method="POST" action="{{ route('admin.category.destroy', $category->id) }}"
                                    id="delete-form-{{ $category->id }}">
                                    @csrf
                                    @method('DELETE')

                                </form>
                                {{-- edit category --}}
                                <div class="modal fade" id="edit-category-{{ $category->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Category</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form method="POST"
                                                action="{{ route('admin.category.update', $category->id) }}"
                                                id="edit-form-{{ $category->id }}')">
                                                @method('PUT')
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Category</label>
                                                        <input placeholder="Category Name .." type="text"
                                                            class="form-control" name="category_name"
                                                            value="{{ $category->category_name }}">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-outline-primary">update
                                                        Category</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- End Default Table Example -->
            @else
                <h5>No categories added yet</h5>
            @endif
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            @if (session()->has('success'))
                Swal.fire(
                    'Success',
                    "{{ session()->get('success') }}",
                    'success'
                )
            @endif
            @if (session()->has('error'))
                Swal.fire(
                    'Oops!!',
                    "{{ session()->get('error') }}",
                    'error'
                )
            @endif
            $('.delete-category').on('click', function(event) {
                var id = $(this).attr('data-id');
                var form = $(`#delete-form-${id}`);
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
                    }
                })

            });
        });
    </script>
@endpush
