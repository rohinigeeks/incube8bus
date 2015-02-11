@extends('layouts.default')

@section('content')
    <div class="neighborhood-guides">
        <div class="container">
            <div class="col-md-12">
                <h3>Hop</h3>
                <p>View when buses will arrive.</p>
                {{ Form::open(array('action' => 'Hop', 'role' => 'form', 'id' => 'HopForm')); }}   
                <div>
                    <div class="form-group">
                        <label for="busservice">Bus Service:</label>
                        {{ Form::select('busstop', DBBusStop::lists('address', 'id')); }}    
                    </div>
                    <div class="form-group">
                        {{Form::submit('Submit');}}
                    </div>
                    @if ($arrResult != null)
                        <table data-toggle="table" id="table-style" data-cache="false" data-height="299" data-row-style="rowStyle">
                        <thead>
                            <tr>
                                <th data-field="id" class="col-md-4">Registration</th>
                                <th data-field="name" class="col-md-6">Time</th>
                                <th data-field="price" class="col-md-2">Duration</th>
                            </tr>
                        </thead>
                        @foreach ($arrResult['BusDurations'] as $arrItem)
                            <tr>
                                <td class="col-md-4">  {{ $arrItem['registration'] }}</td>
                                <td class="col-md-6">  {{ $arrItem['timestamp'] }}</td>
                                <td class="col-md-2">  {{ $arrItem['duration']  }}</td>
                            </div>
                        @endforeach
                        </table>
                    @else
                        <div>No Results Found Select Bus Stop</div>
                    @endif
                    
                </div>
                {{ Form::close() }}
            </div>
        <div>
    </div>
@stop