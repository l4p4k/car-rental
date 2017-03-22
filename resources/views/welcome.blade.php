@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table" style="width:100%">
                            <thead>
                                <tr>
                                <th>Title</th> 
                                <th>Make</th>
                                <th>Model</th>
                                <th class="text-right">Posted by</th>
                                </tr>
                            </thead> 
                            <tbody>
                                @foreach($data as $rental)
                                    <tr> 
                                        <td>
                                            <a href="/rental/{{$rental->rental_id}}">
                                                {{$rental->title}}
                                            </a>
                                        </td>
                                        <td>{{$rental->make}}</td>
                                        <td>{{$rental->model}}</td>
                                        <td class="text-right">
                                            <a href="#">
                                                {{$rental->email}}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    {{ $data->appends(Request::except('page'))->render() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
