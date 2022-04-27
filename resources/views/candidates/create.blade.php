@extends('layout')

@section('title', 'Candidates')

@section('content')
    <div class="mb-3 card card-body text-center">
        <h3>Candidate</h3>
    </div>
    <div class="main-card mb-3 card">
        <div class="card-body">
            <form id="form_data" method="post" action="{{ route('candidate.store') }}">
                @csrf
                <input name="part" type="hidden" value="data">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="first_name">
                                <span class="text-danger">*</span> First Name
                            </label>
                            <input name="first_name" id="first_name" type="text" class="form-control"
                                   required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="last_name">
                                <span class="text-danger">*</span> Last Name
                            </label>
                            <input name="last_name" id="last_name" type="text" class="form-control"
                                   required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="post_id">
                                <span class="text-danger">*</span> Post
                            </label>
                            <select id="post_id" name="post_id" required class="form-control">
                                <option value="">Choose option</option>
                                @foreach($posts as $post)
                                <option value="{{ $post->id }}">{{ $post->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button class="btn-wide btn-pill btn-shadow btn-hover-shine btn btn-primary btn-lg">
                                Create
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
