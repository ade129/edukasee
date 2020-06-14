<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{url('/home')}}">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">Purhase</li>
  <li class="breadcrumb-item active">Create-new</li>
</ol>

<div class="card card-default">
  <div class="card-header">
    <i class="fas fa-fw fa-table"></i> Create
  </div>
  <div class="card-body">
    {{ Form::open(array('url' => 'purchase/create-new', 'class' => 'form-horizontal')) }}

    <div class="form-group">
      <label for="">Date</label>
      <input id="datepicker" name="date" width="100%" required />
    </div>

    <div class="form-group">
      <label for="">Cabang</label>
        <input type="text" class="form-control" placeholder="Cabang" name="name" required>
    </div>

    <div class="form-group">
      <label for="">Total</label>
        <input type="number" class="form-control" value="0" name="total" id="total" required readonly>
    </div>

      <div class="form-group">
            <p><a class="btn btn-sm btn-outline-secondary" id="addRow"> <i class="fa fa-plus"></i> Add </a></p>
        <div class="table-responsive">
          <table class="table" id="table" style="width:1500px !important;">
            <tbody>
              <tr>
                <td>
                  <label style="display: block;"></label>
                  <a class="btn btn-xs"><i class="fa fa-minus" aria-hidden="true"></i></a>
                </td>
                <td>
                  <label for="">Product</label>
                  <select class="form-control" id="idproduct_1" name="idproduct[]" required >
                    <option value=""> -- pilih product -- </option>
                    @foreach ($products as $pro)
                      <option value="{{$pro->idproducts}}">{{$pro->name}}</option>
                    @endforeach
                  </select>
                </td>
                <td>
                  <label for="">Keterangan</label>
                  <textarea class="form-control" id="description_1" rows="1" name="description[]" required></textarea>
                </td>
                <td>
                  <label for="">Pembayaran</label>
                  <select class="form-control" id="pembayaran_1" name="pembayaran[]" required>
                    <option value=""> -- pilih pembayaran -- </option>
                    <option value="c">Cash</option>
                    <option value="t">Transfer</option>
                    <option value="i">Invoice</option>
                </select>
                </td>
                <td>
                  <label for="">Qty</label>
                  <input type="number" class="form-control" name="qty[]" id="qty_1" value="0" required>
                </td>
                <td>
                  <label for="">Pendapatan</label>
                  <input type="number" class="form-control" onkeyup="count_all(1)" name="pendapatan[]" id="pendapatan_1" value="0" required>
                </td>
                <td>
                  <label for="">Biaya</label>
                  <input type="number" class="form-control"  onkeyup="count_all(1)" name="biaya[]" id="biaya_1" required value="0">
                </td>
                <td>
                  <label for="">Laba</label>
                  <input type="number" class="form-control"  onkeyup="count_all(1)"  name="laba[]" id="laba_1" readonly required value="0">
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary float-right">Save</button>
      </div>
    {{ Form::close() }}
    <input type="hidden" id="appendindex" value="2">
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

    $('#addRow').on('click', function() {
      var ais = $('#appendindex').val();
      $('#appendindex').val(parseInt(ais)+1);

      $('#table').append('<tr>'
          +'<td>'
            // +'<label style="display: block;"></label>'
            +'<a class="btn btn-xs del"><i class="fa fa-trash" aria-hidden="true"></i></a>'
          +'</td>'
          +'<td>'
            +'<select class="form-control" name="idproduct[]" id="idproduct_'+ais+'" >'
            +'<option value="">- select product -</option>'+product+'</select>'
          +'</td>'
          +'<td>'
            +'<textarea class="form-control" id="description_'+ais+'" rows="1" name="description[]" required></textarea>'
          +'</td>'
          +'<td>'
            +'<select class="form-control" id="pembayaran_'+ais+'" name="pembayaran[]" required>'
              +'<option value=""> -- pilih pembayaran -- </option>'
              +'<option value="c">Cash</option>'
              +'<option value="t">Transfer</option>'
              +'<option value="i">Invoice</option>'
            +'</select>'
          +'</td>'
          +'<td>'
            +'<input type="number" class="form-control" name="qty[]" id="qty_'+ais+'" required value="0">'
          +'</td>'
          +'<td>'
            +'<input type="number" class="form-control"  onkeyup="count_all('+ais+')" name="pendapatan[]" id="pendapatan_'+ais+'" value="0" required>'
          +'</td>'
          +'<td>'
            +'<input type="number" class="form-control"  onkeyup="count_all('+ais+')" name="biaya[]" id="biaya_'+ais+'" required value="0">'
          +'</td>'
          +'<td>'
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
