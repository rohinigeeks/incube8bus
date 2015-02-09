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
                    <li  class="active"><a href="{{ URL::route('BusService', null) }}">Bus Service</a></li>
                    <li><a href="{{ URL::route('Bus', null) }}">Bus</a></li>
                    <li><a href="#">Bus Stop</a></li>    
                    <li><a href="#">Bus Location</a></li>    
                  </ul>
            </div>
        </div>
        <div class="col-md-8">
            <h3>Bus Service</h3>
            <p>Bus Service Details.</p>
            <div>
                {{ Form::open(array('action' => 'addBusService', 'role' => 'form', 'id' => 'RegisterForm')); }}
                    
                    <div class="form-group">
                        <label for="busroutename">Bus Route:</label>
                        {{ Form::select('busroutename', DBBusRoute::select('busRouteName')->groupBy('busRouteName')->lists('busRouteName','busRouteName')); }}        
                    </div>
                    <div class="form-group">
                        <label for="servicename">Service Name:</label>
                        {{ Form::text('servicename', '', array('class' => 'form-control', 'placeholder' => 'Enter Service Name')); }}    
                    </div>        
                    <div class="form-group">
                        <label for="servicetype">Service Type:</label>
                        {{ Form::select('servicetype', array(0 => 'Basic', 1 => 'Basic Plus', 2 => 'Premium', 3 => 'City Plus'), 'Basic'); }}    
                    </div>
                    <div class="form-group">
                        <label for="start">Start:</label>
                        {{ Form::text('start', '', array('class' => 'form-control', 'placeholder' => 'Enter Start')); }}    
                    </div>
                    <div class="form-group">
                        <label for="end">End:</label>
                        {{ Form::text('end', '', array('class' => 'form-control', 'placeholder' => 'Enter End')); }}    
                    </div>
                    <div class="form-group">
                        {{Form::submit('Add');}}
                    </div>    
                    {{ Form::close() }}
            </div>
        </div>
    </div>
    </div>
@stop