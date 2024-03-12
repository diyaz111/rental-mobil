@section('js')

<script type="text/javascript">
    $(document).ready(function() {
        $(".users").select2();
    });
</script>

<script type="text/javascript">
    function readURL() {
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(input).prev().attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(function() {
        $(".uploads").change(readURL)
        $("#f").submit(function() {
            // do ajax submit or just classic form submit
            //  alert("fake subminting")
            return false
        })
    })
</script>
@stop

@extends('layouts.app')

@section('content')

<form action="{{ route('mobil.update', $data->id) }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('put') }}
    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Data Mobil <b>{{$data->name}}</b> </h4>
                            <form class="forms-sample">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">name</label>
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ $data->name }}" required>
                                        @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('license_number') ? ' has-error' : '' }}">
                                    <label for="license_number" class="col-md-4 control-label">license_number</label>
                                    <div class="col-md-6">
                                        <input id="license_number" type="text" class="form-control" name="license_number" value="{{ $data->license_number }}" required>
                                        @if ($errors->has('license_number'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('license_number') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('merk') ? ' has-error' : '' }}">
                                    <label for="merk" class="col-md-4 control-label">merk</label>
                                    <div class="col-md-6">
                                        <input id="merk" type="text" class="form-control" name="merk" value="{{ $data->merk }}" required>
                                        @if ($errors->has('merk'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('merk') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('color') ? ' has-error' : '' }}">
                                    <label for="color" class="col-md-4 control-label">color</label>
                                    <div class="col-md-6">
                                        <input id="color" type="text" class="form-control" name="color" value="{{ $data->color }}" required>
                                        @if ($errors->has('color'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('color') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                                    <label for="year" class="col-md-4 control-label">year</label>
                                    <div class="col-md-6">
                                        <input id="year" type="text" class="form-control" name="year" value="{{ $data->year }}" required>
                                        @if ($errors->has('year'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('year') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                    <label for="price" class="col-md-4 control-label">Harga</label>
                                    <div class="col-md-6">
                                        <input id="price" type="number" maxlength="4" class="form-control" name="price" value="{{ $data->price }}" required>
                                        @if ($errors->has('price'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                    <label for="status" class="col-md-4 control-label">status</label>
                                    <div class="col-md-12">
                                        <input id="status" type="text" class="form-control" name="status" value="{{ $data->status }}">
                                        @if ($errors->has('status'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary" id="submit">
                                    Update
                                </button>
                                <a href="{{route('buku.index')}}" class="btn btn-light pull-right">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>
@endsection
