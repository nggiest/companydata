@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3> List Pegawai </h3> 
                </div>
                <div class="card-body"> 
                    <form action="{{route('employee.create')}}"> <button class="pull-right btn btn-success " ><i class="fa fa-plus"></i> Tambah Pegawai </button> </form> <br>
                    <table class="table">
                        <thead> 
                        <tr>
                            <th>No</th>
                            <th>Nama Pegawai</th>
                            <th>Email</th>
                            <th>Nama Perusahaan</th>
                            <th colspan="2">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php (
                                $no = 1
                            )
                            @foreach ($employee as $pgw)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$pgw->name_employee}}</td>
                                <td>{{$pgw->email}}</td>
                                <td> <?=$pgw->perusahaans ?> </td>
                                <td>
                                        <form action="{{route('employee.edit', $pgw->id)}}">  
                                        <button class="btn btn-success" type="submit" value="Edit"> Edit </button> </form> </td>
                                <td>
                                        <form action="{{route('employee.destroy', $pgw->id)}}" method="POST">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button class="btn btn-success" type="submit" value="Delete"> Delete </button> </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{$employee->links()}}
            </div>
        </div>
    </div>
</div>
@endsection