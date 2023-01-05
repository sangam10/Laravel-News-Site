@extends('layouts.admin.layout')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>News</h1>
            <nav class="d-flex justify-content-between">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">News</li>
                </ol>
                <div class="d-flex">
                    <a href="{{ route('admin.news.create') }}" class="btn btn-outline-primary me-1">Create
                        News</a>
                    <button class="btn btn-outline-danger" id="selected-news-delete" type="button">Delete</button>
                    <form action="{{ route('admin.news.selected.delete') }}" method="POST" id="seleted-news-delete-form">
                        @csrf
                        @method('DELETE')
                        {{-- <input type="hidden" name="news_id[]" value="" id="selected-news-id"> --}}
                    </form>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="card card-body">
                        <!-- Default Table -->
                        @if ($news->count() > 0)
                            @php
                                $i = 0;
                            @endphp
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th><input type="checkbox" class="form-check-input" id="select-all-news"
                                                autocomplete="off"><span class="text-nowrap">All</span></th>
                                        <th scope="col">Featured Image</th>
                                        <th scope="col">News Title</th>
                                        <th scope="col">Views</th>
                                        <th scope="col">Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($news as $item)
                                        <tr>
                                            <td scope="row">{{ ++$i }}</td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input news-checkbox" type="checkbox"
                                                        name="select_news_id[]" value="{{ $item->id }}"
                                                        id="form-check-input-{{ $item->id }}" autocomplete="off">
                                                </div>
                                            </td>
                                            <td><img src="{{ asset('storage/images') }}/{{ $item->featured_image_name }}"
                                                    alt="featured image" style="height: 60px;"></td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->views_count }}</td>
                                            <td>{{ $item->created_at->diffForHumans() }}</td>
                                            <td class="d-flex">
                                                <a href="{{ route('news.show', $item->id) }}"
                                                    class="btn btn-outline-primary me-1 button_padding"><i
                                                        class="bi bi-eye-fill"></i></a>
                                                <a href="{{ route('admin.news.edit', $item->id) }}"
                                                    class="btn btn-outline-success me-1 button_padding"><i
                                                        class="bi bi-pencil-square"></i></a>
                                                <button class="btn btn-outline-danger delete-news button_padding"
                                                    onclick="event.preventDefault();" data-id="{{ $item->id }}"><i
                                                        class="bi bi-trash-fill"></i></button>
                                                <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST"
                                                    id="delete-news-{{ $item->id }}">
                                                    @csrf
                                                    @method('DELETE')

                                                </form>
                                            </td>
                                            <td>
                                                @if ($item->is_published)
                                                    <a href="{{ route('admin.news.edit', $item->id) }}"><span
                                                            class="badge text-bg-success py-2">Published</span></a>
                                                @else
                                                    <a href="{{ route('admin.news.edit', $item->id) }}"><span
                                                            class="badge text-bg-danger">Not Published
                                                        </span></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <h5>Non news added yet !</h5>
                        @endif
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#select-all-news').on('change', function() {
                var isChecked = this.checked;
                $('.news-checkbox').each(function() {
                    this.checked = isChecked
                })
            })
            $('.delete-news').on('click', function(event) {
                var id = $(this).attr('data-id');
                var form = $(`#delete-news-${id}`);
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
            $('#selected-news-delete').on('click', function() {
                event.preventDefault()
                $('.news-checkbox').each(function() {
                    if (this.checked) {
                        var input = `<input type="hidden" name="news_id[]" value="${this.value}">`;
                        $('#seleted-news-delete-form').append(input)
                    }
                })
                Swal.fire({
                    title: 'Are you sure?',
                    text: " !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#seleted-news-delete-form').submit()
                    }
                })
            })
        });
    </script>
@endpush
