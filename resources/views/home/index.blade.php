<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{url('admin/home')}}">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">home</li>
</ol>

<div class="row">

    @php
      $tot =0;
       $pur = 0;
    @endphp

    @foreach ($purchase as $pur)
      @php
        $tot += $pur->total;
      @endphp
    @endforeach

    {{-- @foreach ($per_purchase as $pu )
      @php
        $pur += $pu->total;
      @endphp
    @endforeach --}}

    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card text-white bg-primary o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fas fa-fw fa-comments"></i>
          </div>
          <div class="mr-5">{{$users->count()}} </div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="#">
          <span class="float-left">USER</span>
          <span class="float-right">
            <i class="fas fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card text-white bg-success o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fas fa-fw fa-list"></i>
          </div>
          <div class="mr-5">Rp.{{number_format($tot)}} </div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="#">
          <span class="float-left">TOTAL PURHCHASE</span>
          <span class="float-right">
            <i class="fas fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card text-white bg-warning o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fas fa-fw fa-life-ring"></i>
          </div>
          <div class="mr-5">Rp.@if (isset($per_purchase->total))
            {{number_format($per_purchase->total)}}
          @endif</div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="#">
          <span class="float-left">CABANG @isset($per_purchase->name)
            {{strtoupper($per_purchase->name)}}
          @endisset</span>
          <span class="float-right">
            <i class="fas fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>


  <div class="col-4">
    <div class="card card-default">
      <div class="card-header card default">
        Last Login
      </div>
      <div class="card-body">
        <div class="list-group">
          @foreach ($user_login as $uslogin)

            <li class="list-group-item">{{$uslogin->name}} <br> <small><i class="far fa-clock"></i> {{time_diff($uslogin->last_login)}}</small></li>
          @endforeach
        </div>
      </div>
    </div>

  </div>
</div>
