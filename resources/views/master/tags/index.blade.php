<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{url('admin/home')}}">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">Master</li>
  <li class="breadcrumb-item active">Tags</li>
</ol>

<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-tag"></i> Tags
    <div class="float-right">
    <a href="{{url('admin/master/tags/create-new')}}"><i class="fas fa-plus"></i> create-new</a>
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
                <th>Created</th>
                <th><center>Status</center></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($tags as $index => $tag)
                <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$tag->name}}</td>
                  <td>{{date('d F Y' , strtotime($tag->created_at)) }}</td>
                  <td>
                    <center>
                      @if ($tag->active == TRUE)
                        <span class="badge badge-pill badge-success">Active</span>
                      @else
                        <span class="badge badge-pill badge-success">In Active</span>
                      @endif
                    </center>
                  </td>
                  <th><a href="{{url('admin/master/tags/update/'.$tag->idtags)}}"><i class="far fa-edit"></i></a></th>
                </tr>
              @endforeach
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>
