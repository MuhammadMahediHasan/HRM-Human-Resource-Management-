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

                {{Form::open(['url'=>"salary_component/$salary_component->id",'method'=>'PUT'])}}
                
                    <center>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Name</label>
                            <div class="col-sm-8">
                                {{Form::text('name',$salary_component->name,['class'=>'form-control'])}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Description</label>
                            <div class="col-sm-8">
                                {{Form::textarea('description',$salary_component->description,['class'=>'form-control','rows'=>4])}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Status</label>
                            <div class="col-sm-8">
                                {{Form::select('status',[$salary_component->status=>'Active',$salary_component->status=>'Inactive',1=>'Active',0=>'Inactive'],'null',['class'=>'form-control'])}}
                            </div>
                        </div>
                        
                            <button class="btn btn-success btn-sm">Sumbit</button>
                    </center>
                <div class="col-sm-2"></div>

                {{Form::close()}}

                </div>
            </div>
        </div>
    </div>
</div>
@stop
