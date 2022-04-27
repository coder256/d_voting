@extends('layout')

@section('title', 'Votes')

@section('content')
    <div class="mb-3 card card-body text-center">
        <h3>Vote</h3>
    </div>
    <div class="main-card mb-3 card">
        <div class="card-body">
            <form id="form_data" method="post" action="{{ route('vote.store') }}">
                @csrf
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
                                    <option value="{{ $post->id }}">{{ $post->name }}</option>
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
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="voter_id">
                                <span class="text-danger">*</span> Voter ID
                            </label>
                            <input name="voter_id" id="voter_id" type="number" class="form-control" required>
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

@section('js')
    <script>
        $(document).ready(function() {
            $('#post_id').on('change', function() {
                var postID = $(this).val();
                if(postID) {
                    $.ajax({
                        url: '/candidate/candidates/'+postID,
                        type: "GET",
                        dataType: "json",
                        success:function(data)
                        {
                            if(data){
                                $('#candidate_id').empty();
                                $('#candidate_id').append('<option hidden>Choose option</option>');
                                $.each(data, function(key, candidate){
                                    $('select[name="candidate_id"]').append('<option value="'+ candidate.id +'">' + candidate.first_name + ' ' + candidate.last_name + '</option>');
                                });
                            }else{
                                $('#candidate_id').empty();
                            }
                        }
                    });
                }else{
                    $('#candidate_id').empty();
                }
            });
        });
    </script>
@endsection
