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
                    <li  class="active"><a href="{{ URL::route('BusRoute', null) }}">Bus Route</a></li>
                    <li><a href="{{ URL::route('BusService', null) }}">Bus Service</a></li>
                    <li><a href="{{ URL::route('Bus', null) }}">Bus</a></li>
                    <li><a href="#">Bus Stop</a></li>  
                    <li><a href="#">Bus Location</a></li>    
                  </ul>
            </div>
        </div>
        <div class="col-md-8">
            <h3>Bus Route</h3>
            <p>Bus Route Details.</p>
            <div>
                {{ Form::open(array('action' => 'addBusRoute', 'role' => 'form', 'id' => 'RegisterForm')); }}
                    <div class="form-group">
                        <label for="busroutename">Bus Route Name:</label>
                        {{ Form::text('busroutename', '', array('class' => 'form-control', 'placeholder' => 'Enter Bus Route Name')); }}    
                    </div>
                    <div class="form-group">
                        <label for="busstopaddress">Bus Stop Address:</label>
                        {{ Form::text('busstopaddress', '', array('class' => 'form-control', 'placeholder' => 'Enter Bus Stop Address')); }}    
                    </div>
                    <div class="form-group">
                        <label for="order">Order:</label>
                        {{ Form::text('order', '', array('class' => 'form-control', 'placeholder' => 'Enter order')); }}    
                    </div>        
                    <div class="form-group">
                        <label for="road">Road:</label>
                        {{ Form::text('road', '', array('class' => 'form-control', 'placeholder' => 'Enter Road')); }}    
                    </div>
                    <div class="form-group">
                        <label for="kmdistance">Distance in KM:</label>
                        {{ Form::text('kmdistance', '', array('class' => 'form-control', 'placeholder' => 'Enter Distance in KM')); }}    
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