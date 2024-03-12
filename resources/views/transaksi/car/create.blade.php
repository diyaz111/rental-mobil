@section('js')
<script type="text/javascript">
    $(document).on('click', '.pilih', function(e) {
        document.getElementById("mobil_name").value = $(this).attr('data-mobil_name');
        document.getElementById("mobil_id").value = $(this).attr('data-mobil_id');
        $('#myModal').modal('hide');
    });

    $(document).on('click', '.pilih_anggota', function(e) {
        document.getElementById("user_id").value = $(this).attr('data-user_id');
        document.getElementById("user_nama").value = $(this).attr('data-user_nama');
        $('#myModal2').modal('hide');
    });

    $(function() {
        $("#lookup, #lookup2").dataTable();
    });
</script>

@stop
@section('css')

@stop
@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('sewa.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Tambah Transaksi baru</h4>

                            <div class="form-group{{ $errors->has('kode_transaksi') ? ' has-error' : '' }}">
                                <label for="kode_transaksi" class="col-md-4 control-label">Kode Transaksi</label>
                                <div class="col-md-6">
                                    <input id="kode_transaksi" type="text" class="form-control" name="kode_transaksi" value="{{ $kode }}" required readonly="">
                                    @if ($errors->has('kode_transaksi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kode_transaksi') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('tgl_pinjam') ? ' has-error' : '' }}">
                                <label for="tgl_pinjam" class="col-md-4 control-label">Tanggal Pinjam</label>
                                <div class="col-md-3">
                                    <input id="tgl_pinjam" type="date" class="form-control" name="tgl_pinjam" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) }}" required @if(Auth::user()->level == 'user') readonly @endif>
                                    @if ($errors->has('tgl_pinjam'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tgl_pinjam') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('tgl_kembali') ? ' has-error' : '' }}">
                                <label for="tgl_kembali" class="col-md-4 control-label">Tanggal Kembali</label>
                                <div class="col-md-3">
                                    <input id="tgl_kembali" type="date" class="form-control" name="tgl_kembali" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->addDays(5)->toDateString())) }}" required="" @if(Auth::user()->level == 'user') readonly @endif>
                                    @if ($errors->has('tgl_kembali'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tgl_kembali') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('mobil_id') ? ' has-error' : '' }}">
                                <label for="mobil_id" class="col-md-4 control-label">Mobil</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input id="mobil_name" type="text" class="form-control" readonly="" required>
                                        <input id="mobil_id" type="hidden" name="mobil_id" value="{{ old('mobil_id') }}" required readonly="">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-info btn-secondary" data-toggle="modal" data-target="#myModal"><b>Cari Mobil</b> <span class="fa fa-search"></span></button>
                                        </span>
                                    </div>
                                    @if ($errors->has('mobil_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobil_id') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>


                            @if(Auth::user()->role == 'anggota')
                            <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
                                <label for="user_id" class="col-md-4 control-label">Anggota</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input id="user_name" type="text" class="form-control" readonly="" required>
                                        <input id="user_id" type="hidden" name="user_id" value="{{ old('user_id') }}" required readonly="">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-warning btn-secondary" data-toggle="modal" data-target="#myModal2"><b>Cari Anggota</b> <span class="fa fa-search"></span></button>
                                        </span>
                                    </div>
                                    @if ($errors->has('user_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_id') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>
                            @else
                            <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
                                <label for="user_id" class="col-md-4 control-label">Anggota</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" readonly="" value="{{Auth::user()->name}}" required>
                                    <input id="id" type="hidden" name="user_id" value="{{ Auth::user()->id }}" required readonly="">

                                    @if ($errors->has('user_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_id') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>
                            @endif

                            <div class="form-group{{ $errors->has('ket') ? ' has-error' : '' }}">
                                <label for="ket" class="col-md-4 control-label">Keterangan</label>
                                <div class="col-md-6">
                                    <input id="ket" type="text" class="form-control" name="ket" value="{{ old('ket') }}">
                                    @if ($errors->has('ket'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ket') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary" id="submit">
                                Submit
                            </button>
                            <button type="reset" class="btn btn-danger">
                                Reset
                            </button>
                            <a href="{{route('sewa.index')}}" class="btn btn-light pull-right">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>


<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background: #fff;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cari Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="lookup" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>License Number (Plat)</th>
                            <th>Year</th>
                            <th>Warna</th>
                            <th>Merk</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mobil as $data)
                        <tr class="pilih" data-mobil_id="<?php echo $data->id; ?>" data-mobil_name="<?php echo $data->name; ?>">
                            <td>{{$data->name}}</td>
                            <td>{{$data->license_number}}</td>
                            <td>{{$data->year}}</td>
                            <td>{{$data->color}}</td>
                            <td>{{$data->merk}}</td>
                            <td>{{$data->price}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background: #fff;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cari Anggota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="lookup" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>
                                Nama
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $data)
                        <tr class="pilih_anggota" data-user_id="<?php echo $data->id; ?>" data-user_nama="<?php echo $data->nama; ?>">
                            <td class="py-1">


                                {{$data->nama}}
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
