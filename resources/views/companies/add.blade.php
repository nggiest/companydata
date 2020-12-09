@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header">
                <h3> Tambah Perusahaan </h3> 
            </div>

            <div class="card-body"> 
                <form method="POST" action="{{route('company.store')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="Company Name">Nama Perusahaan</label>
                    <input type="text" class="form-control" id="name" name="name"aria-describedby="emailHelp" placeholder="Masukan Nama Perusahaan">
                    @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                </div>
                <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="form-group">
                    <label for="Email">Logo</label>
                <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="logo" name="logo">
                    <label class="custom-file-label" for="inputGroupFile01">Pilih Logo</label>
                </div>
                </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection