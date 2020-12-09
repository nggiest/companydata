@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header">
                <h3> Tambah Pegawai </h3> 
            </div>

            <div class="card-body"> 
                <form method="POST" action="{{route('employee.store')}}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="Company Name">Nama Pegawai</label>
                    <input type="text" class="form-control" id="name_employee" name="name_employee"aria-describedby="emailHelp" placeholder="Nama Pegawai" require>
                    @if ($errors->has('name_employee'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name_employee') }}</strong>
                            </span>
                        @endif
                </div>
                <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" require>
                    @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="form-group">
                    <label for="company">Email</label>
                    <select name="id_company" id="id_company" class="form-control select2">
                                            <option name="id_company" id="id_company" value="">---Pilih Perusahaan---</option>
                                        
                                            @foreach($company as $pt)
                                                <option name="id_company" id="id_company" value="{{$data = $pt->id}}">{{$pt->name}} </option>
                                            @endforeach
                                        </select>
                    @if ($errors->has('id_company'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                </div>

                
                
                
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection