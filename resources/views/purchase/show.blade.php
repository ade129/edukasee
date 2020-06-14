
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{url('/home')}}">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">purchase</li>
  <li class="breadcrumb-item active">Show</li>
</ol>

<div class="card mb-3">
  {{ Form::open(array('url' => 'purchase/show', 'class' => 'form-horizontal','method' => 'get')) }}
  <div class="container">
    <div class="row">
      <div class="col-sm">
        <div class="form-group">
          @php
            $startDate = Request::query('startdate');
          @endphp
          <small>Start </small>
          <input id="datepicker" name="startdate"  value="{{$startDate}}" width="100%" required />
        </div>
      </div>
      <div class="col-sm">
        <div class="form-group">
          @php
            $endDate = Request::query('enddate');
          @endphp
          <small>End</small>
          <input id="datepicker2" name="enddate" value="{{$endDate}}" width="100%" required />
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
          <small></small><br>
          <button type="submit" class="btn btn-outline-primary">
            <i class="fa fa-fw fa-search"></i> Search
          </button>
           @php
             $query = '?startdate='.Request::query('startdate').'&enddate='.Request::query('enddate').'&product='.Request::query('product');
           @endphp
          <a href="{{url('purchase/excel/'.$query)}}" class="btn btn-outline-danger">
          <i class="far fa-file-excel"></i>
        </a>
        </div>
      </div>
    </div>
  {{ Form::close() }}
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
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
        @foreach ($prdets as $prdet )
          <tr>
            <td>{{$prdet->pro_name}}</td>
            <td>{{date('Y-m-d',strtotime($prdet->purchase_date))}}</td>
            <td>{{$prdet->qty}}</td>
            <td>{{$prdet->pendapatan}}</td>
            <td>{{$prdet->biaya}}</td>
            <td>{{$prdet->laba}}</td>
          </tr>
          @php

          $total += $prdet->laba;
          @endphp
        @endforeach
        <tr>
          <td colspan="5">Total</td>
          <td>{{$total}}</td>
        </tr>
      </tbody>
    </table>
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
