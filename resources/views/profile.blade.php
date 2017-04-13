@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!<br>
                    First Name: {{Auth::user()->fname}}<br>
                    Second Name: {{Auth::user()->sname}}<br>
                    Email: {{Auth::user()->email}}<br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
