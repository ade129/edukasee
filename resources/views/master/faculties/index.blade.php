<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{url('admin/home')}}">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">Master</li>
  <li class="breadcrumb-item active">Universitas</li>
</ol>

<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-university"></i> Faculties
    <div class="float-right">
    <a href="{{url('admin/master/faculties/create-new')}}"><i class="fas fa-plus"></i> create-new</a>

    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
          <table class="table table-bordered dataTable" id="dataTable">
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>No Telp</th>
                <th>Type</th>
                <th><center>Status</center></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              {{-- @foreach ($universities as $index => $unive)
                <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$unive->name}}</td>
                  <td>{{$unive->address}}</td>
                  <td>{{$unive->email}}</td>
                  <td>{{$unive->no_telp1}}</td>
                  <td>
                    @if ($unive->type == 'n')
                      <span class="badge badge-success">Negeri</span>
                    @else
                      <span class="badge badge-danger">Swasta</span>
                    @endif
                  </td>
                  <td>
                    <center>
                      @if ($unive->active == TRUE)
                        <span class="badge badge-pill badge-success">Active</span>
                      @else
                        <span class="badge badge-pill badge-danger">In Active</span>
                      @endif
                    </center>
                  </td>
                  <td>
                    <a href="{{url('admin/master/universities/update/'.$unive->iduniversities)}}"><i class="far fa-edit"></i></a>
                    <a href="" data-toggle="modal" data-target="#modal-unive-delete" onclick="load_delete('{{$unive->iduniversities}}')"><i class="far fa-edit"></i></a>
                  </td>
                </tr>
              @endforeach --}}
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>

<!-- The Modal -->
<div class="modal" id="modal-unive-delete">
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
        {{ Form::open(array('url' => 'admin/master/universities/delete', 'method' => 'delete' )) }}
            <input type="hidden" name="iduniversities" id="iduniversities_">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button class="btn btn-danger" type="submit">Yes</button>
          {{  Form::close() }}
      </div>

    </div>
  </div>
</div>

<script type="text/javascript">
  function load_delete(id){
    $('#iduniversities_').val(id);
  }
</script>
