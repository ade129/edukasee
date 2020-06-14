<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{url('admin/home')}}">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">Master</li>
  <li class="breadcrumb-item active"><a href="{{url('admin/master/tags')}}">Tags</a></li>
  <li class="breadcrumb-item active">Update</li>
</ol>

<div class="card card-default">
  <div class="card-header">
    <i class="fas fa-tag"></i> Update
    <div class="float-right">
      <a href="#" onclick="load_delete('{{$tags->idtags}}');" data-toggle="modal" data-target="#modal-tags-delete">
        <i class="fas fa-trash-alt"></i>
      </a>
    </div>
  </div>
  <div class="card-body">
    {{ Form::open(array('url' => 'admin/master/tags/update/'.$tags->idtags, 'class' => 'form-horizontal')) }}

      <div class="form-group">
        <label for="exampleFormControlInput1">Name</label>
          <input type="text" class="form-control" value="{{$tags->name}}" name="name" required>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="active" @if($tags->active == TRUE) checked @endif>
        <label class="form-check-label" for="defaultCheck1">
          Status
        </label>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary float-right">Save</button>
      </div>
    {{ Form::close() }}
  </div>
</div>

<!-- The Modal -->
<div class="modal" id="modal-tags-delete">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Warning</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <center>Sure to delete this quotes ?</center>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        {{ Form::open(array('url' => 'admin/master/tags/delete/'.$tags->idtags, 'method' => 'delete' )) }}
            <input type="hidden" name="idtags" id="idtags_">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button class="btn btn-danger" type="submit">Yes</button>
          {{  Form::close() }}
      </div>

    </div>
  </div>
</div>

<script type="text/javascript">
function load_delete(id){
  $('#idtags_').val(id);
  // console.log(id);
}

</script>
