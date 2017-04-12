@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    @if($rental_data!=null)
                        @foreach($rental_data as $rental)
                        <table class="table table-hover"><tbody><tr><td>                     
                            <h3><a href="/rental/{{$rental->rental_id}}">
                                {{$rental->title}}
                            </a></h3>
                            <div>
                            @if($rental->img)
                                <img src="/uploads/{{$rental->rental_id}}.png" class="img-responsive" width="50%" alt="Image">
                            @else
                                <img src="/site_images/no image.png" class="img-responsive img-circle" alt="no image">
                            @endif   
                            </div>
                            <p>{{$rental->make}} {{$rental->model}}</p>
                            <a href="#" class="text-right">
                                {{$rental->email}}
                            </a>
                        </td></tr></tbody></div></table>
                        @endforeach
                        {{ $rental_data->appends(Request::except('page'))->render() }}
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
