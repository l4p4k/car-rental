@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if($rental_data!=NULL)
            <div class="panel panel-default">
                <div class="panel-heading">{{$rental_data->title}}</div>

                <div class="panel-body">
                    {{$rental_data->description}}<br>
                    {{$rental_data->make}}<br>
                    {{$rental_data->model}}<br>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Add a message</div>

                <div class="panel-body">

                    <form class="form-horizontal" role="form" method="POST" action="{{route('message.form') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('message_txt') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">*Message</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="message_txt" value="{{ old('message_txt') }}" cols="40" rows="3"  maxlength="255"></textarea>
                                @if ($errors->has('message_txt'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('message_txt') }}</strong>
                                    </span>
                                @endif                                
                            </div>
                        </div>

                        <input type="hidden" name="rental_id" value="{{$rental_data->rental_id}}">
                        <input type="hidden" name="user_id" value="{{$rental_data->user_id}}">

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

            <div class="panel panel-default">
                <div class="panel-heading">Private Messages between you and {{$rental_data->user_id}}</div>

                <div class="panel-body">
                @if($message_data!=NULL)
                    A message is here
                @else
                    <p>No messages<p>
                @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
