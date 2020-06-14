<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{url('admin/home')}}">Dashboard</a>
  </li>
  <li class="breadcrumb-item active"><a href="{{url('admin/artikel')}}">Artikel</a></li>
  <li class="breadcrumb-item active">Create-new</li>
</ol>

<div class="card card-default">
  <div class="card-header">
    <i class="fab fa-blogger"></i> Create
  </div>
  <div class="card-body">
    {{ Form::open(array('url' => 'admin/artikel/create-new', 'class' => 'form-horizontal','files' => true)) }}

      <div class="form-group">
        <label for="exampleFormControlInput1">Title</label>
          <input type="text" class="form-control" name="title" value="" required>
      </div>

      <div class="form-group">
        <label for="exampleFormControlInput1">Content</label>
        <textarea class="form-control summernote" name="body" rows="3"></textarea>
      </div>

      <div class="form-group">
        <label for="">Tags</label>
        <select class="form-control select2" name="tags[]" multiple="multiple">
          @foreach ($tags as $tag)
            <option value="{{$tag->idtags}}">{{$tag->name}}</option>
          @endforeach
        </select>
      </div>

        <div class="imageupload panel panel-default">
          <div class="panel-heading clearfix">
              <h4 class="panel-title pull-left">Upload Image</h4>
              {{-- <div class="btn-group pull-right">
                  <button type="button" class="btn btn-default active">File</button>
              </div> --}}
          </div>
          <div class="file-tab panel-body">
              <label class="btn btn-default btn-file">
                  <span>Browse</span>
                  <!-- The file is stored here. -->
                  <input type="file" name="photos">
              </label>
              <button type="button" class="btn btn-default">Remove</button>
          </div>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    {{ Form::close() }}
  </div>
</div>
<script src="{{asset('sb-admin/vendor/jquery/jquery.min.js')}} "></script>

<script>
$(document).ready(function() {
           var $imageupload = $('.imageupload');
           $imageupload.imageupload({
             // allowedFormats: [ 'jpg' ,'jpeg','png',],
             maxFileSizeKb: 2048
           });

           $('#imageupload-disable').on('click', function() {
               $imageupload.imageupload('disable');
               $(this).blur();
           })

           $('#imageupload-enable').on('click', function() {
               $imageupload.imageupload('enable');
               $(this).blur();
           })

           $('#imageupload-reset').on('click', function() {
               $imageupload.imageupload('reset');
               $(this).blur();
           });
         });
</script>
