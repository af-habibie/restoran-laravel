@extends('layout.italiano')
@section('title') Items - Create @endsection
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
				font-size: 1.6rem;
			}
		}
	</style>
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
	function preview(p) {
		if (p.files && p.files[0]) {
			var r = new FileReader();

			r.onload = function(e) {
				$("img").removeClass("d-none");
				$("img").addClass("mt-2");
				$("img").attr("src", e.target.result);
			}

			r.readAsDataURL(p.files[0]); //coonvert to based string
		}
	}

	$(document).ready(function() {
		$("input[name=image]").on("change", function() {
			preview(this);
		});

		$('.summernote').summernote();
	});

	$(document).ready(function() {
		$('.summernote').summernote();
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
                        <div class="col-lg-7 col-7"><h3 class="text-white mb-0">Items - Create</h3></div>
                        <div class="col-lg-5 col-5 text-right"><a href="{{ route('items.index') }}" class="btn btn-dark rounded-0k"><i class="fas fa-backspace"></i> Back</a></div>
                    </div>
                </div>
 				<div class="card-body">
 					<form action="{{ route('items.store')}}" method="post" enctype="multipart/form-data">
 						@csrf
 						<div class="form-group">
 							<label for="name"><strong> Name</strong><span class="text-danger">*</span></label>
 							<input type="text" name="name" placeholder="Name" class="form-control">
 							@error('name') <div class="alert alert-danger mt-1"><code>{{ $message }}</code></div> @enderror
  						</div>
 						<div class="form-group">
 							<label for="slug"><strong> Slug</strong><span class="text-danger">*</span></label>
 							<input type="text" name="slug" placeholder="Slug" class="form-control">
 							@error('slug')  <div class="alert alert-danger mt-1"><code>{{ $message }}</code></div> @enderror
 						</div>
 						<div class="form-group">
 							<label for="name"><strong> Description</strong><span class="text-danger">*</span></label>
 							<textarea name="description" placeholder="Description" class="form-control summernote"></textarea>
 							@error('description')  <div class="alert alert-danger mt-1"><code>{{ $message }}</code></div> @enderror
 						</div>
 						<div class="form-group">
 							<label for="name"><strong> Image</strong><span class="text-danger">*</span></label>
 							<div class="custom-file">
 							<input type="file" name="image" class="custom-file-input">
 							<label for="image" class="custom-file-label"> Choose File</label>
 						</div>
 							@error('image')  <div class="alert alert-danger mt-1"><code>{{ $message }}</code></div> @enderror
 							<img src="" alt="Preview" class="d-none img-thimbnail" width="150">
 						</div>
 						<div class="form-group">
 							<label for="name"><strong> Price</strong><span class="text-danger">*</span></label>
 							<input type="text" name="price" placeholder="Price" class="form-control">
 							@error('price') <div class="alert alert-danger mt-1"><code>{{ $message }}</code></div> @enderror
 						</div>
 						<button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i>Create</button>
 					</form>
 				</div>
 			</div>
 		</div>
 	</div>
@endsection