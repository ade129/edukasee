<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{url('admin/home')}}">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">Master</li>
  <li class="breadcrumb-item active"><a href="{{url('admin/master/tags')}}">Tags</a></li>
  <li class="breadcrumb-item active">Create-new</li>
</ol>

<div class="card card-default">
  <div class="card-header">
    <i class="fas fa-tag"></i> Create
  </div>
  <div class="card-body">
    {{ Form::open(array('url' => 'admin/master/tags/create-new', 'class' => 'form-horizontal')) }}

      <div class="form-group">
        <label for="exampleFormControlInput1">Name</label>
          <input type="text" class="form-control" placeholder="Name Tag" name="name" required>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="active" checked>
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
