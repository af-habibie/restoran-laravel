@extends('layout.italiano')
@section('title') Items - Edit #{{ $item->id }} @endsection
@section('css')
    <style>
        .card {
            border: 1px solid #ff2d20;
        }
        .card-header {
            background-color: #ff2d20;
            border-bottom: 1px solid #ff2d20;
        }
        h3 {
            color: #ff2d20;
        }
        @media only screen and (max-width: 600px) {
            h3 {
                font-size: 1.5rem;
            }
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script>
        function preview(p) {
            if (p.files && p.files[0]) {
                var r = new FileReader();

                r.onload = function(e) {
                    $("img").removeClass("d-none");
                    $("img").addClass("mt-2");
                    $("img").attr("src", e.target.result);
                }

                r.readAsDataURL(p.files[0]); // convert to base64 string
            }
        }

        $(document).ready(function() {
            $("input[name=image]").on("change", function() {
                preview(this);
            });

            $('.summernote').summernote({
                height:380
            });
        });
    </script>
@endsection
@section('content')
    <div class="container-fluid mt-3 mb-3">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="card rounded-0">
                    <div class="card-header rounded-0">
                        <div class="row">
              <div class="col-lg-7 col-7"><h3 class="text-white mb-0">Items - Edit #{{ $item->id }}</h3></div>
                            <div class="col-lg-5 col-5 text-right">
                                <a href="{{ route('items.index') }}" class="btn btn-dark rounded-0"><i class="fas fa-backspace"></i> Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
            <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            <div class="form-group">
                                <label for="name"><strong>Name</strong><span class="text-danger">*</span></label>k
                                <input type="text" name="name" value="{{ $item->name }}" class="form-control">
                                @error('name') <div class="alert alert-danger mt-1"><code>{{ $message }}</code></div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="slug"><strong>Slug</strong><span class="text-danger">*</span></label>k
                                <input type="text" name="slug" value="{{ $item->slug }}" class="form-control">
                                @error('slug') <div class="alert alert-danger mt-1"><code>{{ $message }}</code></div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="description"><strong>Description</strong><span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control summernote">{{ $item->description }}</textarea>
                                @error('description') <div class="alert alert-danger mt-1"><code>{{ $message }}</code></div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="image"><strong>Image</strong><span class="text-danger">*</span></label>k
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input">
                                    <label for="image" class="custom-file-label">Choose File</label>
                                </div>
                                <img src="" alt="Preview" class="d-none img-thumbnail" width="150">
                            </div>
                            <div class="form-group">
                                <label for="price"><strong>Price</strong><span class="text-danger">*</span></label>k
                                <input type="text" name="price" value="{{ $item->price }}" class="form-control">
                                @error('price') <div class="alert alert-danger mt-1"><code>{{ $message }}</code></div> @enderror
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection