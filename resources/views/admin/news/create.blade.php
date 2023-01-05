@extends('layouts.admin.layout')

@section('content')
    <section class="section dashboard">
        <main class="main" id="main">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <h1>News</h1>
                                <nav>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                                        <li class="breadcrumb-item active"><a
                                                href="{{ route('admin.news.index') }}">News</a></li>
                                    </ol>
                                </nav>
                            </div>
                            <a href="{{ route('admin.news.index') }}" class="btn btn-outline-primary">All News</a>
                        </div>
                        <div class="card-body">
                            <!-- Multi Columns Form -->
                            <form class="row g-3" method="POST" action="{{ route('admin.news.store') }}"
                                enctype="multipart/form-data" id="create_news">
                                @csrf
                                <div class="col-md-12">
                                    <label for="inputName5" class="form-label">News Title (<span
                                            class="text-danger">*</span>)</label>
                                    <textarea type="text" rows="3" class="form-control" id="title" name="title">{{ old('title') }}</textarea>
                                    @error('title')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="inputName5" class="form-label">slug (<span
                                            class="text-danger">*</span>)</label>
                                    <textarea type="text" rows="1" class="form-control" id="slug" name="slug">{{ old('slug') }}</textarea>
                                    @error('slug')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="inputEmail5" class="form-label">Featured Image (<span
                                            class="text-danger">*</span>)</label>
                                    <a class="btn" href="#" data-bs-toggle="modal" data-bs-target="#media-library">
                                        <i class="bi bi-folder"></i>
                                    </a>
                                    <div class="mt-1">
                                        <img src="" alt="preview image" style="height: 60px !important;"
                                            id="preview-image">
                                    </div>
                                    {{-- @include('admin.setting.media.components.image-listing') --}}
                                    <div class="modal fade" id="media-library" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Select Image
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div id="image_wrapper">
                                                        {!! $imageListing !!}
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @error('featured_image')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                    @error('image_id')
                                        <div class="text-danger">*Image must be selected !!</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="multiple select" class="form-label">Category (<span
                                            class="text-danger">*</span>)</label>
                                    @if ($categories->count() > 0)
                                        <select class="form-select" multiple="multiple" name="news_categories[]"
                                            id="category-select">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <div class="text-danger fst-italic">Add some category first</div>
                                    @endif
                                    @error('news_categories')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label for="inputState" class="form-label">Status (<span
                                            class="text-danger">*</span>)</label>
                                    <select id="inputState" class="form-select" name="is_published">
                                        <option selected=true value="1">Published</option>
                                        <option value="2">Not Published</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="inputState" class="form-label">News Setting (<span
                                            class="text-danger">*</span>)</label>
                                    <select id="inputState" class="form-select" name="is_trending_news">
                                        <option selected=true value="1">Trending News</option>
                                        <option value="0">Regular News</option>
                                    </select>
                                </div>
                                <div id="file-container"></div>
                                <div class="col-md-8">
                                    <label for="multiple select" class="form-label">Tags (<span
                                            class="text-danger">*</span>)</label>
                                    <select class="form-select" multiple="multiple" name="tags[]" id="tag-select">
                                        @if ($tags->count() > 0)
                                            @foreach ($tags as $tag)
                                                <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('tags')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <!-- Create the editor container -->
                                    <textarea name="description" id="description" class="d-none"></textarea>
                                    <div id="quill_editor" style="min-height: 200px;">
                                        {!! old('description') !!}
                                    </div>
                                    @error('description')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12" style="margin-top: 60px;">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-outline-success px-5">Submit</button>
                                        <button type="reset" class="btn btn-outline-secondary px-5">Reset</button>
                                    </div>
                                </div>
                            </form><!-- End Multi Columns Form -->
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </section>
@endsection

@push('scripts')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#tabs").tabs();
        });
    </script>
    <script>
        $(document).ready(function() {
            //create news js
            $('#category-select').select2();
            $('#tag-select').select2({
                tags: true,
                tokenSeparators: [',', ' '],
                createTag: function(newTag) {
                    return {
                        id: 'new:' + newTag.term,
                        text: newTag.term + '(new)'
                    };
                }
            });

            $("#title").keyup(function() {
                var Text = $(this).val();
                Text = Text.toLowerCase()
                    .replaceAll(' ', '-')
                $("#slug").val(Text);
            });
        });
    </script>
@endpush
