@extends('layouts.backend.app')
@section('title','create post')
@push('css')
<!-- Bootstrap Select Css -->
@endpush
@section('content')
  <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <a href="{{route('admin.post.index',$post->id)}}" class="btn btn-danger waves-effect">back</a>

        @if($post->is_aproved == false)
         <button class="btn btn-danger pull-right waves-effect" type="button" onclick="approvepost({{ $post->id }})">
            <i class="material-icons">done</i>
            <span>Aprove</span>
        </button>
        <form id="approve-form-{{ $post->id }}" action="{{ route('admin.post.approve',$post->id) }}" method="POST" style="display: none;">
            @csrf
            @method('PUT')
        </form>
        @else
         <button type="button" class="btn btn-success pull-right" disabled="disabled">
            <i class="material-icons">done</i>
            <span>Aproved</span>
        </button>
        @endif
        <br>
        <br>
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>  
                               {{$post->title}}
                               <small>Posted by <strong><a href="">{{$post->user->name}}</a></strong>on {{$post->created_at->toFormattedDateString()}}</small>
                            </h2>
                        </div>
                        <div class="body">
                           {!! $post->body !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>
                                Categories
                            </h2>
                        </div>
                        <div class="body">
                          @foreach($post->categores as $category)
                               <span class="label bg-cyan">{{$category->name}}</span>
                          @endforeach
                        </div>
                    </div>
                    <div class="card">
                        <div class="header bg-green">
                            <h2>
                                Tag
                            </h2>
                        </div>
                        <div class="body">
                          @foreach($post->tags as $tag)
                               <span class="label bg-green">{{$tag->name}}</span>
                          @endforeach
                        </div>
                    </div>
                     <div class="card">
                        <div class="header bg-amber">
                            <h2>
                                Feathur Image
                            </h2>
                        </div>
                        <div class="body">
                          <img class="img-responsive img-thumbnail" src="{{ asset('storage/post/'.$post->image) }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection

@push('js')
  <!-- Select Plugin Js -->
    <script src="{{asset('asset/backend/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>
    <!-- Bootstrap Tags Input Plugin Js -->
    <script src="{{asset('asset/backend/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
     <!-- TinyMCE -->
    <script src="{{asset('asset/backend/plugins/tinymce/tinymce.js')}}"></script>
    <script>
        $(function () {
    //TinyMCE
    tinymce.init({
        selector: "textarea#tinymce",
        theme: "modern",
        height: 300,
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true
    });
    tinymce.suffix = ".min";
    tinyMCE.baseURL = '{{asset('asset/backend/plugins/tinymce')}}';
});
    </script>

     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.19.1/dist/sweetalert2.all.min.js"></script>
<!-- swect aleart delet -->
     <script type="text/javascript">
         function approvepost(id){
            const swalWithBootstrapButtons = swal.mixin({
  confirmButtonClass: 'btn btn-success',
  cancelButtonClass: 'btn btn-danger',
  buttonsStyling: false,
})

swalWithBootstrapButtons({
  title: 'Are you sure?',
  text: "You will aprove this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, aprroved it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.value) {
     event.preventDefault();
    document.getElementById('approve-form-'+id).submit();
  } else if (
    // Read more about handling dismissals
    result.dismiss === swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons(
      'Cancelled',
      'Your post is panding :)',
      'error'
    )
  }
})
         }
     </script>
@endpush