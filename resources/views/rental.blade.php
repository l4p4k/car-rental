@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if($data!=NULL)
            <div class="panel panel-default">
                <div class="panel-heading">{{$data->title}}</div>

                <div class="panel-body">
                    {{$data->description}}<br>
                    {{$data->make}}<br>
                    {{$data->model}}<br>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
