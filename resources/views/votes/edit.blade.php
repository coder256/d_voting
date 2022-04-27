@extends('layout')

@section('title', 'Votes')

@section('content')
    <div class="mb-3 card card-body text-center">
        <h3>Vote</h3>
    </div>
    <div class="main-card mb-3 card">
        <div class="card-body">
            <form id="form_data" method="post" action="{{ route('vote.update', $vote[0]->id) }}">
                @csrf
                @method('PUT')
                <input name="part" type="hidden" value="data">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="post_id">
                                <span class="text-danger">*</span> Post
                            </label>
                            <select id="post_id" name="post_id" required class="form-control">
                                <option value="">Choose option</option>
                                @foreach($posts as $post)
                                    <option value="{{ $post->id }}" {{ (($vote[0]->post_id == $post->id) ? 'selected' : '') }}>{{ $post->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="candidate_id">
                                <span class="text-danger">*</span> Candidate
                            </label>
                            <select id="candidate_id" name="candidate_id" required class="form-control">
                                <option value="">Choose option</option>
                                @foreach($candidates as $candidate)
                                    <option value="{{ $candidate->id }}" {{ (($vote[0]->candidate_id == $candidate->id) ? 'selected' : '') }}>{{ $candidate->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="voter_id">
                                <span class="text-danger">*</span> Voter ID
                            </label>
                            <input name="voter_id" id="voter_id" type="number" class="form-control"
                                   value="{{ $vote[0]->voter_id }}" required>
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
