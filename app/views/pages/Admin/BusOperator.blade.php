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
                    <li class="active"><a href="{{ URL::route('BusOperator', null) }}">Bus Operator</a></li>
                    <li><a href="{{ URL::route('BusRoute', null) }}">Bus Route</a></li>
                    <li><a href="{{ URL::route('BusService', null) }}">Bus Service</a></li>
                    <li><a href="{{ URL::route('Bus', null) }}">Bus</a></li>
                    <li><a href="#">Bus Stop</a></li>  
                    <li><a href="#">Bus Location</a></li>     
                  </ul>
            </div>
        </div>
        <div class="col-md-8">
            <h3>Bus Operator</h3>
            <p>Bus Operator Details.</p>
            <div>
                {{ Form::open(array('action' => 'addBusOperator', 'role' => 'form', 'id' => 'RegisterForm')); }}
                    <div class="form-group">
                        <label for="companyname">Company Name:</label>
                        {{ Form::text('companyname', '', array('class' => 'form-control', 'placeholder' => 'Enter company name')); }}    
                    </div>
                    <div class="form-group">
                        <label for="contactenquiry">Contact Enquiry:</label>
                        {{ Form::text('contactenquiry', '', array('class' => 'form-control', 'placeholder' => 'Enter Contact Enquiry')); }}    
                    </div>        
                    <div class="form-group">
                        <label for="addressline1">Address Line1:</label>
                        {{ Form::text('addressline1', '', array('class' => 'form-control', 'placeholder' => 'Enter Address Line 1')); }}    
                    </div>
                    <div class="form-group">
                        <label for="addressline1">Address Line2:</label>
                        {{ Form::text('addressline2', '', array('class' => 'form-control', 'placeholder' => 'Enter Address Line 2')); }}    
                    </div>
                    <div class="form-group">
                        <label for="city">City:</label>
                        {{ Form::text('city', '', array('class' => 'form-control', 'placeholder' => 'Enter City')); }}    
                    </div>
                    <div class="form-group">
                        <label for="zipcode">Zip Code:</label>
                        {{ Form::text('zipcode', '', array('class' => 'form-control', 'placeholder' => 'Enter Zip Code')); }}    
                    </div>
                    <div class="form-group">
                        <label for="country">Country:</label>
                        {{ Form::text('country', '', array('class' => 'form-control', 'placeholder' => 'Enter Country')); }}    
                    </div>                            
                    <div class="form-group">
                        <label for="contacthotline">Contact Hotline:</label>
                        {{ Form::text('contacthotline', '', array('class' => 'form-control', 'placeholder' => 'Enter Contact Hotline')); }}    
                    </div>
                    <div class="form-group">
                        <label for="contactemail">Contact Email:</label>
                        {{ Form::text('contactemail', '', array('class' => 'form-control', 'placeholder' => 'Enter Contact Email')); }}    
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