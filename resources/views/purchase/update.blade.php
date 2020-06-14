<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{url('/home')}}">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">Purhase</li>
  <li class="breadcrumb-item active">Create-new</li>
</ol>

<div class="card card-default">
  <div class="card-header">
    <i class="fas fa-fw fa-table"></i> Update
    <div class="float-right">
      <a href="#" data-toggle="modal" data-target="#modal-tags-delete">
        <i class="fas fa-trash-alt"></i>
      </a>
    </div>
  </div>
  <div class="card-body">
    {{ Form::open(array('url' => 'purchase/update/'.$purchase->idpurchases, 'class' => 'form-horizontal')) }}

    <div class="form-group">
      <label for="">Date</label>
      <input id="datepicker" name="date" value="{{date('Y-m-d', strtotime($purchase->date))}}" width="100%" required />
    </div>

    <div class="form-group">
      <label for="">Cabang</label>
        <input type="text" class="form-control" value="{{$purchase->name}}" name="name" required>
    </div>

    <div class="form-group">
      <label for="">Total</label>
        <input type="number" class="form-control" value="{{$purchase->total}}" name="total" id="total" required readonly>
    </div>

      <div class="form-group">
            <p><a class="btn btn-sm btn-outline-secondary" id="addRow"> <i class="fa fa-plus"></i> Add </a></p>
        <div class="table-responsive">
          <table class="table" id="table" style="width:1500px !important;">
            <tbody>
              @foreach ($purchase->purchase_details as $index => $prdet)
              <tr>
                <td>
                  <label style="display: block;"></label>
                  <a class="btn btn-xs del" onclick="del_saveid('{{$prdet->idpurchasedetails}}')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                  <input type="hidden" name="idprdetails[]" value="{{$prdet->idpurchasedetails}}">
                </td>
                <td>
                  <small class="form-text text-muted">Product</small>
                  <select class="form-control" id="idproduct_{{$index+1}}" name="idproduct[]" required >
                    <option value=""> -- pilih product -- </option>
                    @foreach ($products as $pro)
                      <option value="{{$pro->idproducts}}" @if($pro->idproducts == $prdet->idproducts) selected @endif>{{$pro->name}}</option>
                    @endforeach
                  </select>
                </td>
                <td>
                  <small class="form-text text-muted">Keterangan</small>
                  <textarea class="form-control" id="description_{{$index+1}}" rows="1" name="description[]" required>{{$prdet->description}}</textarea>
                </td>
                <td>
                  <small class="form-text text-muted">Pembayaran</small>
                  <select class="form-control" id="pembayaran_{{$index+1}}" name="pembayaran[]" required>
                    <option value=""> -- pilih pembayaran -- </option>
                    <option value="c" @if ($prdet->payments == 'c') selected @endif>Cash</option>
                    <option value="t" @if ($prdet->payments == 't') selected @endif>Transfer</option>
                    <option value="i" @if ($prdet->payments == 'i') selected @endif>Invoice</option>
                </select>
                </td>
                <td>
                  <small class="form-text text-muted">Qty</small>
                  <input type="number" class="form-control" name="qty[]" id="qty_{{$index+1}}" value="{{$prdet->qty}}" required>
                </td>
                <td>
                  <small class="form-text text-muted">Pendapatan</small>
                  <input type="number" class="form-control" onkeyup="count_all({{$index+1}})" name="pendapatan[]" id="pendapatan_{{$index+1}}" value="{{$prdet->pendapatan}}" required>
                </td>
                <td>
                  <small class="form-text text-muted">Biaya</small>
                  <input type="number" class="form-control"  onkeyup="count_all({{$index+1}})" name="biaya[]" id="biaya_{{$index+1}}"  required value="{{$prdet->biaya}}">
                </td>
                <td>
                  <small class="form-text text-muted">Laba</small>
                  <input type="text" class="form-control"   name="laba[]" id="laba_{{$index+1}}" onkeyup="total({{$index+1}})" readonly required value="{{$prdet->laba}}">
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary float-right">Save</button>
      </div>
      <input type="hidden" id="deleteindex" name="deleteindex">

    {{ Form::close() }}
    <input type="hidden" id="appendindex" value="{{$purchase->purchase_details->count()+1}}">
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
     $('#datepicker').datepicker({
       uiLibrary: 'bootstrap4',
       format: 'yyyy-mm-dd'
     });
    });

    var product = '';
    @foreach($products as $pro)
      product += "<option value='{{$pro->idproducts}}'>{{$pro->name}}</option>";
    @endforeach

    //delete row
     $('#table').on('click', '.del' ,function(){
       $(this).closest('tr').remove();
        total()
     });

     //delete
    function del_saveid(idprdet) {
    	var curdelid = $('#deleteindex').val();
    	$('#deleteindex').val(curdelid+','+idprdet);
    	 total()
    }

    $('#addRow').on('click', function() {
      var ais = $('#appendindex').val();
      $('#appendindex').val(parseInt(ais)+1);

      $('#table').append('<tr>'
          +'<td>'
            // +'<label style="display: block;"></label>'
            +'<a class="btn btn-xs del"><i class="fa fa-trash" aria-hidden="true"></i></a>'
            +'<input type="hidden" name="idprdetails[]" value="new">'
          +'</td>'
          +'<td>'
            +'<small class="form-text text-muted">Product</small>'
            +'<select class="form-control" name="idproduct[]" id="idproduct_'+ais+'" required>'
            +'<option value="">- select product -</option>'+product+'</select>'
          +'</td>'
          +'<td>'
            +'<small class="form-text text-muted">Keterangan</small>'
            +'<textarea class="form-control" id="description_'+ais+'" rows="1" name="description[]" required></textarea>'
          +'</td>'
          +'<td>'
            +'<small class="form-text text-muted">Pembayaran</small>'
            +'<select class="form-control" id="pembayaran_'+ais+'" name="pembayaran[]" required>'
              +'<option value=""> -- pilih pembayaran -- </option>'
              +'<option value="c">Cash</option>'
              +'<option value="t">Transfer</option>'
              +'<option value="i">Invoice</option>'
            +'</select>'
          +'</td>'
          +'<td>'
            +'<small class="form-text text-muted">Qty</small>'
            +'<input type="number" class="form-control" name="qty[]" id="qty_'+ais+'" required value="0">'
          +'</td>'
          +'<td>'
            +'<small class="form-text text-muted">Pendapatan</small>'
            +'<input type="number" class="form-control"  onkeyup="count_all('+ais+')" name="pendapatan[]" id="pendapatan_'+ais+'" value="0" required>'
          +'</td>'
          +'<td>'
            +'<small class="form-text text-muted">Biaya</small>'
            +'<input type="number" class="form-control"  onkeyup="count_all('+ais+')" name="biaya[]" id="biaya_'+ais+'" required value="0">'
          +'</td>'
          +'<td>'
            +'<small class="form-text text-muted">Laba</small>'
            +'<input type="number" class="form-control"  onkeyup="total('+ais+')" name="laba[]" id="laba_'+ais+'" required readonly value="0">'
          +'</td>'
        +'</tr>'
      )

    })

    function count_all(id) {
      var  pendapatan = $('#pendapatan_'+id).val() || 0;
      var  biaya = $('#biaya_'+id).val() || 0;

      var laba = parseInt(pendapatan) - parseInt(biaya);
      if (laba => 0) {
        $('#laba_'+id).val(laba);
      }else{
        $('#laba_'+id).val();
      }
      total()
    }

    function total() {
      var total = 0;
      var counter = $('#appendindex').val();
      setTimeout(function(){
        for (var i = 1; i < counter; i++) {
          var laba = $('#laba_'+i).val();
          if (typeof laba !== 'undefined') {
              total  += parseInt(laba);
          }
          $('#total').val(total);
        }
      })
    }
</script>

<!-- The Modal -->
<div class="modal" id="modal-tags-delete">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Warning</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <center>Sure to delete this purchase ?</center>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        {{ Form::open(array('url' => 'purchase/delete/'.$purchase->idpurchases, 'method' => 'delete' )) }}
            {{-- <input type="hidden" name="idtags" id="idtags_"> --}}
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button class="btn btn-danger" type="submit">Yes</button>
          {{  Form::close() }}
      </div>

    </div>
  </div>
</div>
