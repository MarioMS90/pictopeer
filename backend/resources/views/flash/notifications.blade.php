@if(session("notification"))
    <div class='alert alert-success mt-3' role='alert'>{{session('notification')}}</div>
@endif
