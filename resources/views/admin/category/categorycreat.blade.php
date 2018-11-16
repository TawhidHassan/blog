@extends('layouts.backend.app')
@section('title','create category')
@push('css')

@endpush
@section('content')
  <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ENTER category
                            </h2>
                        </div>
                        <div class="body">
                            <form action="{{route('admin.category.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                                <label for="email_address">category NAME</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="name" class="form-control" placeholder="category name">
                                    </div>
                                </div>
                                <label for="email_address">category image</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file" name="image" class="form-control" >
                                    </div>
                                </div>
                                <button type="SUBMIT" name="SUBMIT" class="btn btn-primary m-t-15 waves-effect">SAVE</button>
                                <button type="button" class="btn btn-primary m-t-15 waves-effect"><a href="{{route('admin.category.index')}}" style="color:#FFFF;">BACK</a></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
@endsection

@push('js')
  
@endpush