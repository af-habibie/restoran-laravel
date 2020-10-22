@extends('layout.italiano')
@section('title') Items - Manage @endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
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
                font-size: 1.6rem;
            }
        }
    </style>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
@endsection
@section('content')
 <div class="container-fluid mt-3 mb-3">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            @if (Session::get("success"))
                <div class="alert alert-success">{{ Session::get("success") }}</div>
            @endif
            <div class="card rounded-0">
                <div class="card-header rounded-0">
                    <div class="row">
                        <div class="col-lg-7 col-7"><h3 class="text-white mb-0">items - Manage</h3></div>
                        <div class="col-lg-5 col-5 text-right"><a href="{{ route('items.create') }}" class="btn btn-dark rounded-0k"><i class="fas fa-plus-circle"></i></a></div>
                    </div>
                </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            @if (count($items) > 0)
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Name</th>
                                    <th class="d-xl-block d-lg-block d-sm-none d-none">Slug</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th class="d-xl-block d-lg-block d-sm-none d-none">Price</th>
                                    <th width="130">Actions</th>
                                </tr>
                            </thead>
                            @endif
                            <tbody>
                                @if (count($items) > 0)
                                  @foreach($items as $no => $food)
                                    <tr>
                                        <td class="text-center">{{ ++$no }}</td>
                                        <td>{{ $food->name }}</td>
                                        <td class="d-xl-block d-lg-block d-sm-none d-none">{{ $food->slug }}</td>
                                        <td>{!! $food->description !!}</td>
                                        <td>
                                            <a href="{{ asset('images/items/'.$food->image) }}" data-fancybox data-caption="{{ $food->name }}" class="link">Show Image</a>
                                        </td>
                                        <td class="d-xl-block d-lg-block d-sm-none d-none">Rp. {!! number_format($food->price, 0, ".", ".") !!}</td>
                                        <td>
                                            <a href="{{ route('items.show', $food->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-search"></i></a>
                                            <a href="{{ route('items.edit', $food->id) }}" class="btn btn-sm btn-success"><i class="fas fa-pencil-alt"></i></a>
                                            <form action="{{ route('items.destroy', $food->id ) }}" method="post" class="d-inline">
                                                @csrf
                                                @method("DELETE")
                                                <button type="submit" name="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash">
                                                </i></button>
                                            </form>
                                        </td>
                                    </tr>
                                  @endforeach
                                @else
                                    <tr>
                                      <td colspan="9"><code>The item Data Is Empty/null. Please Create A New Data</code></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div>
@endsection