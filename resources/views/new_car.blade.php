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
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif                                
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="desc" value="{{ old('desc') }}" cols="40" rows="3"  maxlength="255"></textarea>
                                @if ($errors->has('desc'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('desc') }}</strong>
                                    </span>
                                @endif                                
                            </div>
                        </div>    

                        <div class="form-group{{ $errors->has('make') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">*Car make</label>

                            <div class="col-md-6">
                                <select class="form-control" name="make" value="{{ old('make') }}">
                                    <option value="Aston Martin">Aston Martin</option>
                                    <option value="Bentley">Bentley</option>
                                    <option value="Jaguar">Jaguar</option>
                                    <option value="Land Rover">Land Rover</option>
                                    <option value="McLaren">McLaren</option>   
                                    <option value="Mini">Mini</option>
                                    <option value="Rolls Royce">Rolls Royce</option>
                                    <option value="Chevrolet">Chevrolet</option>
                                    <option value="Cadillac">Cadillac</option>
                                    <option value="Chrystler">Chrystler</option>
                                    <option value="Dodge">Dodge</option>
                                    <option value="Ford">Ford</option>
                                    <option value="GMC">GMC</option>
                                    <option value="Jeep">Jeep</option>
                                    <option value="Tesla">Tesla</option>
                                </select>
                                @if ($errors->has('make'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('make') }}</strong>
                                    </span>
                                @endif                                
                            </div>
                        </div>   

                        <div class="form-group{{ $errors->has('model') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">*Car model</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="model" value="{{ old('model') }}" maxlength="30">
                                @if ($errors->has('model'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('model') }}</strong>
                                    </span>
                                @endif                                
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
