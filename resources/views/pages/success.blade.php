@extends('layouts.success')

@section('title', 'Checkout Success')

@section('content')
    <main>
        <div class="section-success d-flex align-items-center">
            <div class="col text-center">
                <img src="{{ url('frontend/images/success.png') }}" alt="" />
                <h1>Transaction success</h1>
                <p>
                    Thank you for trusting us, enjoy your trip
                </p>
                <a href="{{ url('/') }}" class="btn btn-home-page mt-3 px-5">
                    Okay
                </a>
            </div>
        </div>
    </main>
@endsection
