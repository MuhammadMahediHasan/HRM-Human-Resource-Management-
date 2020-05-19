@extends('backend')
@section('main_content')  

<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{Form::open(['url'=>"setup/$setup->id",'method'=>'PUT'])}}
                
                    <center>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Name</label>
                            <div class="col-sm-8">
                                {{Form::text('name',$setup->name,['class'=>'form-control'])}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                {{Form::text('email',$setup->email,['class'=>'form-control'])}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Phone</label>
                            <div class="col-sm-8">
                                {{Form::text('phone',$setup->phone,['class'=>'form-control'])}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Address</label>
                            <div class="col-sm-8">
                                {{Form::text('address',$setup->address,['class'=>'form-control'])}}
                            </div>
                        </div>
                        <button class="btn btn-success">Sumbit</button>
                    </center>
                <div class="col-sm-2"></div>

                {{Form::close()}}

                </div>
            </div>
        </div>
    </div>
</div>
@stop
