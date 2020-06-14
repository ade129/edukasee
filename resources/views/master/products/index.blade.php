<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{url('admin/home')}}">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">Master</li>
  <li class="breadcrumb-item active">product</li>
</ol>

<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-tag"></i> Product
    <div class="float-right">
    <a href="{{url('master/product/create-new')}}"><i class="fas fa-plus"></i> create-new</a>
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
                <th>Status</th>
                <th>Creted</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($products as $index => $pro)
                <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$pro->name}}</td>
                  <td>
                    @if ($pro->active == TRUE)
                      <span class="badge badge-success">Active</span>
                    @else
                      <span class="badge badge-danger">In Active</span>
                    @endif
                  </td>
                  <td>{{date('d F Y' , strtotime($pro->created_at)) }}</td>
                  <th><a href="{{url('master/product/update/'.$pro->idproducts)}}"><i class="far fa-edit"></i></a></th>
                </tr>
              @endforeach
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>
