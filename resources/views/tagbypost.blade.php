@extends('layouts.fontend.app')

@section('title','post')

@push('css')
<link href="{{asset('asset/fontend/css/home/styles.css')}}" rel="stylesheet">
<link href="{{asset('asset/fontend/css/home/responsive.css')}}" rel="stylesheet">
<link href="{{asset('asset/fontend/css/bootstrap.css')}} rel="stylesheet">
<link href="{{asset('asset/fontend/css/ionicons.css')}} rel="stylesheet">
<link href="{{asset('asset/fontend/css/category/styles.css')}}" rel="stylesheet">
    <link href="{{asset('asset/fontend/css/category/responsive.css')}}" rel="stylesheet">
<style>
   .slider{
    height: 400px;
    width: 100%;
    
    background-size: cover;
   }
    
</style>
@endpush

@section('content')
 <div class="slider display-table center-text">
        <h1 class="title display-table-cell"><b>{{$tags->name}}</b></h1>
    </div><!-- slider -->

    <section class="blog-area section">
        <div class="container">

            <div class="row">
                @if($posts->count() > 0)
                  @foreach($posts as $data)
                   <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">

                            <div class="blog-image"><img src="{{ asset('storage/post/'.$data->image) }}" alt="{{ $data->title }}"></div>

                            <a class="avatar" href="#"><img src="{{Storage::url($data->user->image)}}" alt="Profile Image"></a>

                            <div class="blog-info">

                                <h4 class="title"><a href="{{ route('post.details',$data->slug) }}"><b>{{ $data->title }}</b></a></h4>

                                <ul class="post-footer">
                                    <li>
                                     @guest
                                     <a href="javascript:void(0);" onclick="toastr.info('To add favorite list. You need to login first.','Info',{
                                                    closeButton: true,
                                                    progressBar: true,
                                                })"><i class="material-icons">favorite_border</i>{{ $data->favorite_to_users->count() }}</a>
                                       
                                    @else
                                    <a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $data->id }}').submit();" class="class="{{ !Auth::user()->favorite_to_posts->where('pivot.post_id',$data->id)->count()  == 0 ? 'favorite_posts' : ''}}">
                                        <i class="material-icons">favorite_border</i>{{ $data->favorite_to_users->count() }}
                                          </a>

                                                <form id="favorite-form-{{ $data->id }}" method="POST" action="{{ route('post.favorite',$data->id) }}" style="display: none;">
                                                    @csrf
                                                </form>
                                    </form>
                                    @endguest
                                        
                                    </li>
                                    <li><a href="#"><i class="material-icons">filter_frames</i>{{$data->comments()->count() }}</a></li>
                                    <li><a href="#"><i class="material-icons">remove_red_eye</i>{{$data->view_count}}</a></li>
                                </ul>

                            </div><!-- blog-info -->
                        </div><!-- single-post -->
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->
                 @endforeach
                 @else
                   <div class="col-lg-12 col-md-12">
                    <div class="card h-100">
                        <div class="single-post post-style-1">
                                <div class="blog-info">
                                    <h4  class="title">
                                        <strong>sorry there is no post for this catrgory</strong>
                                    </h4>
                                </div>
                            </div><!-- blog-info -->
                        </div><!-- single-post -->
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->
                 @endif
            </div><!-- row -->


        </div><!-- container -->
    </section><!-- section -->



@endsection

@push('js')

@endpush