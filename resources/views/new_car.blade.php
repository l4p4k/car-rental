@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Add a new car to rent</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{route('rental.form') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">*Title</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}" maxlength="50">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="desc" value="{{ old('desc') }}" cols="40" rows="3"  maxlength="255"></textarea>
                            </div>
                        </div>    

                        <div class="form-group{{ $errors->has('make') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">*Car make</label>

                            <div class="col-md-6">
                                <select class="form-control" name="make" value="{{ old('make') }}">
                                    <option value="aston">Aston Martin</option>
                                    <option value="bentley">Bentley</option>
                                    <option value="jaguar">Jaguar</option>
                                    <option value="landrover">Land Rover</option>
                                    <option value="mclaren">McLaren</option>   
                                    <option value="mini">Mini</option>
                                    <option value="royce">Rolls Royce</option>
                                    <option value="chevrolet">Chevrolet</option>
                                    <option value="cadillac">Cadillac</option>
                                    <option value="chrystler">Chrystler</option>
                                    <option value="dodge">Dodge</option>
                                    <option value="ford">Ford</option>
                                    <option value="gmc">GMC</option>
                                    <option value="jeep">Jeep</option>
                                    <option value="tesla">Tesla</option>
                                </select>
                            </div>
                        </div>   

                        <div class="form-group{{ $errors->has('model') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">*Car model</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="model" value="{{ old('model') }}" maxlength="30">
                            </div>
                        </div>                                         

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-play"></i> Submit
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
