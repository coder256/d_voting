@extends('layout')

@section('title', 'Candidates')

@section('content')
    <div class="main-card mb-3 card">
        <div class="card-body">
            <div class="mb-3 card card-body text-center">
                <h3>Candidate</h3>
            </div>
            <form>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="first_name">First Name</label>
                            <input name="first_name" id="first_name" type="text" class="form-control"
                                   value="{{ $candidate[0]->first_name }}" disabled="disabled">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="last_name">Last Name</label>
                            <input name="last_name" id="last_name" type="text" class="form-control"
                                   value="{{ $candidate[0]->last_name }}" disabled="disabled">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="post">Post</label>
                            <input name="post" id="post" type="text" class="form-control" value="{{ $candidate[0]->name }}"
                                   disabled="disabled">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
