@extends('layout')

@section('title', 'Booths')

@section('content')
    <div class="main-card mb-3 card">
        <div class="card-body">
            <div class="mb-3 card card-body text-center">
                <h3>Booth</h3>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="first_name">First Name</label>
                                <input name="first_name" id="first_name" type="text" class="form-control"
                                       value="{{ $booth->name }}" disabled="disabled">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="last_name">Last Name</label>
                                <input name="last_name" id="last_name" type="text" class="form-control"
                                       value="{{ $booth->supervisor }}" disabled="disabled">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="latitude">Latitude</label>
                                <input name="latitude" id="latitude" type="text" class="form-control"
                                       value="{{ $booth->latitude }}" disabled="disabled">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="longitude">Longitude</label>
                                <input name="longitude" id="longitude" type="text" class="form-control"
                                       value="{{ $booth->longitude }}" disabled="disabled">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card text-center">
                        <div class="card-body">
                            {!! QrCode::size(300)->generate($booth->name . ' - ' . $booth->supervisor . ' - ' . $booth->latitude . ' - ' . $booth->longitude) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
