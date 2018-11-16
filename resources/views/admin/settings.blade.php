@extends('layouts.backend.app')
@section('title','settings')
@push('css')
 <!-- JQuery DataTable Css -->
<link href="{{asset('asset/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
@endpush
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                TABS WITH ICON TITLE
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#profile_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">face</i> UPDATE PR
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#settings_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">settings</i> SETTINGS
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="profile_with_icon_title">
                                    <b>profile update</b>
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                INPUT INFORMATION
                            </h2>
                        </div>
                        <div class="body">
                            <form method="POST" enctype="multipart/form-data" action="{{route('admin.profile.update')}}">
                                @csrf
                                @method('PUT')
                                <label for="name">Namr</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="name" class="form-control" placeholder="Enter name" name="name" value="{{Auth::user()->name}}">
                                    </div>
                                </div>

                                <label for="email_address">Email Address</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="email_address" class="form-control" placeholder="Enter your email address" name="email" value="{{Auth::user()->email}}">
                                    </div>
                                </div>

                                 <label for="image">Profile image</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file" id="image" class="form-control" name="image">
                                    </div>
                                </div>
                                

                                <label for="about">About</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea rows="5" id="about" class="form-control" name="about">
                                            {{Auth::user()->about}}
                                        </textarea>
                                    </div>
                                </div>
                               

                                <br>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="settings_with_icon_title">
                                    <b>Password</b>
                                     <form method="POST" enctype="multipart/form-data" action="{{route('admin.password.update')}}">
                                @csrf
                                @method('PUT')
                               
                                <label for="oldpassword">Old password</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" id="oldpassword" class="form-control" placeholder="Enter your old password" name="old_password">
                                    </div>
                                </div>
                                 
                                 <label for="newpassword">New password</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" id="newpassword" class="form-control" placeholder="Enter your old password" name="password">
                                    </div>
                                </div>
                                <label for="confirm_password">Confirem password</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" id="confirm_password" class="form-control" placeholder="confirem password" name="password_confirmation">
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                            </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection

@push('js')

     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.19.1/dist/sweetalert2.all.min.js"></script>

     <script type="text/javascript">
         function deleteTag(id){
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