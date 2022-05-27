@extends('home.layout')

@section('css_includes')
    <style type="text/css">
        #voteContainer {
            margin-top: 35vh;
        }
        #voteLink{
            text-decoration: none;
        }

        #voteButton{
            background-color: #272643;
            color: #bae8e8;
            font-size: 60px;
            padding: 100px 62px;
        }
    </style>
@endsection

@section('content')
    <div class="container" style="height: calc(100% - 40px)">
        <div class="row">
            <div class="col-12">
                <div id="voteContainer" class="d-flex justify-content-center">
                    <a href="{{ route('home.scan') }}" id="voteLink">
                        <span id="voteButton" class="rounded-circle">VOTE</span>
                    </a> <br>
                </div>
            </div>
            <div class="col-12" style="padding-top: 100px;">
                <h3 class="text-center">Click button above to view code</h3>
            </div>
        </div>
    </div>
@endsection