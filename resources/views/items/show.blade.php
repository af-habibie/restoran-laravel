@extends('layout.italiano')
@section('title') items - View #{{ $item->id }}@endsection
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
      h3{
        font-size: 1.5rem;
      }
    }
  </style>
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
  $(document).ready(function() {
    $('.summernote').summernote("disable");
  })
</script>
@endsection
@section('content')
   <div class="container-fluid mt-3 mb-3">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-12">
      <div class="card rounded-0">
        <div class="card-header rounded-0">
                    <div class="row">
                        <div class="col-lg-7 col-7"><h3 class="text-white mb-0">items - View#{{ $item->id }}</h3></div>
                        <div class="col-lg-5 col-5 text-right"><a href="{{ route('items.index') }}" class="btn btn-dark rounded-0k"><i class="fas fa-backspace"></i> Back</a></div>
                    </div>
                </div>
        <div class="card-body">
          <form action="{{ route('items.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="name"><strong> Name</strong></label>
              <input type="text" name="name" value="{{ $item->name }}" readonly="readonly" class="form-control">
              </div>
            <div class="form-group">
              <label for="slug"><strong> Slug</strong></label>
              <input type="text" name="slug" value="{{ $item->slug }}" readonly="readonly" class="form-control">
            </div>
            <div class="form-group">
              <label for="name"><strong> Description</strong></label>
              <textarea name="description" class="form-control summernote">{!! $item->description !!}</textarea>
            </div>
            <div class="form-group">
              <label for="name" class="d-block"><strong> Image</strong></label>
              <a href="{{ asset('images/items/'.$item->image) }}" data-fancybox data-caption="{{ $item->name }}" class="link">
              <img src="{{ asset('images/items/'.$item->image) }}" alt="Preview" class="img-thumbnail" width="100">
              </a>
            </div>
            <div class="form-group">
              <label for="price"><strong> Price</strong></label>
              <input type="text" name="price" value="{{ $item->price }}" readonly="readonly" class="form-control">
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection