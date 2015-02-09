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
                    <li class="active"><a href="{{ URL::route('Bus', null) }}">Bus</a></li>
                    <li><a href="#">Bus Stop</a></li>    
                    <li><a href="#">Bus Location</a></li>   
                  </ul>
            </div>
        </div>
        <div class="col-md-8">
            <h3>Bus </h3>
            <p>Bus  Details.</p>
            <div>
                {{ Form::open(array('action' => 'addBus', 'role' => 'form', 'id' => 'RegisterForm')); }}    
                                  
                    <div class="form-group">
                        <label for="registration">Registration:</label>
                        {{ Form::text('registration', '', array('class' => 'form-control', 'placeholder' => 'Enter Registration')); }}    
                    </div>
                     
                    <div class="form-group">
                        <label for="busmodel">Bus Model:</label>
                        {{ Form::select('busmodel', DBBusModel::lists('modelName', 'modelName')); }}    
                    </div>
                    <div class="form-group">
                        <label for="busoperator">Bus Operator:</label>
                        {{ Form::select('busoperator', DBBusOperator::lists('companyName', 'companyName')); }}    
                    </div>
                    <div class="form-group">
                        <label for="busservice">Bus Service:</label>
                        {{ Form::select('busservice', DBBusService::lists('serviceName', 'serviceName')); }}    
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