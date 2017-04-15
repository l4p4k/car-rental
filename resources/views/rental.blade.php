@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <!-- if data is not present -->
            @if($rental_data!=NULL)
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if(!Auth::guest() && ($rental_data->user_id == Auth::user()->id))
                        <form class="form-horizontal" role="form" method="POST" action="{{route('rental.rent') }}">
                            {!! csrf_field() !!}

                            @if($rental_data->avail)
                                <h3 class="bg-success"><button type="submit" class="btn btn-success">
                                    Rent Car
                                </button> Status: Available </h3>
                            @else
                                <h3 class="bg-danger"><button type="submit" class="btn btn-danger">
                                    Make Available
                                </button> @if($rental_data->avail == null) Status: Not Available @else Status: Rented @endif </h3>
                            @endif

                            <input type="hidden" name="rental_id" value="{{$rental_data->rental_id}}">
                        </form>
                    @else
                        @if($rental_data->avail)
                            <h3 class="bg-success">
                                Status: Available
                            </h3>
                        @else
                            <h3 class="bg-danger">
                                @if($rental_data->avail == null) Status: Not Available @else Status: Rented @endif 
                            </h3>
                        @endif
                    @endif
                </div>

                <div class="panel-body">
                    <h1>{{$rental_data->title}}</h1>
                    <p>{{$rental_data->description}}</p>
                    @if($rental_data->img)
                        <img src="/uploads/{{$rental_data->rental_id}}.png" class="img-responsive" alt="Image">
                    @else
                        <img src="/site_images/no image.png" class="img-responsive" alt="no image">
                    @endif
                    <p>Posted by<b> {{$rental_data->email}} ({{$rental_data->fname}} {{$rental_data->sname}})</b></p><hr>

                    <p><b>Make:</b> {{$rental_data->make}}<p>
                    <p><b>Model:</b> {{$rental_data->model}}<p>

                    @if($rental_data->colour!=null)
                        <p><b>Colour:</b> {{$rental_data->colour}}<p>
                    @endif
                    @if($rental_data->type!=null)
                        <p><b>Type:</b> {{$rental_data->type}}<p>
                    @endif
                    @if($rental_data->fuel!=null)
                        <p><b>Fuel:</b> {{$rental_data->fuel}}<p>
                    @endif
                    @if($rental_data->transmission!=null)
                        <p><b>Transmission:</b> {{$rental_data->transmission}}<p>
                    @endif
                    @if($rental_data->doors!=null)
                        <p><b>Doors:</b> {{$rental_data->doors}}<p>
                    @endif
                    @if($rental_data->engine_cc!=null)
                        <p><b>Engine_cc:</b> {{$rental_data->engine_cc}}<p>
                    @endif
                    @if($rental_data->mpg!=null)
                        <p><b>MPG:</b> {{$rental_data->mpg}}<p>
                    @endif
                </div>
            </div>

            @if(!Auth::guest())
            <div class="panel panel-default">
                <div class="panel-heading">Add a message</div>

                <div class="panel-body">

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('message.form') }}" enctype="multipart/form-data">
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

                        <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">File Upload</label>(max size: 2MB)

                            <div class="col-md-6">
                                <input type="file" class="form-control" name="file" value="{{ old('file') }}">

                                @if ($errors->has('file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                        

                        <input type="hidden" name="rental_id" value="{{$rental_data->rental_id}}">
                        <input type="hidden" name="owner_id" value="{{$rental_data->user_id}}">

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
            @endif

            @if(!Auth::guest())
            <div class="panel panel-default">
                <div class="panel-heading">Messages on this post</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        @if($message_data!=null)
                            @foreach($message_data as $message)
                                @if((!Auth::guest()) && (($message->messager_id == Auth::user()->id)))
                                    <blockquote><p class="bg-warning">{{$message->message_txt}}<p>
                                @elseif($message->messager_id == $message->poster_id)
                                    <blockquote><p class="bg-primary">{{$message->message_txt}}<p>
                                @else
                                    {{$message->message_txt}}
                                @endif

                                @if($message->message_file != null && $message->message_file != "0")
                                    <a href="/uploads/{{$message->message_file}}">Click to view file</a>
                                @else
                                    <!-- No Image -->
                                @endif
         
                                <footer><p>Posted by<b>
                                @if(!Auth::guest())
                                    @if($message->messager_id != Auth::user()->id)
                                        @if($message->messager_id == $message->poster_id)
                                            Owner
                                        @else
                                            {{$message->email}}
                                        @endif
                                    @else
                                        You
                                    @endif
                                @else
                                    @if($message->messager_id != $message->poster_id)
                                        {{$message->email}}
                                    @else
                                        Owner
                                    @endif
                                @endif</b></p></footer></blockquote>
                                <p>{{$message->message_date}}</p>
                            <hr>
                        @endforeach   
                            {{ $message_data->appends(Request::except('page'))->render() }} 
                        @else
                            <!-- Nothing -->
                        @endif
                    </div>
                </div>
            <!-- end if guest check -->
            @endif
            </div>
        <!-- end of rental data check -->
        @endif
        </div>

    </div>
</div>
@endsection
