@extends('frontend.master')
@section('content')
<style>
    .test {
    padding: 33px;
    border-radius: 30px;
    background: #17171724;
    }
</style>
<div class="container">
    <div class="d-flex justify-content-center align-items-center my-3">
        <div class="test">
            <p>Verification Email Has Been Sent To Your Email.</p>
            <div class="d-flex justify-content-between">
                <form action="{{route('verification.send')}}" method="post">
                @csrf
                    <button type="submit" class="btn btn-primary">Resend Email</button>
                </form>
                @if(auth()->user()->role_id == '2' || auth()->user()->role_id == '3')
                <a href="{{route('service_provider_index')}}" class="btn btn-primary">Click After Verify</a>
                @else
                <a href="{{route('content')}}" class="btn btn-primary">Click After Verify</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- <script type = "text/JavaScript">
         window.setTimeout( function() {
    window.location.reload();
    }, 10000);
</script> -->
@endpush
