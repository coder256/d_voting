@extends('layout')

@section('title', 'Booths')

@section('content')
    <div class="mb-3 card card-body text-center">
        <h3>Booth</h3>
    </div>
    <div class="main-card mb-3 card">
        <div class="card-body">
            <form id="form_data" method="post" action="{{ route('booth.update', $booth->id) }}">
                @csrf
                @method('PUT')
                <input name="part" type="hidden" value="data">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="name">
                                <span class="text-danger">*</span> Name
                            </label>
                            <input name="name" id="name" type="text" class="form-control"
                                   value="{{ $booth->name }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="supervisor">
                                <span class="text-danger">*</span> Supervisor
                            </label>
                            <input name="supervisor" id="supervisor" type="text" class="form-control"
                                   value="{{ $booth->supervisor }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="latitude">
                                <span class="text-danger">*</span> Latitude
                            </label>
                            <input name="latitude" id="latitude" type="text" class="form-control"
                                   value="{{ $booth->latitude }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="longitude">
                                <span class="text-danger">*</span> Longitude
                            </label>
                            <input name="longitude" id="longitude" type="text" class="form-control"
                                   value="{{ $booth->longitude }}" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button class="btn-wide btn-pill btn-shadow btn-hover-shine btn btn-primary btn-lg">
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
