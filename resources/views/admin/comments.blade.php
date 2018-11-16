@extends('layouts.backend.app')
@section('title','comments')
@push('css')
 JQuery DataTable Css
<link href="{{asset('asset/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
@endpush
@section('content')
<div class="container-fluid">
            <div class="block-header">
                <h2>
                  coments
                </h2>
            </div>
            Exportable Table
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                All favorite post
                                <span class="badge badge-success">{{$comments->count()}}</span>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">comments info</th>
                                            <th class="text-center">post info</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach($comments as $key=>$post)
                                        <tr>
                                          <td>
                                            <div class="dedia">
                                              <div class="media-left">
                                                <a href="">
                                                  <img class="media-object" src="{{Storage::url($post->user->image)}}" alt="" width="64" height="64">
                                                </a>
                                              </div>
                                              <div class="media-body">
                                                <h4 class="media-heading">{{$post->user->name}} <small>{{$post->created_at->diffForHumans()}}</small></h4>
                                                <p>{{$post->coment}}</p>
                                                <a href="" target="_blank">{{route('post.details',$post->slug.'#post')}}>Reply</a>
                                              </div>
                                            </div>
                                          </td>
                                          <td>
                                            <div class="media">
                                                    <div class="media-right">
                                                        <a target="_blank" href="{{ route('post.details',$post->post->slug) }}">
                                                            <img class="media-object" src="{{Storage::url($post->post->user->image)}}" width="64" height="64">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <a target="_blank" href="{{ route('post.details',$post->post->slug) }}">
                                                            <h4 class="media-heading">{{ str_limit($post->post->title,'40') }}</h4>
                                                        </a>
                                                        <p>by <strong>{{ $post->post->user->name }}</strong></p>
                                                    </div>
                                                </div>
                                          </td>
                                          <td>
                                            <button type="button" class="btn btn-danger waves-effect" onclick="deleteComment({{ $post->id }})">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                                <form id="delete-form-{{ $post->id }}" method="POST" action="{{ route('admin.comment.destroy',$post->id) }}" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                          </td>
                                        </tr>
                                         @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            #END# Exportable Table
        </div>
@endsection

@push('js')
  Jquery DataTable Plugin Js
    <script src="{{asset('asset/backend/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('asset/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('asset/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('asset/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
    <script src="{{asset('asset/backend/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{asset('asset/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
    <script src="{{asset('asset/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{asset('asset/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
    <script src="{{asset('asset/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>
     <script src="{{asset('asset/backend/js/pages/tables/jquery-datatable.js')}}"></script>
   <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        function deleteComment(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endpush