@extends('layouts.fontend.app')

@section('title')

@push('css')
<link href="{{asset('asset/fontend/css/home/styles.css')}}" rel="stylesheet">
<link href="{{asset('asset/fontend/css/home/responsive.css')}}" rel="stylesheet">
<link href="{{asset('asset/fontend/css/bootstrap.css')}} rel="stylesheet">
<link href="{{asset('asset/fontend/css/ionicons.css')}} rel="stylesheet">
<style>
    .header-bg{
        height: 400px;
        width: 100%;
        background-image: url({{ asset('storage/post/'.$post->image) }});
        background-size: cover;
        background-position: center;
    }
</style>
@endpush

@section('content')
 <div class="header-bg">
    </div><!-- slider -->
<section class="post-area section">
        <div class="container">

            <div class="row">

                <div class="col-lg-8 col-md-12 no-right-padding">

                    <div class="main-post">

                        <div class="blog-post-inner">

                            <div class="post-info">

                                <div class="left-area">
                                    <a class="avatar" href="#"><img src="{{Storage::url($post->user->image)}}" alt="Profile Image"></a>
                                </div>

                                <div class="middle-area">
                                    <a class="name" href="#"><b>{{$post->user->name}}</b></a>
                                    <h6 class="date">{{$post->created_at->diffForHumans()}}</h6>
                                </div>

                            </div><!-- post-info -->

                            <h3 class="title"><a href="#"><b>{{$post->title}}</b></a></h3>

                            <p class="para">{!! html_entity_decode($post->body)!!}</p>

                            <div class="post-image"><img src="{{ asset('storage/post/'.$post->image) }}" alt="Blog Image"></div>

                            <ul class="tags">
                                
                                @foreach($post->tags as $tag)
                                <li><a href="{{route('tag.posts',$tag->slug)}}">{{$tag->name}}</a></li>
                                @endforeach
                            </ul>
                        </div><!-- blog-post-inner -->

                        <div class="post-icons-area">
                            <ul class="post-footer" >
                                    <li>
                                     @guest
                                     <a href="javascript:void(0);" onclick="toastr.info('To add favorite list. You need to login first.','Info',{
                                                    closeButton: true,
                                                    progressBar: true,
                                                })"><i class="material-icons">favorite_border</i>{{ $post->favorite_to_users->count() }}</a>
                                       
                                    @else
                                    <a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $post->id }}').submit();" class="class="{{ !Auth::user()->favorite_to_posts->where('pivot.post_id',$post->id)->count()  == 0 ? 'favorite_posts' : ''}}">
                                        <i class="material-icons">favorite_border</i>{{ $post->favorite_to_users->count() }}
                                          </a>

                                                <form id="favorite-form-{{ $post->id }}" method="POST" action="{{ route('post.favorite',$post->id) }}" style="display: none; overflow: hidden;">
                                                    @csrf
                                                </form>
                                    </form>
                                    @endguest
                                        
                                    </li>
                                    <li><a href="#"><i class="material-icons">filter_frames</i></a>{{$post->comments()->count() }}</li>
                                    <li><a href="#"><i class="material-icons">remove_red_eye</i>{{$post->view_count}}</a></li>
                                </ul>

                            <ul class="icons" style="margin-top: -50px;">
                                <li>SHARE : </li>
                                <li><a href="#"><small><b>facebook</b></small></a></li>
                                <li><a href="#"><small><b>twiter</b></small></a></li>
                                <li><a href="#"><small><b>youtube</b></small></a></li>
                            </ul>
                        </div>
                    </div><!-- main-post -->
                </div><!-- col-lg-8 col-md-12 -->

                <div class="col-lg-4 col-md-12 no-left-padding">

                    <div class="single-post info-area">

                        <div class="sidebar-area about-area">
                            <h4 class="title"><b>About Author</b></h4>
                            <p>{{$post->user->about}}</p>
                        </div>

                        <div class="tag-area">

                            <h4 class="title"><b>Category </b></h4>
                            <ul>
                                 @foreach($post->categores as $tag)
                                <li><a href="{{route('category.posts',$tag->slug)}}">{{$tag->name}}</a></li>
                                @endforeach
                            </ul>    

                        </div><!-- subscribe-area -->

                    </div><!-- info-area -->

                </div><!-- col-lg-4 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section><!-- post-area -->

    <section class="recomended-area section">
        <div class="container">
            <div class="row">
         @foreach($randompost as $randompost)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">

                            <div class="blog-image"><img src="{{ asset('storage/post/'.$randompost->image) }}" alt="{{ $randompost->title }}"></div>

                            <a class="avatar" href="{{route('author.profile',$randompost->user->username)}}"><img src="{{Storage::url($randompost->user->image)}}" alt="Profile Image"></a>

                            <div class="blog-info">

                                <h4 class="title"><a href="{{ route('post.details',$randompost->slug) }}"><b>{{ $randompost->title }}</b></a></h4>

                                <ul class="post-footer">
                                    <li>
                                     @guest
                                     <a href="javascript:void(0);" onclick="toastr.info('To add favorite list. You need to login first.','Info',{
                                                    closeButton: true,
                                                    progressBar: true,
                                                })"><i class="material-icons">favorite_border</i>{{ $randompost->favorite_to_users->count() }}</a>
                                       
                                    @else
                                    <a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $randompost->id }}').submit();" class="class="{{ !Auth::user()->favorite_to_posts->where('pivot.post_id',$randompost->id)->count()  == 0 ? 'favorite_posts' : ''}}">
                                        <i class="material-icons">favorite_border</i>{{ $randompost->favorite_to_users->count() }}
                                          </a>

                                                <form id="favorite-form-{{ $randompost->id }}" method="POST" action="{{ route('post.favorite',$randompost->id) }}" style="display: none;">
                                                    @csrf
                                                </form>
                                    </form>
                                    @endguest
                                        
                                    </li>
                                    <li><a href="#"><i class="material-icons">filter_frames</i>{{$randompost->comments()->count() }}</a></li>
                                    <li><a href="#"><i class="material-icons">remove_red_eye</i>{{$randompost->view_count}}</a></li>
                                </ul>

                            </div><!-- blog-info -->
                        </div><!-- single-post -->
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->
         @endforeach
            </div><!-- row -->

        </div><!-- container -->
    </section>

    <section class="comment-section">
        <div class="container">
            <h4><b>POST COMMENT</b></h4>
            <div class="row">

                <div class="col-lg-8 col-md-12">
                    <div class="comment-form">
                        @guest
                           <h4>ypu can not login ,plase login first <a href="{{route('login')}}"><b><strong>login</strong></b></a></h4>
                        @else
                        <form method="post" action="{{ route('comment.store',$post->id) }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <textarea name="coment" rows="2" class="text-area-messge form-control"
                                        placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
                                </div><!-- col-sm-12 -->
                                <div class="col-sm-12">
                                    <button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
                                </div><!-- col-sm-12 -->

                            </div><!-- row -->
                        </form>
                        @endguest
                    </div><!-- comment-form -->
                     @if($post->comments()->count()>0)
                    <h4><b>COMMENTS({{$post->comments()->count() }})</b></h4>
                     @foreach($post->comments as $coment)
                    <div class="commnets-area">
                        <div class="comment">
                            <div class="post-info">

                                <div class="left-area">
                                    <a class="avatar" href="#"><img src="{{Storage::url($coment->user->image)}}" alt="Profile Image"></a>
                                </div>

                                <div class="middle-area">
                                    <a class="name" href="#"><b>{{$coment->user->name}}</b></a>
                                    <h6 class="date">{{$coment->created_at->diffForHumans()}}</h6>
                                </div>
                            </div><!-- post-info -->

                            <p>{{$coment->coment}}</p>

                        </div>

                    </div><!-- commnets-area -->
                    @endforeach
                    @else
                    <h4><b> <strong style="color: red;"> There is no comment!!!</strong></b></h4>
                    @endif
                </div><!-- col-lg-8 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section>
@endsection

@push('js')

@endpus