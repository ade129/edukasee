<!-- Breadcrumbs-->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{url('/home')}}">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">purchase</li>
</ol>

<div class="card mb-3">
  <br>
  {{ Form::open(array('url' => 'report', 'class' => 'form-horizontal','method' => 'get')) }}
  <div class="container">
    <div class="row">
      <div class="col-sm">
        <div class="form-group">
          @php
            $startDate = Request::query('startdate');
          @endphp
          <small>Start</small>
            <input id="datepicker" name="startdate"  value="{{$startDate}}" width="100%"  />
        </div>
      </div>
      <div class="col-sm">
        <div class="form-group">
          @php
            $endDate = Request::query('enddate');
          @endphp
          <small>End</small>
            <input id="datepicker2" name="enddate"  value="{{$endDate}}" width="100%"  />
        </div>
      </div>
      <div class="col-sm">
        <div class="form-group">
          <small>Product</small>
          <select class="form-control" name="product">
            <option value="">-- pilih product--</option>
            @foreach ($products as $pro)
              <option value="{{$pro->idproducts}}" @if (Request::get('product') == $pro->idproducts)
                selected
              @endif >{{$pro->name}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-sm">
        <div class="form-group">
          <small>Cabang</small>
          <select class="form-control" name="cabang">
            <option value="">-- pilih cabang --</option>
            @foreach ($purchase as $pur)
              <option value="{{$pur->idpurchases}}" @if (Request::get('cabang') == $pur->idpurchases)
                selected
              @endif>{{$pur->name}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-sm">
        <small></small><br>
        <div class="form-group">
          <button type="submit" class="btn btn-outline-primary">
            <i class="fa fa-fw fa-search"></i> Search
          </button>
          @php
            $query='?startdate='.Request::query('startdate').'&enddate='.Request::query('enddate').'&product='.Request::query('product').'&cabang='.Request::query('cabang');
          @endphp
          {{-- @php
            $query = '?product='.Request::query('product').'&cabang='.Request::query('cabang');
          @endphp --}}
          <a href="{{url('report/excel/'.$query)}}" class="btn btn-outline-danger">
          <i class="far fa-file-excel"></i>
        </a>
        </div>
      </div>
    </div>
  </div>
  {{ Form::close() }}
  <div class="container">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Cabang</th>
            <th>Product</th>
            <th>Date</th>
            <th>Qty</th>
            <th>Pendapatan</th>
            <th>Biaya</th>
            <th>Laba</th>
          </tr>
        </thead>
        <tbody>
          @php
            $total = 0;
          @endphp
          @foreach ($datapurchase as $pur)
            <tr>
              <td>{{$pur->pur_name}}</td>
              <td>{{$pur->pro_name}}</td>
              <td>{{date('Y-m-d',strtotime($pur->date_pur))}}</td>
              <td>{{$pur->qty}}</td>
              <td>{{$pur->pendapatan}}</td>
              <td>{{$pur->biaya}}</td>
              <td>{{$pur->laba}}</td>
              @php
                $total += $pur->laba;
              @endphp
            </tr>
          @endforeach
          <tr>
            <td colspan="6">TOTAL</td>
            <td>{{$total}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
 $('#datepicker').datepicker({
   uiLibrary: 'bootstrap4',
   format: 'yyyy-mm-dd'

 });
 $('#datepicker2').datepicker({
   uiLibrary: 'bootstrap4',
   format: 'yyyy-mm-dd'

 });
});
</script>
