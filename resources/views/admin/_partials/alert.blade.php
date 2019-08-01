@if (session()->has('success'))
<input type="hidden" value="{{ session()->get('success') }}" id="notif-alert-success" class="notif-alert" data-type="success">
@endif
@if (session()->has('warning'))
<input type="hidden" value="{{ session()->get('warning') }}" id="notif-alert-warning" class="notif-alert" data-type="warning">
@endif
@if (session()->has('danger'))
<input type="hidden" value="{{ session()->get('danger') }}" id="notif-alert-danger" class="notif-alert" data-type="danger">
@endif