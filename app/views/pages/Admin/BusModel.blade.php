@extends('layouts.default')

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-md-4">
            <h3>Admin</h3>
            <p>Select Page.</p>
            <div>
                 <ul class="nav nav-pills nav-stacked" role="tablist">
                    <li class="active"><a href="{{ URL::route('BusModel', null) }}">Bus Model</a></li>
                    <li><a href="{{ URL::route('BusOperator', null) }}">Bus Operator</a></li>
                    <li><a href="{{ URL::route('BusRoute', null) }}">Bus Route</a></li>
                    <li><a href="{{ URL::route('BusService', null) }}">Bus Service</a></li>
                    <li><a href="{{ URL::route('Bus', null) }}">Bus</a></li>
                    <li><a href="#">Bus Stop</a></li>  
                    <li><a href="#">Bus Location</a></li>    
                  </ul>
            </div>
        </div>
        <div class="col-md-8">
            <h3>Bus Model</h3>
            <p>Bus Model Details.</p>
            <div>
                {{ Form::open(array('action' => 'addBusModel', 'role' => 'form', 'id' => 'RegisterForm')); }}
                    <div class="form-group">
                        <label for="modelname">Model Name:</label>
                        {{ Form::text('modelname', '', array('class' => 'form-control', 'placeholder' => 'Enter model name')); }}    
                    </div>
                    <div class="form-group">
                        <label for="manufacturer">Manufacturer:</label>
                        {{ Form::text('manufacturer', '', array('class' => 'form-control', 'placeholder' => 'Enter manufacturer')); }}    
                    </div>        
                    <div class="form-group">
                        <label for="modeltype">Model Type:</label>
                        {{ Form::select('modeltype', array(0 => 'Undefined', 1 => 'Single Deck', 2 => 'Double Deck', 3 => 'Rigid Bus', 4 => 'Articulated Bus'), 'Single Deck'); }}    
                    </div>
                    <div class="form-group">
                        <label for="entry">Entry:</label>
                        {{ Form::text('entry', '', array('class' => 'form-control', 'placeholder' => 'Enter entry')); }}    
                    </div>
                    <div class="form-group">
                        <label for="emissionstandard">Emission Standard:</label>
                        {{ Form::text('emissionstandard', '', array('class' => 'form-control', 'placeholder' => 'Enter Emission Standard')); }}    
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