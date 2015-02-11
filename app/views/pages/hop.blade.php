@extends('layouts.default')

@section('content')
    <div class="neighborhood-guides">
        <div class="container">
            <div class="col-md-12">
                <h3>Hop</h3>
                <p>View which buses are near you.</p>
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
                        @foreach ($arrResult['BusLocations'] as $arrItem)
                            <div>
                                <p>Registration:  {{ $arrItem['registration'] }}</p>
                                <p>Timestamp:     {{ $arrItem['timestamp'] }}</p>
                                <p>Duration:      {{ $arrItem['latitude']     }}</p>
                            </div>
                        @endforeach
                    @else
                        <div>No Results Found Select Bus Stop</div>
                    @endif
                    {{--
                    @if ($arrResult != null)
                        @foreach ($arrResult as $arrItem)
                            <div>
                                <p>Registration:  {{ $arrItem->registration }}</p>
                                <p>Timestamp:     {{ $arrItem->timestamp    }}</p>
                                <p>Duration:      {{ $arrItem->duration     }}</p>
                            </div>
                        @endforeach
                    @else
                        <div>No Results Found Select Bus Stop</div>
                    @endif
                    --}}
                </div>
                {{ Form::close() }}
            </div>
        <div>
    </div>
@stop