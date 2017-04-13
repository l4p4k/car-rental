@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Message Information</div>

                <div class="panel-body">
                    @if($count!=NULL)
                        @if($count=="1")
                            There is {{$count}} message
                        @else
                            There are {{$count}} messages
                        @endif
                    @else
                        There are 0 messages
                    @endif
                </div>
            </div>

            @if($message_data!=NULL)
                <div class="panel panel-default">
                    <div class="panel-heading">Your messages</div>

                    <div class="panel-body">
                        @foreach($message_data as $message)
                            <p>{{$message->message_txt}}</p>
                            <p>{{$message->message_date}}</p>
                            <a href="/rental/{{$message->rental_id}}">Post: <b>{{$message->title}} </b></a>
                            <hr>
                        @endforeach
                        </div>
                    </div>
            <!-- end of message data check -->
            @endif
        </div>
    </div>
</div>
@endsection
