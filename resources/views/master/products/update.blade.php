<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{url('admin/home')}}">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">Master</li>
  <li class="breadcrumb-item active"><a href="{{url('master/product')}}">Product</a></li>
  <li class="breadcrumb-item active">Update</li>
</ol>

<div class="card card-default">
  <div class="card-header">
    <i class="fas fa-tag"></i> Create
    <div class="float-right">
      <a href="#" data-toggle="modal" data-target="#modal-tags-delete">
        <i class="fas fa-trash-alt"></i>
      </a>
    </div>
  </div>
  <div class="card-body">
    {{ Form::open(array('url' => 'master/product/update/'.$product->idproducts, 'class' => 'form-horizontal')) }}

      <div class="form-group">
        <label for="">Name</label>
          <input type="text" class="form-control" value="{{$product->name}}" name="name" required>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="check" name="active" @if ($product->active == TRUE)
          checked
        @endif>
        <label class="form-check-label" for="check">
          Active
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
        <center>Sure to delete this product ?</center>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        {{ Form::open(array('url' => 'master/product/delete/'.$product->idproducts, 'method' => 'delete' )) }}
            <input type="hidden" name="idtags" id="idtags_">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button class="btn btn-danger" type="submit">Yes</button>
          {{  Form::close() }}
      </div>

    </div>
  </div>
</div>
