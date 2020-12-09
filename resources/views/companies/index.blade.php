@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3> List Perusahaan </h3> 
                </div>
                <div class="card-body"> 
                    <form action="{{route('company.create')}}"> <button class="pull-right btn btn-success " ><i class="fa fa-plus"></i> Tambah Perusahaan </button> </form> <br>
                    <table class="table">
                        <thead> 
                        <tr>
                            <th>No</th>
                            <th>Nama Perusahaan</th>
                            <th>Email</th>
                            <th>Logo</th>
                            <th colspan="2">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php (
                                $no = 1
                            )
                            @foreach ($company as $pt)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$pt->name}}</td>
                                <td>{{$pt->email}}</td>
                                <td><img src="/storage/{{$pt->logo}}"> </td>
                                <td>
                                    <form action="{{route('company.edit', $pt->id)}}">  
                                        <button class="btn btn-success" type="submit" value="Edit"> Edit </button> </form> </td>
                                <td>
                                        <form action="{{route('company.destroy', $pt->id)}}" method="POST">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button class="btn btn-success" type="submit" value="Delete"> Delete </button> </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{$company->links()}}
    </div>
</div>
@endsection