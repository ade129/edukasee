<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{url('/home')}}">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">purchase</li>
</ol>

<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-fw fa-table"></i> Purchase
    <div class="float-right">
      <a href="{{url('purchase/show/')}}"><i class="far fa-eye"></i>show</a>
    <a href="{{url('purchase/create-new')}}" id="pr"><i class="fas fa-plus"></i> create-new</a>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
          <table class="table table-bordered dataTable" id="dataTable">
            <thead>
              <tr>
                <th>No</th>
                <th>Cabang</th>
                <th>Date</th>
                <th>Created</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($purchase as $index => $pur)
                <tr id="count">
                  <td>{{$index+1}}</td>
                  <td>{{$pur->name}}</td>
                  <td>{{date('Y-m-d', strtotime($pur->date)) }}</td>
                  <td>{{$pur->users->name}}</td>
                  <td>
                    <a href="{{url('purchase/update/'.$pur->idpurchases)}}"><i class="far fa-edit"></i></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  if ($('#count').length == 1) {
    $('#pr').click(function(){
      alert('Tidak Bisa Membuat Cabang Baru, Harus di Delete ');
      return false;
    });
  }
  

</script>
