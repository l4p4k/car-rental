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
                            <label class="col-md-4 control-label">*Description</label>

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
                                <select class="form-control" name="make">
                                    <option value="">--- Choose a car make ---</option>
                                    <option value="Aston Martin" @if(old('make')=="Aston Martin")selected="selected"@endif>Aston Martin</option>
                                    <option value="Bentley" @if(old('make')=="Bentley")selected="selected"@endif>Bentley</option>
                                    <option value="Jaguar" @if(old('make')=="Jaguar")selected="selected"@endif>Jaguar</option>
                                    <option value="Land Rover" @if(old('make')=="Land Rover")selected="selected"@endif>Land Rover</option>
                                    <option value="McLaren" @if(old('make')=="McLaren")selected="selected"@endif>McLaren</option>   
                                    <option value="Mini" @if(old('make')=="Mini")selected="selected"@endif>Mini</option>
                                    <option value="Rolls Royce" @if(old('make')=="Rolls Royce")selected="selected"@endif>Rolls Royce</option>
                                    <option value="Chevrolet" @if(old('make')=="Chevrolet")selected="selected"@endif>Chevrolet</option>
                                    <option value="Cadillac" @if(old('make')=="Cadillac")selected="selected"@endif>Cadillac</option>
                                    <option value="Chrystler" @if(old('make')=="Chrystler")selected="selected"@endif>Chrystler</option>
                                    <option value="Dodge" @if(old('make')=="Dodge")selected="selected"@endif>Dodge</option>
                                    <option value="Ford" @if(old('make')=="Ford")selected="selected"@endif>Ford</option>
                                    <option value="GMC" @if(old('make')=="GMC")selected="selected"@endif>GMC</option>
                                    <option value="Jeep" @if(old('make')=="Jeep")selected="selected"@endif>Jeep</option>
                                    <option value="Tesla" @if(old('make')=="Tesla")selected="selected"@endif>Tesla</option>
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
                            <label class="col-md-4 control-label">Car type</label>

                            <div class="col-md-6">
                                <select class="form-control" name="type">
                                    <option value="">--- Choose a car type ---</option>
                                    <option value="Small" @if(old('type')=="Small")selected="selected"@endif>Small</option>
                                    <option value="Hatchback" @if(old('type')=="Hatchback")selected="selected"@endif>Hatchback</option>
                                    <option value="Long" @if(old('type')=="Saloon/Sedan")selected="selected"@endif>Saloon/Sedan</option>
                                    <option value="Estate" @if(old('type')=="Estate")selected="selected"@endif>Estate</option>  
                                    <option value="Race" @if(old('type')=="Race/Sports")selected="selected"@endif>Race/Sports</option>
                                    <option value="Convertible" @if(old('type')=="Convertible")selected="selected"@endif>Convertible</option>
                                    <option value="Big" @if(old('type')=="4x4/SUV")selected="selected"@endif>4x4/SUV</option>
                                    <option value="MVP" @if(old('type')=="MVP")selected="selected"@endif>MPV</option>  
                                    <option value="Other" @if(old('type')=="Other")selected="selected"@endif>Other</option>
                                </select>
                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif                                
                            </div>
                        </div> 

                        <div class="form-group{{ $errors->has('fuel') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Fuel type</label>

                            <div class="col-md-6">
                                <select class="form-control" name="fuel">
                                    <option value="">--- Choose a fuel type ---</option>
                                    <option value="Petrol" @if(old('fuel')=="Petrol")selected="selected"@endif>Petrol</option>
                                    <option value="Diesel" @if(old('fuel')=="Diesel")selected="selected"@endif>Diesel</option>
                                    <option value="LPG" @if(old('fuel')=="LPG")selected="selected"@endif>LPG Autogas</option>
                                    <option value="Biofuel" @if(old('fuel')=="Biofuel")selected="selected"@endif>Biofuel</option>
                                    <option value="Hybrid" @if(old('fuel')=="Hybrid")selected="selected"@endif>Hybrid</option>
                                    <option value="Electric" @if(old('fuel')=="Electric")selected="selected"@endif>Electric</option>
                                    <option value="Other" @if(old('fuel')=="Other")selected="selected"@endif>Other</option>
                                </select>
                                @if ($errors->has('fuel'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fuel') }}</strong>
                                    </span>
                                @endif                                
                            </div>
                        </div>  

                        <div class="form-group{{ $errors->has('transmission') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Transmission type</label>

                            <div class="col-md-6">
                                <select class="form-control" name="transmission">
                                    <option value="">--- Choose transmission type ---</option>
                                    <option value="1" @if(old('transmission')=="1")selected="selected"@endif>Manual</option>
                                    <option value="2" @if(old('transmission')=="2")selected="selected"@endif>Automatic</option>
                                    <option value="0" @if(old('transmission')=="0")selected="selected"@endif>Other</option>
                                </select>
                                @if ($errors->has('transmission'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('transmission') }}</strong>
                                    </span>
                                @endif                                
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('doors') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Number of doors</label>

                            <div class="col-md-6">
                                <select class="form-control" name="doors" value="{{ old('doors') }}">
                                    <option value="">--- Choose number of doors ---</option>
                                    @for($i=1; $i <= 10; $i++)
                                    <option value="{{$i}}" @if(old('doors')== $i)selected="selected"@endif>{{$i}}</option>
                                    @endfor
                                    <option value="x" @if(old('doors')=="x")selected="selected"@endif>Other</option>
                                </select>
                                @if ($errors->has('doors'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('doors') }}</strong>
                                    </span>
                                @endif                                
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('engine') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Engine Capacity</label>

                            <div class="col-md-6">
                                <select class="form-control" name="engine" value="{{ old('engine') }}">
                                    <option value="">--- Choose engine capacity ---</option>
                                    @for($i=0; $i <= 9; $i++)
                                    <option value="1.{{$i}}" @if(old('engine')=="1.".$i)selected="selected"@endif>1.{{$i}}L</option>
                                    @endfor
                                    @for($i=0; $i <= 9; $i++)
                                    <option value="2.{{$i}}" @if(old('engine')=="2.".$i)selected="selected"@endif>2.{{$i}}L</option>
                                    @endfor
                                    <option value="3" @if(old('engine')=="3")selected="selected"@endif>3 - 4L</option>
                                    <option value="4" @if(old('engine')=="4")selected="selected"@endif>4 - 5L</option>
                                    <option value="5" @if(old('engine')=="5")selected="selected"@endif>5 - 6L</option>
                                    <option value="6" @if(old('engine')=="6")selected="selected"@endif>6 - 7L</option>
                                    <option value="7" @if(old('engine')=="7")selected="selected"@endif>7 - 8L</option>
                                    <option value="8" @if(old('engine')=="8")selected="selected"@endif>8 - 9L</option>
                                    <option value="0" @if(old('engine')=="9")selected="selected"@endif>Other</option>
                                </select>
                                @if ($errors->has('engine'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('engine') }}</strong>
                                    </span>
                                @endif                                
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mpg') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">MPG</label>

                            <div class="col-md-6">
                                <input type="number" class="form-control" name="mpg" value="{{ old('mpg') }}" min="0" max="100">
                                @if ($errors->has('mpg'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mpg') }}</strong>
                                    </span>
                                @endif                                
                            </div>
                        </div>   

                        <label class="col-md-4 control-label">*Required fields</label>

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
