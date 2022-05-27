@extends('home.layout')

@section('title', 'Vote')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <h3 class="text-center">VOTE</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form id="form_data" method="post" action="{{ route('home.cast') }}">
                            @csrf
                            <input name="part" type="hidden" value="data">
                            <div class="form-row">
                                <div class="col-md-12 col-12 mb-3">
                                    <div class="position-relative form-group">
                                        <label for="post_id">
                                            <span class="text-danger">*</span> Post
                                        </label>
                                        <select id="post_id" name="post_id" class="form-control" onchange="onPostChange(this.value)" required>
                                            <option value="">Choose option</option>
                                            @foreach($posts as $post)
                                                <option value="{{ $post->id }}">{{ $post->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12 mb-3">
                                    <div class="position-relative form-group">
                                        <label for="candidate_id">
                                            <span class="text-danger">*</span> Candidate
                                        </label>
                                        <select id="candidate_id" name="candidate_id" required class="form-control">
                                            <option value="">Choose a post first</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12 mb-3">
                                    <div class="position-relative form-group">
                                        <label for="voter_id">
                                            <span class="text-danger">*</span> Voter ID
                                        </label>
                                        <input name="voter_id_" id="voter_id" type="text" value="{{ $voter_id }}" class="form-control" disabled>
                                        <input name="voter_id" type="hidden" value="{{ $voter_id }}">
                                    </div>
                                </div>
                                <div class="col-md-12 col-12 mb-3">
                                    <div class="form-group text-center">
                                        <button class="btn-wide btn-pill btn-shadow btn-hover-shine btn btn-primary btn-lg ">
                                            Cast vote
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{--<div class="col-md-6">
                {{ old('post_id') }} - {{ old('candidate_id') }} -- {{ old('voter_id') }} << {{ Session::get('booth') }}
            </div>--}}
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        function onPostChange(post_id) {
            console.log('event...', post_id);
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    let res = JSON.parse(xhttp.responseText);
                    // let res = xhttp.responseText;
                    console.log("XHR response ::", res);
                    let candidates = document.getElementById('candidate_id');
                    candidates.innerHTML = "";
                    res.forEach((elem) => {
                        let opt = document.createElement('option');
                        opt.value = elem.id;
                        opt.text = `${elem.first_name} ${elem.last_name}`;
                        candidates.append(opt);
                    });

                }
            };
            // xhttp.open("GET", `/candidate/candidates/${post_id}`, true);
            xhttp.open("GET", `/api/voting/candidates/${post_id}`, true);
            xhttp.send();
        }
    </script>
@endsection