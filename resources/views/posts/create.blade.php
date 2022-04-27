@extends('layout')

@section('title', 'Posts')

@section('content')
    <div class="mb-3 card card-body text-center">
        <h3>Post</h3>
    </div>
    <div class="main-card mb-3 card">
        <div class="card-body">
            <form id="form_data" method="post" action="{{ route('post.store') }}">
                @csrf
                <input name="part" type="hidden" value="data">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="name">
                                <span class="text-danger">*</span> Name
                            </label>
                            <input name="name" id="name" type="text" class="form-control"
                                   required>
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
