{{-- <div class="row">
    <div class="col-md-4">
        <div class="card card-body">
            <div class="mb-2">
                <label for="" class="form-label">Upload Image</label>
                <input type="file" class="form-control" name="image_name" id="upload_image">
            </div>
            <div class="mb-2">
                <button type="button" class="btn btn-success" id="save_image">Save</button>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        @if ($images->count() > 0)
            <div class="row">
                @foreach ($images as $image)
                    <div class="col-md-3">
                        <div class="card hover_image" data-id="{{ $image->id }}">
                            <img src="{{ asset('storage/images') }}/{{ $image->image_name }}" alt="image"
                                class="img-thumbnail" style="padding: .5px">
                        </div>
                    </div>
                @endforeach
            </div>
            {!! $images->links() !!}
        @else
            <h4 class="card-heading">No images uploaded at</h4>
        @endif
    </div>
</div> --}}

<div id="tabs">
    <ul>
        <li><a href="#tabs-1">Upload Image</a></li>
        <li><a href="#tabs-2">Select Image</a></li>
    </ul>
    <div id="tabs-1">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-body">
                    <div class="mb-2">
                        <label for="" class="form-label">Upload Image</label>
                        <input type="file" class="form-control" name="image_name" id="upload_image">
                    </div>
                    <div class="mb-2">
                        <button type="button" class="btn btn-success" id="save_image">Save</button>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                @if ($images->count() > 0)
                    <div class="row">
                        @foreach ($images as $image)
                            <div class="col-md-3">
                                <div class="card hover_image" data-id="{{ $image->id }}">
                                    <img src="{{ asset('storage/images') }}/{{ $image->image_name }}" alt="image"
                                        class="img-thumbnail" style="padding: .5px">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {!! $images->links() !!}
                @else
                    <h4 class="card-heading">No images uploaded at</h4>
                @endif
            </div>
        </div>
    </div>
    <div id="tabs-2">
        <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc.
            Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut
            tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam.
            Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc.
            Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat,
            tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris
            consectetur tortor et purus.</p>
    </div>
</div>
