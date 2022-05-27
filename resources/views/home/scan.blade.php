@extends('home.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <h1>SCAN CODE</h1>
                <span class="text-muted">*** Don't refresh page ***</span>
                <div id="qrcode" class="mt-3"></div>
                <br>
                <div class="loader mt-3"></div>
                <span class="h6">Waiting for scan </span>
                (<span class="text-danger" id="tmr">60</span> seconds to go)
            </div>
            <div class="col-4">
                {{--{{ Session::get('booth') }}--}}
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('js/qrcode.min.js') }}"></script>
    <script type="text/javascript">
        function strip_html(str) {
            return str.replaceAll('&quot;','"');
        }
        let code = strip_html("{{ Session::get('code') }}");
        console.log("The scan data ::" + "{{ Session::get('code') }}");
        console.log("The scan data :: ", JSON.parse(code) );

        // new QRCode(document.getElementById("qrcode"), code);
        let qrcode = new QRCode(document.getElementById("qrcode"), {
            text: code,
            // width: 128,
            // height: 128,
            colorDark : "#272643",
            colorLight : "#e3f6f5",
            correctLevel : QRCode.CorrectLevel.H
        });

        let tt = 65;
        function poll() {
            // console.log('polling...');
            tt -=5;
            document.getElementById('tmr').innerText = (tt-5).toString();
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    let res = JSON.parse(xhttp.responseText);
                    console.log("XHR response ::", res);
                    if (res.voter_data === "") {
                        console.log("validation failed, qr not scanned");
                    } else {
                        console.log("passed validation");
                        window.location.replace("{{ route('home.vote') }}");
                        // window.location.
                    }
                }
            };
            xhttp.open("GET", '{{ route('api.poll', [Session::get('booth')]) }}', true);
            xhttp.send();
        }

        let poller = setInterval(poll, 5000);
        // poll();
        // clearInterval(poller);
        const timeout = setTimeout(stopInterval, 60000);
        function stopInterval() {
            clearInterval(poller);
        }
    </script>
@endsection