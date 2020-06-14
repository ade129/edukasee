<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{url('admin/home')}}">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">Master</li>
  <li class="breadcrumb-item active"><a href="{{url('admin/master/universities')}}">Universitas</a></li>
  <li class="breadcrumb-item active">Update</li>
</ol>

<div class="card card-default">
  <div class="card-header">
    <i class="fas fa-university"></i> Update
  </div>
  <div class="card-body">
    {{ Form::open(array('url' => 'admin/master/universities/update/'.$universities->iduniversities, 'class' => 'form-horizontal')) }}

      <div class="form-group">
        <label for="">Name</label>
          <input type="text" class="form-control" placeholder="Name Universitas" name="name" value="{{$universities->name}}" required>
      </div>
      <div class="form-group">
        <label for="">Email</label>
          <input type="email" class="form-control"  name="email" value="{{$universities->email}}" required>
      </div>
      <div class="form-group">
        <label for=""> Phone 1</label>
          <input type="number" class="form-control" name="no_telp1" value="{{$universities->no_telp1}}" required>
      </div>
      <div class="form-group">
        <label for="">Phone 2</label>
          <input type="number" class="form-control" name="no_telp2" value="{{$universities->no_telp2}}">
      </div>

      <div class="form-group">
        <label for="">Address</label>
        <textarea class="form-control" rows="5" name="address" required>{{$universities->address}}</textarea>
      </div>

      <div class="form-group">
        <label for="">Type</label>
        <select class="form-control " name="type" required>
           <option> -- select type -- </option>
           <option value="n" @if ($universities->type == 'n') selected @endif>Negeri</option>
           <option value="s" @if ($universities->type == 's') selected @endif>Swasta</option>
         </select>
         <small>negeri / swasta</small>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="check" name="active" @if ($universities->type == TRUE)
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
