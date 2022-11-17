@if ($message = Session::get('flash_message_success'))
    <div class="container">
        <div class="row">
            <div class="col-md-4 alert alert-success alert-block">
                <button type="button" class="btn-close" aria-label="Close" data-dismiss="alert"></button>
                <strong>{{ $message }}</strong>
            </div>
        </div>
    </div>
@endif


@if ($message = Session::get('flash_message_error'))
    <div class="container">
        <div class="row">
            <div class="col-md-4 alert alert-danger alert-block">
                <button type="button" class="btn-close" aria-label="Close" data-dismiss="alert"></button>
                <strong>{{ $message }}</strong>
            </div>
        </div>
    </div>
@endif


@if ($message = Session::get('flash_message_warning'))
    <div class="container">
        <div class="row">
            <div class="col-md-4 alert alert-warning alert-block">
                <button type="button" class="btn-close" aria-label="Close" data-dismiss="alert"></button>
                <strong>{{ $message }}</strong>
            </div>
        </div>
    </div>
@endif


@if ($message = Session::get('flash_message_info'))
    <div class="container">
        <div class="row">
            <div class="col-md-4 alert alert-info alert-block">
                <button type="button" class="btn-close" aria-label="Close" data-dismiss="alert"></button>
                <strong>{{ $message }}</strong>
            </div>
        </div>
    </div>
@endif

<!--
@if ($errors->any())
    <div class="container">
        <div class="row">
            <div class="col-md-4 alert alert-danger">
                <button type="button" class="btn-close" aria-label="Close" data-dismiss="alert"></button>
                Please check the form below for errors
            </div>
        </div>
    </div>
@endif
-->