@extends('layouts.fontend.app')

@section('title','blog')

@push('css')
<link href="{{asset('asset/fontend/css/home/styles.css')}}" rel="stylesheet">
<link href="{{asset('asset/fontend/css/home/responsive.css')}}" rel="stylesheet">
<style>
    .favorite_posts{
       color: #3356A5;
    }
</style>
@endpush

@section('content')
<div class="main-slider">
        <div class="swiper-container position-static" data-slide-effect="slide" data-autoheight="false"
            data-swiper-speed="500" data-swiper-autoplay="10000" data-swiper-margin="0" data-swiper-slides-per-view="4"
            data-swiper-breakpoints="true" data-swiper-loop="true" >
            <div class="swiper-wrapper">

                @foreach($category as $category)
                   <div class="swiper-slide">
                    <a class="slider-category" href="{{route('category.posts',$category->slug)}}">
                        <div class="blog-image"><img src="{{ asset('storage/category/slider/'.$category->image) }}" alt="{{ $category->name }}"></div>

                        <div class="category">
                            <div class="display-table center-text">
                                <div class="display-table-cell">
                                    <h3><b>{{$category->name}}</b></h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div><!-- swiper-slide -->
                @endforeach
                 
            </div><!-- swiper-wrapper -->

        </div><!-- swiper-container -->

    </div><!-- slider -->

    <section class="blog-area section">
        <div class="container">

            <div class="row">
                 @foreach($post as $data)
                   <div class="col-lg-4 col-md-6">
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
            </div><!-- row -->

            <a class="load-more-btn" href="#"><b>LOAD MORE</b></a>

        </div><!-- container -->
    </section><!-- section -->
@endsection

@push('js')

@endpush