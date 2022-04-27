@extends('layout')

@section('title', 'Posts')

@section('content')
    <div class="main-card mb-3 card">
        <div class="card-body">
            <div class="mb-3 card card-body text-center">
                <h3>Post</h3>
            </div>
            <form>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="name">Name</label>
                            <input name="name" id="name" type="text" class="form-control"
                                   value="{{ $post->name }}" disabled="disabled">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
