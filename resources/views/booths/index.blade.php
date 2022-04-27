@extends('layout')

@section('title', 'Booths')

@section('content')
    <div class="main-card mb-3 card">
        <div class="card-body">
            <div class="mb-3 card card-body text-center">
                <h3>Booths</h3>
            </div>
            @if(!$booths->isEmpty())
                <p>
                    <button id="download-button" class="btn btn-info">Download CSV</button>
                </p>
                <table style="width: 100%;" id="example"
                       class="table table-hover table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Supervisor</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Registered on</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($booths as $booth)
                        <tr>
                            <td>{{ $booth->name }}</td>
                            <td>{{ $booth->supervisor }}</td>
                            <td>{{ $booth->latitude }}</td>
                            <td>{{ $booth->longitude }}</td>
                            <td>{{ date('m/d/Y', strtotime($booth->created_at)) }}</td>
                            <td>
                                <form action="{{ route('booth.destroy', $booth->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('booth.show', $booth->id) }}" class="btn btn-info"><i
                                                class="fa fa-eye"></i></a>
                                    @if (in_array(Auth::user()->role, array('admin')))
                                    <a href="{{ route('booth.edit', $booth->id) }}" class="btn btn-warning"><i
                                                class="fa fa-edit"></i></a>
                                    <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i>
                                    </button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Supervisor</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Registered on</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                </table>
            @else
                <a href="{{ route('booth.create') }}" class="mb-2 mr-2 btn btn-success">Create</a>
            @endif
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.getElementById("download-button").addEventListener("click", function () {
            var html = document.querySelector("table").outerHTML;
            htmlToCSV(html, "data.csv");
        });

        function htmlToCSV(html, filename) {
            var data = [];
            var rows = document.querySelectorAll("table tr");

            for (var i = 0; i < rows.length; i++) {
                var row = [], cols = rows[i].querySelectorAll("td, th");

                for (var j = 0; j < cols.length; j++) {
                    row.push(cols[j].innerText);
                }

                data.push(row.join(","));
            }

            downloadCSVFile(data.join("\n"), filename);
        }

        function downloadCSVFile(csv, filename) {
            var csv_file, download_link;
            csv_file = new Blob([csv], {type: "text/csv"});
            download_link = document.createElement("a");
            download_link.download = filename;
            download_link.href = window.URL.createObjectURL(csv_file);
            download_link.style.display = "none";
            document.body.appendChild(download_link);
            download_link.click();
        }
    </script>
@endsection()

