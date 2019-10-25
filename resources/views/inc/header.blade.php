<div class="flex-center position-ref full-height">
<div class="container-fluid content">

    @if(session('success') || session('error')) @if(session('success'))
    <div class="alert alert-success alert-dismissible bg-success text-white mt-128pt col-md-6" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Success - </strong> {{session('success')}}!
    </div>
    @endif @if(session('error'))
    <div class="alert alert-danger alert-dismissible bg-danger text-white mt-128pt col-md-6" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Error - </strong> {{session('error')}}!
    </div>
    @endif @endif @if($errors->any()) @foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible bg-danger text-white mt-128pt border-0 fade show mt-1 col-md-6" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Error - </strong> {{$error}}!
    </div>
    @endforeach
    @endif
