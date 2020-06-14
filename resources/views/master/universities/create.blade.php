<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{url('admin/home')}}">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">Master</li>
  <li class="breadcrumb-item active"><a href="{{url('admin/master/universities')}}">Universitas</a></li>
  <li class="breadcrumb-item active">Create-new</li>
</ol>

<div class="card card-default">
  <div class="card-header">
    <i class="fas fa-university"></i> Create
  </div>
  <div class="card-body">
    {{ Form::open(array('url' => 'admin/master/universities/create-new', 'class' => 'form-horizontal')) }}

      <div class="form-group">
        <label for="">Name</label>
          <input type="text" class="form-control" placeholder="Name Universitas" name="name" required>
      </div>
      <div class="form-group">
        <label for="">Email</label>
          <input type="email" class="form-control" placeholder="email@example.com" name="email" required>
      </div>
      <div class="form-group">
        <label for=""> Phone 1</label>
          <input type="number" class="form-control" name="no_telp1" required>
      </div>
      <div class="form-group">
        <label for="">Phone 2</label>
          <input type="number" class="form-control" name="no_telp2">
      </div>

      <div class="form-group">
        <label for="">Address</label>
        <textarea class="form-control" rows="5" name="address" required></textarea>
      </div>

      <div class="form-group">
        <label for="">Type</label>
        <select class="form-control " name="type" required>
           <option> -- select type -- </option>
           <option value="n">Negeri</option>
           <option value="s">Swasta</option>
         </select>
         <small>negeri / swasta</small>
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
