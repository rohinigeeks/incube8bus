@extends('layouts.default')

@section('content')
    <div class="neighborhood-guides">
    <div class="container">
    <div class="row">
        <div class="col-md-4">
            <h3>Admin</h3>
            <p>Login.</p>
            <!--<div>
                 <ul class="nav nav-pills nav-stacked" role="tablist">
                    <li><a href="{{ URL::route('BusModel', null) }}">Bus Model</a></li>
                    <li><a href="{{ URL::route('BusOperator', null) }}">Bus Operator</a></li>
                    <li><a href="{{ URL::route('BusRoute', null) }}">Bus Route</a></li>
                    <li><a href="{{ URL::route('BusService', null) }}">Bus Service</a></li>
                    <li><a href="{{ URL::route('Bus', null) }}">Bus</a></li>
                    <li><a href="#">Bus Stop</a></li>    
                    <li><a href="#">Bus Location</a></li>      
                  </ul>
            </div>-->
        </div>
        <div class="col-md-8">
            <h3>Login</h3>
            <p>Enter your credentials.</p>
            <div>
                {{ Form::open(array('action' => 'postLogin', 'role' => 'form', 'id' => 'RegisterForm')); }}
                    <div class="form-group">
                        <label for="username">User Name:</label>
                        {{ Form::text('username', '', array('class' => 'form-control', 'placeholder' => 'Enter Username')); }}    
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        {{ Form::password('password', '', array('class' => 'form-control', 'placeholder' => 'Enter Password')); }}    
                    </div>
                        
                    <div class="form-group">
                        {{Form::submit('Login');}}
                    </div>    
                    {{ Form::close() }}
            </div>
        </div>
    </div>
    </div>
    </div>
@stop