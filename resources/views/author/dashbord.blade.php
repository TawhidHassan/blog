@extends('layouts.backend.app')
@section('title','login')
@push('css')

@endpush
@section('content')

        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL POSTS</div>
                            <div class="number count-to" data-from="0" data-to="{{$post->count()}}" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">favorite</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL FAVORIE</div>
                            <div class="number count-to" data-from="0" data-to="{{Auth::user()->favorite_to_posts()->count()}}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">library_books</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL PANDING</div>
                            <div class="number count-to" data-from="0" data-to="{{$total_pending_posts}}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL VIEW</div>
                            <div class="number count-to" data-from="0" data-to="{{$all_view}}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->

            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>TOP % POPULER POST</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>Rank List</th>
                                            <th>Title</th>
                                            <th>Views</th>
                                            <th>Favorite</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                         @foreach($popular_post as $key=>$data)
                                          <td>{{$key +1}}</td>
                                          <td>{{str_limit($data->title,30)}}</td>
                                          <td>{{$data->view_count}}</td>
                                          <td>{{$data->favorite_to_users_count}}</td>
                                          <td>{{$data->comments_count}}</td>
                                          <td>
                                              @if($data->statas== true)
                                                  <span class="label label-success bg-success">publish</span>
                                              @else
                                                  <span class="label label-warning bg-warning">pending</span>
                                              @endif
                                          </td>
 
                                         @endforeach
                                        </tr>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
            </div>
        </div>
@endsection

@push('js')
      <script src="{{asset('asset/backend/plugins/jquery-countto/jquery.countTo.js')}}"></script>
    <!-- Morris Plugin Js -->
    <script src="{{asset('asset/backend/plugins/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('asset/backend/plugins/morrisjs/morris.js')}}"></script>
    <!-- ChartJs -->
    <script src="{{asset('asset/backend/plugins/chartjs/Chart.bundle.js')}}"></script>
    <!-- Flot Charts Plugin Js -->
    <script src="{{asset('asset/backend/plugins/flot-charts/jquery.flot.js')}}"></script>
    <script src="{{asset('asset/backend/plugins/flot-charts/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('asset/backend/plugins/flot-charts/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('asset/backend/plugins/flot-charts/jquery.flot.categories.js')}}"></script>
    <script src="{{asset('asset/backend/plugins/flot-charts/jquery.flot.time.js')}}"></script>
       <script src="{{asset('asset/backend/js/pages/index.js')}}"></script>
@endpush