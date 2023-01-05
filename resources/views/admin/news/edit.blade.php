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
                            <form class="row g-3" method="POST" action="{{ route('admin.news.update', $news->id) }}"
                                id="edit_news" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="col-md-12">
                                    <label for="inputName5" class="form-label">News Title</label>
                                    <textarea type="text" rows="3" class="form-control" id="inputName5" name="title">{{ $news->title }}</textarea>
                                    @error('title')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="inputName5" class="form-label">slug</label>
                                    <textarea type="text" rows="1" class="form-control" id="inputName5" name="slug">{{ $news->slug }}</textarea>
                                    @error('slug')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="inputEmail5" class="form-label">Featured Image</label>
                                    <a class="btn" href="#" data-bs-toggle="modal" data-bs-target="#media-library">
                                        <i class="bi bi-folder"></i>
                                    </a>
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
                                    {{-- @if ($news->featured_image_name = !null) --}}
                                    <div class="mt-1">
                                        <img src="{{ asset('storage/images') }}/{{ $news->featured_image_name }}"
                                            alt="preview image" style="height: 60px !important;" id="preview-image">
                                    </div>
                                    {{-- @endif --}}
                                </div>
                                <div class="col-md-4">
                                    <label for="multiple select" class="form-label">Category</label>
                                    @if ($categories->count() > 0)
                                        <select class="form-select" multiple="multiple" name="news_categories[]"
                                            id="category-select">
                                            @foreach ($categories as $category)
                                                @if (in_array($category->id, $selectedCategoryIds))
                                                    <option value="{{ $category->id }}" selected>
                                                        {{ $category->category_name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $category->id }}">{{ $category->category_name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    @else
                                        <div class="alert alert-danger disable">Add some category first</div>
                                    @endif
                                    @error('news_categories')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label for="inputState" class="form-label">Status</label>
                                    <select id="inputState" class="form-select" name="is_published">
                                        <option @if ($news->is_published) selected=true @endif value="1">
                                            Published</option>
                                        <option @if (!$news->is_published) selected = true @endif value="0">Not
                                            Published</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="inputState" class="form-label">Trending News</label>
                                    <select id="inputState" class="form-select" name="is_trending_news">
                                        <option @if ($news->is_trending_news) selected = true @endif value="1">
                                            Trending News</option>
                                        <option @if (!$news->is_trending_news) selected = true @endif value="0">
                                            Regular News</option>
                                    </select>
                                </div>
                                <div id="file-container"></div>
                                <div class="col-md-8">
                                    <label for="multiple select" class="form-label">Tags (<span
                                            class="text-danger">*</span>)</label>
                                    <select class="form-select" multiple="multiple" name="tags[]" id="tag-select">
                                        @if ($tags->count() > 0)
                                            @foreach ($tags as $tag)
                                                @if (in_array($tag->id, $news->tags->pluck('id')->toArray()))
                                                    <option value="{{ $tag->id }}" selected="true">
                                                        {{ $tag->tag_name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $tag->id }}">{{ $tag->tag_name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('tags')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <textarea name="description" id="description" class="d-none"></textarea>
                                    <div id="quill_editor" style="min-height: 300px !important">
                                        {!! $news->description !!}
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
    <script>
        $(document).ready(function() {

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

        });
    </script>
@endpush
