<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{url('admin/home')}}">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">Artikel</li>
</ol>

<div class="card mb-3">
  <div class="card-header">
    <i class="fab fa-blogger"></i> Artikel
    <div class="float-right">
    <a href="{{url('admin/artikel/create-new')}}"><i class="fas fa-plus"></i> create-new</a>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
          <table class="table table-bordered dataTable" id="dataTable">
            <thead>
              <tr>
                <th>No</th>
                <th>Title</th>
                <th>Body</th>
                <th>Created</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($quotes as $index => $quote)
                <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$quote->title}}</td>
                  <td>{!!substr($quote->body, 0,20) !!}</td>
                  <td>
                    {{$quote->users->name}} <br>
                    <small>{{date('d F Y' , strtotime($quote->created_at)) }}</small>
                  </td>
                  <th>
                    <a href="{{url('admin/artikel/update/'.$quote->idquotes)}}"><i class="far fa-edit"></i></a>
                    <a href="" onclick="load_delete('{{$quote->idquotes}}');" data-toggle="modal" data-target="#modal-quote-delete"><i class="fas fa-trash-alt"></i></a>
                  </th>
                </tr>
              @endforeach
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>

<!-- The Modal -->
<div class="modal" id="modal-quote-delete">
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
        {{ Form::open(array('url' => 'admin/artikel/', 'method' => 'delete' )) }}
            <input type="hidden" name="idquotes" id="idquotes_">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button class="btn btn-danger" type="submit">Yes</button>
          {{  Form::close() }}
      </div>

    </div>
  </div>
</div>

<script type="text/javascript">
  function load_delete(id){
    $('#idquotes_').val(id);
  }
</script>
