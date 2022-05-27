@if (session()->has('message_success'))
    <div class="mb-3 card text-white card-body bg-success">
        {{ session('message_success') }}
    </div>
@endif
@if (session()->has('message_fail'))
    <div class="mb-3 card text-white card-body bg-danger">
        {{ session('message_fail') }}
    </div>
@endif
@if (session()->has('message_info'))
    <div class="mb-3 card text-white card-body bg-info">
        {{ session('message_info') }}
    </div>
@endif
@if (session()->has('message_warning'))
    <div class="mb-3 card text-white card-body bg-warning">
        {{ session('message_warning') }}
    </div>
@endif