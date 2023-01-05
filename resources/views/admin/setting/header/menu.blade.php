@extends('layouts.admin.layout')

@push('styles')
    <style>
        fieldset {
            padding: inherit;
        }

        legend {
            float: none;
            width: auto;
        }
    </style>
@endpush

@section('content')
    <main class="main" id="main">
        <div class="pagetitle">
            <h1>Menu</h1>
            <nav class="d-flex justify-content-between">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Menu</li>
                </ol>
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#newMenu">New
                    Menu</button>
                <div class="modal fade" id="newMenu" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('admin.category.store') }}">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Menu</label>
                                        <input placeholder="Menu Name .." type="text" class="form-control"
                                            name="menu_name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="multiple select" class="form-label">Category (<span
                                                class="text-danger">*</span>)</label>
                                        @if ($categories->count() > 0)
                                            <select class="form-select js-example-basic-multiple" multiple="multiple"
                                                name="news_categories[]">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @else
                                            <div class="text-danger fst-italic">Add some category first</div>
                                        @endif
                                        @error('menu_name')
                                            <div class="text-danger">*{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-outline-primary">Add Menu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
        </div><!-- End Page Title -->
        <div class="card card-body pt-2">
            <div class="row">
                @if (count($active_menu) > 0)
                    <div class="col-md-4">
                        {{-- <div class="card shadow"> --}}
                        <fieldset class="p-3 card shadow-lg" style="border: 2px solid #198754;">
                            <legend class="px-2 fst-italic mb-0 text-success" style="font-size: 22px;">Active Menu
                            </legend>
                            <ul class="list-group border-0" id="active-menu-sortable">
                                @foreach ($active_menu as $category)
                                    <li class="list-group-item mb-2 border border-secondary rounded" style="cursor: move;">
                                        {{ $category->category_name }}</li>
                                @endforeach
                            </ul>
                            <li class="list-group-item p-0"><button class="btn btn-success w-100"
                                    id="active-menu-update">update</button>
                            </li>
                        </fieldset>
                        {{-- </div> --}}
                    </div>
                @endif
                <div class="col-md-4">
                    <fieldset class="p-3 card shadow-lg" style="border: 2px solid #198754;">
                        <legend class="px-2 fst-italic mb-0 text-success" style="font-size: 22px;">Select Menu</legend>
                        <ul class="list-group border-0">
                            @foreach ($categories as $category)
                                <li class="list-group-item mb-1 border border-secondary rounded">
                                    <input class="form-check-input category-checked" name="categoryId[]"
                                        value="{{ $category->id }}" type="checkbox" autocomplete="off">
                                    <span class="ps-2">{{ $category->category_name }}</span>
                                </li>
                            @endforeach
                            <li class="list-group-item mb-1 border border-secondary rounded">
                                <input type="checkbox" id="select-all-category" class="form-check-input" autocomplete="off">
                                <label for="" class="form-label mb-0 ps-2"><strong>select
                                        all</strong></label>
                            </li>
                            <li class="list-group-item p-0"><button class="btn btn-success w-100"
                                    id="category-add">add</button>
                            </li>
                        </ul>
                    </fieldset>
                </div>
                <div class="col-md-4">
                    <form action="{{ route('admin.header.store') }}" method="POST">
                        @csrf
                        <fieldset class="p-3 card shadow-lg" style="border: 2px solid #198754;" id="menu-publish-wrapper">
                            <legend class="px-2 fst-italic mb-0 text-success" style="font-size: 22px;">Add Menu</legend>
                            <ul class="list-group border-0" id="sortable">

                            </ul>
                            <li class="list-group-item p-0"><button class="btn btn-success w-100" id="category-published"
                                    type="submit">publish</button>
                            </li>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $('#select-all-category').on('change', function() {
            var isChecked = this.checked;
            console.log(isChecked)
            $('.category-checked').each(function(index, item) {
                item.checked = isChecked;
            })
        })
        $("#sortable").sortable();
        $('#active-menu-sortable').sortable();
        $('#menu-publish-wrapper').hide();

        $('#category-add').on('click', function() {
            $('#sortable').empty()
            var categoryId = $('.category-checked').map(function(index, item) {
                if (item.checked) {
                    return item.value;
                }
            });
            if (categoryId.toArray().length != 0) {
                $('#menu-publish-wrapper').show();
                $.ajax({
                    url: '/admin/ajax/get-category',
                    method: 'get',
                    data: {
                        categories_id: categoryId.toArray().toString(),
                    },
                    success: function(data) {
                        data.forEach(category => {
                            $('#sortable').append(
                                `<li class="list-group-item mb-1 border border-secondary rounded" style="cursor:move;">${category.category_name}<span><input type="hidden" name="category_id[]"
                                            value="${category.id}"></span></li>`)
                        });
                    },
                    error: function(error) {
                        alert('error' + error)
                    },
                })
            } else {
                $('#menu-publish-wrapper').hide();
                Swal.fire(
                    'Info!',
                    'Select your menu first',
                    'info'
                )
            }
        })
    </script>
@endpush
