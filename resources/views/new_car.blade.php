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
                                    <option value="">--- Choose a car make ---</option>
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

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">*Car type</label>

                            <div class="col-md-6">
                                <select class="form-control" name="type" value="{{ old('type') }}">
                                    <option value="">--- Choose a car type ---</option>
                                    <option value="Small">Small</option>
                                    <option value="Hatchback">Hatchback</option>
                                    <option value="Long">Saloon/Sedan</option>
                                    <option value="Estate">Estate</option>  
                                    <option value="Race">Race/Sports</option>
                                    <option value="Convertible">Convertible</option>
                                    <option value="Big">4x4/SUV</option>
                                    <option value="MVP">MPV</option>  
                                    <option value="Other">Other</option>
                                </select>
                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif                                
                            </div>
                        </div> 

                        <div class="form-group{{ $errors->has('fuel') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">*Fuel type</label>

                            <div class="col-md-6">
                                <select class="form-control" name="fuel" value="{{ old('fuel') }}">
                                    <option value="">--- Choose a fuel type ---</option>
                                    <option value="Petrol">Petrol</option>
                                    <option value="Diesel">Diesel</option>
                                    <option value="LPG">LPG Autogas</option>
                                    <option value="Biofuel">Biofuel</option>
                                    <option value="Hybrid">Hybrid</option>
                                    <option value="Electric">Electric</option>
                                    <option value="x">Other</option>
                                </select>
                                @if ($errors->has('fuel'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fuel') }}</strong>
                                    </span>
                                @endif                                
                            </div>
                        </div>  

                        <div class="form-group{{ $errors->has('transmission') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">*Transmission type</label>

                            <div class="col-md-6">
                                <select class="form-control" name="transmission" value="{{ old('transmission') }}">
                                    <option value="">--- Choose transmission type ---</option>
                                    <option value="1">Manual</option>
                                    <option value="2">Automatic</option>
                                    <option value="x">Other</option>
                                </select>
                                @if ($errors->has('transmission'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('transmission') }}</strong>
                                    </span>
                                @endif                                
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('doors') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">*Number of doors</label>

                            <div class="col-md-6">
                                <select class="form-control" name="doors" value="{{ old('doors') }}">
                                    <option value="">--- Choose number of doors ---</option>
                                    @for($i=1; $i <= 10; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                    <option value="x">Other</option>
                                </select>
                                @if ($errors->has('doors'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('doors') }}</strong>
                                    </span>
                                @endif                                
                            </div>
                        </div>

                        <p>* Required</p>

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
