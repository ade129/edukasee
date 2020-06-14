<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{url('admin/home')}}">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">Master</li>
  <li class="breadcrumb-item active"><a href="{{url('admin/master/user')}}">User</a></li>
  <li class="breadcrumb-item active">Update</li>
</ol>

<div class="card card-default">
  <div class="card-header">
    <i class="fas fa-user"></i> Update
  </div>
  <div class="card-body">
    {{ Form::open(array('url' => '/master/user/update/'.$users->idusers, 'class' => 'form-horizontal')) }}

      <div class="form-group">
        <label for="exampleFormControlInput1">Name</label>
          <input type="text" class="form-control" name="name" value="{{$users->name}}" required>
      </div>

      <div class="form-group">
        <label for="exampleFormControlInput1">Email</label>
          <input type="email" class="form-control" name="email" value="{{$users->email}}" required>
      </div>

      <div class="form-group">
        <label for="exampleFormControlInput1">Role</label>
        <select class="form-control" name="role">
          <option value="a" @if($users->role == "a") selected @endif>Admin</option>
          <option value="s" @if($users->role == "s") selected @endif>Super Admin</option>
        </select>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    {{ Form::close() }}
  </div>
</div>
