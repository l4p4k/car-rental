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
                            <a href="/rental/{{$rental->rental_id}}" style="text-decoration:none"><h3>
                                @if($rental->avail)
                                <b><p class="bg-success">
                                    {{$rental->title}}
                                </p></b>
                                @else
                                <b><p class="bg-danger">
                                    {{$rental->title}}
                                </p></b>
                                @endif
                            </h3>
                            <div>
                            @if($rental->img)
                                <img src="/uploads/{{$rental->rental_id}}.png" class="img-responsive" width="30%" alt="Image">
                            @else
                                <img src="/site_images/no image.png" class="img-responsive img-circle" width="30%" alt="no image">
                            @endif   
                            </div>
                            <p>{{$rental->make}} {{$rental->model}}</p>
                            <p>{{$rental->email}}<p>
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
