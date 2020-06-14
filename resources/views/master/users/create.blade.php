<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{url('admin/home')}}">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">Master</li>
  <li class="breadcrumb-item active"><a href="{{url('admin/master/user')}}">User</a></li>
  <li class="breadcrumb-item active">create-new</li>
</ol>

<div class="card card-default">
  <div class="card-header">
    <i class="fas fa-user"></i> Create
  </div>
  <div class="card-body">
    {{ Form::open(array('url' => '/master/user/create-new/', 'class' => 'form-horizontal')) }}

      <div class="form-group">
        <label for="exampleFormControlInput1">Name</label>
          <input type="text" class="form-control" name="name"  required>
      </div>

      <div class="form-group">
        <label for="exampleFormControlInput1">Email</label>
          <input type="email" class="form-control" name="email" required>
      </div>

      <div class="form-group">
        <label for="exampleFormControlInput1">Role</label>
        <select class="form-control" name="role" required>
          <option value="a">Admin</option>
          <option value="s">Super Admin</option>
        </select>
      </div>

      <div class="form-group">
        <label for="exampleFormControlInput1">Password</label>
          <input type="password" class="form-control" name="password" required>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    {{ Form::close() }}
  </div>
</div>
