@extends('layouts.backend.app')
@section('title','post')
@push('css')
 <!-- JQuery DataTable Css -->
<link href="{{asset('asset/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
@endpush
@section('content')
<div class="container-fluid">
            <div class="block-header">
                <h2>
                    JQUERY DATATABLES
                    <small>Taken from <a href="{{route('admin.post.create')}}" target="_blank" style="color: red;font-size: 20px;font-weight: bolder;border:2px solid red;padding:2px;">CREATE POST</a></small>
                </h2>
            </div>
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                All post
                                <span class="badge badge-success">{{$post->count()}}</span>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Title</th>
                                            <th><i class="material-icons">remove_red_eye</i></th>
                                            <th>Aprove</th>
                                            <th>statas</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach($post as $key=>$post)
                                        <tr>
                                               <td>{{$key + 1}}</td>
                                               <td>{{$post->user->name}}</td>
                                               <td>{{str_limit($post->title,'10')}}</td>
                                               <td>{{$post->view_count}}</td>
                                               <td>@if($post->is_aproved==true)
                                                 <span class="badge badge-success">Approved</span>
                                               @else
                                                  <span class="badge badge-danger">Pending</span>
                                               @endif
                                             </td>
                                             <td>@if($post->statas==true)
                                                 <span class="badge badge-info">Publish</span>
                                               @else
                                                  <span class="badge badge-danger">NotPublish</span>
                                               @endif
                                             </td>
                                               <td>{{$post->created_at}}</td>
                                               <td class="text-center">
                                                <a href="{{route('admin.post.show',$post->id)}}" class="btn btn-success waves-effect"><i class="material-icons">remove_red_eye</i></a>

                                                <a href="{{route('admin.post.edit',$post->id)}}" class="btn btn-info waves-effect"><i class="material-icons">edit</i></a>

                                                  <button class="btn btn-danger waves-effect" type="button" onclick="deletepost({{ $post->id }})">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                                <form id="delete-form-{{ $post->id }}" action="{{ route('admin.post.destroy',$post->id) }}" method="POST" style="display: none;">
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
            <!-- #END# Exportable Table -->
        </div>
@endsection

@push('js')
  <!-- Jquery DataTable Plugin Js -->
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
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.19.1/dist/sweetalert2.all.min.js"></script>
<!-- swect aleart delet -->
     <script type="text/javascript">
         function deletepost(id){
            const swalWithBootstrapButtons = swal.mixin({
  confirmButtonClass: 'btn btn-success',
  cancelButtonClass: 'btn btn-danger',
  buttonsStyling: false,
})

swalWithBootstrapButtons({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.value) {
     event.preventDefault();
    document.getElementById('delete-form-'+id).submit();
  } else if (
    // Read more about handling dismissals
    result.dismiss === swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons(
      'Cancelled',
      'Your data is safe :)',
      'error'
    )
  }
})
         }
     </script>
@endpush