@extends('layout')

@section('title', 'Votes')

@section('content')
    <div class="main-card mb-3 card">
        <div class="card-body">
            <div class="mb-3 card card-body text-center">
                <h3>Vote</h3>
            </div>
            <form>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="post">Post</label>
                            <input name="post" id="post" type="text" class="form-control"
                                   value="{{ $vote[0]->post }}" disabled="disabled">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="candidate">Candidate</label>
                            <input name="candidate" id="candidate" type="text" class="form-control"
                                   value="{{ $vote[0]->candidate }}" disabled="disabled">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="voter">Voter</label>
                            <input name="voter" id="voter" type="text" class="form-control" value="{{ $vote[0]->voter }}"
                                   disabled="disabled">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
