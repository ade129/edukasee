<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{url('admin/home')}}">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">Master</li>
  <li class="breadcrumb-item active"><a href="{{url('master/product')}}">Product</a></li>
  <li class="breadcrumb-item active">Create-new</li>
</ol>

<div class="card card-default">
  <div class="card-header">
    <i class="fas fa-tag"></i> Create
  </div>
  <div class="card-body">
    {{ Form::open(array('url' => 'master/product/create-new', 'class' => 'form-horizontal')) }}

      <div class="form-group">
        <label for="">Name</label>
          <input type="text" class="form-control" placeholder="Product" name="name" required>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="check" name="active" checked>
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
