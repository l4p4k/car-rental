@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Message Information</div>

                <div class="panel-body">
                    There are NUM of messages
                </div>
            </div>

            @if($message_data!=NULL)
                <div class="panel panel-default">
                    <div class="panel-heading">Message</div>

                    <div class="panel-body">
                    @foreach($message_data as $data)
                        @foreach($data as $message)
                        <h3>{{$message->title}}</h3>
                            <p>{{$message->message_txt}}</p>
                            <p>Posted by<b>
                                @if($message->user_id == Auth::user()->id)
                                    {{$message->email}}
                                @else
                                    You
                                @endif</b></p>
                                <p>{{$message->message_date}}</p>
                            <hr>                        
                        @endforeach
                    @endforeach
                        </div>
                    </div>
            <!-- end of rental data check -->
            @endif

        </div>
    </div>
</div>
@endsection
