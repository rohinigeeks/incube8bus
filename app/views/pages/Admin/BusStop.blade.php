@extends('layouts.default')

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-md-4">
            <h3>Admin</h3>
            <p>Select Page.</p>
            <div>
                 <ul class="nav nav-pills nav-stacked" role="tablist">
                    <li><a href="{{ URL::route('BusModel', null) }}">Bus Model</a></li>
                    <li><a href="{{ URL::route('BusOperator', null) }}">Bus Operator</a></li>
                    <li><a href="{{ URL::route('BusRoute', null) }}">Bus Route</a></li>
                    <li><a href="{{ URL::route('BusService', null) }}">Bus Service</a></li>
                    <li><a href="{{ URL::route('Bus', null) }}">Bus</a></li>
                    <li class="active"><a href="#">Bus Stop</a></li>    
                    <li><a href="#">Bus Location</a></li>        
                  </ul>
            </div>
        </div>
        <div class="col-md-8">
            <h3>Bus Stop</h3>
            <p>Bus Stop Details.</p>
            <div>
                {{ Form::open(array('action' => '/', 'role' => 'form', 'id' => 'RegisterForm')); }}
                    <div class="form-group">
                        <label for="address">Address:</label>
                        {{ Form::text('address', '', array('class' => 'form-control', 'placeholder' => 'Enter Address')); }}    
                    </div>
                    <div class="form-group">
                        <label for="latitude">Latitude:</label>
                        {{ Form::text('latitude', '', array('class' => 'form-control', 'placeholder' => 'Enter Latitude')); }}    
                    </div>        
                    <div class="form-group">
                        <label for="longitude">Longitude:</label>
                        {{ Form::text('longitude', '', array('class' => 'form-control', 'placeholder' => 'Enter Longitude')); }}    
                    </div>
                    
                {{Form::submit('Add');}}
                    </div>    
                    {{ Form::close() }}
            </div>
        </div>
    </div>
    </div>
@stop