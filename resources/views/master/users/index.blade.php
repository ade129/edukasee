<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{url('admin/home')}}">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">Master</li>
  <li class="breadcrumb-item active">User</li>
</ol>

<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-user"></i> User
    <div class="float-right">
    <a href="{{url('master/user/create-new')}}"><i class="fas fa-plus"></i> create-new</a>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
          <table class="table table-bordered dataTable" id="dataTable">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Created</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $index => $user)
                <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{date('d F Y' , strtotime($user->created_at)) }}</td>
                  <th><a href="{{url('master/user/update/'.$user->idusers)}}"><i class="far fa-edit"></i></a></th>
                </tr>
              @endforeach
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>
