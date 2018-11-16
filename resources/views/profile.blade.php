@extends('layouts.fontend.app')

@section('title')
{{$author->username}}
@endsection

@push('css')
<link href="{{asset('asset/fontend/css/home/styles.css')}}" rel="stylesheet">
<link href="{{asset('asset/fontend/css/home/responsive.css')}}" rel="stylesheet">
<link href="{{asset('asset/fontend/css/bootstrap.css')}} rel="stylesheet">
<link href="{{asset('asset/fontend/css/ionicons.css')}} rel="stylesheet">
<link href="{{asset('asset/fontend/css/profile/styles.css')}}" rel="stylesheet">
<link href="{{asset('asset/fontend/css/profile/responsive.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="slider display-table center-text">
        <h1 class="title display-table-cell"><b>{{$author->name}}</b></h1>
    </div><!-- slider -->

    <section class="blog-area section">
        <div class="container">

            <div class="row">

                <div class="col-lg-8 col-md-12">
                    <div class="row">
                       @if($posts->count() > 0)
                        @foreach($posts as $data)
                   <div class="col-md-6 col-sm-12">
                    <div class="card h-100">
                        <div class="single-post post-style-1">

                            <div class="blog-image"><img src="{{ asset('storage/post/'.$data->image) }}" alt="{{ $data->title }}"></div>

                            <a class="avatar" href="{{route('author.profile',$data->user->username)}}"><img src="{{Storage::url($data->user->image)}}" alt="Profile Image"></a>

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
                    
               @endif
                </div>
                </div><!-- col-lg-8 col-md-12 -->

                <div class="col-lg-4 col-md-12 ">

                    <div class="single-post info-area ">

                        <div class="about-area">
                            <h4 class="title"><b>ABOUT Author</b></h4>
                            <p>{{$author->name}}</p> <br>
                            <p> <strong>About: </strong> {{$author->about}}</p> <br>
                            <strong>Author Since: {{$author->created_at->toDateString()}}</strong> <br>
                            <strong>Total Post: {{$author->posts->count()}}</strong>
                        </div>
                    </div><!-- info-area -->

                </div><!-- col-lg-4 col-md-12 -->

            </div><!-- row -->
      </div>
        </div><!-- container -->
    </section><!-- section -->

@endsection

@push('js')

@endpush