@extends('layouts.app-alternate')

@section('title', 'Detail Travel')
@section('content')
    <main>
        <section class="section-details-header"></section>
        <section class="section-details-content">
            <div class="container">
                <div class="row">
                    <div class="col p-0 pl-3 pl-lg-0">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item" aria-current="page">
                                    <div class="logo">
                                        <a href="{{ route('home') }}">
                                            <span style="color: white;">T R A V E L G O</span>
                                        </a>
                                    </div>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 pl-lg-0">
                        <div class="card card-details">
                            <h1>{{ $item->title }}</h1>
                            <p>{{ $item->location }}</p>
                            <br>
                            <div class="gallery">
                                @if ($item->galleries->count())
                                    <div class="xzoom-container">
                                        <img class="xzoom" id="xzoom-default"
                                            src="{{ Storage::url($item->galleries->first()->image) }}"
                                            xoriginal="{{ Storage::url($item->galleries->first()->image) }}" />
                                        <div class="xzoom-thumbs">
                                            @foreach ($item->galleries as $gallery)
                                                <a href="{{ Storage::url($gallery->image) }}">
                                                    <img class="xzoom-gallery" width="128"
                                                        src="{{ Storage::url($gallery->image) }}"
                                                        xpreview="{{ Storage::url($gallery->image) }}" /></a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <div class="features row pt-3">
                                    <div class="col-md-4">
                                        <img src="{{ url('frontend/images/ic_event1.png') }}" alt=""
                                            class="features-image" />
                                        <div class="description">
                                            <h3>Featured Ticket</h3>
                                            <p>{{ $item->featured_event }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 border-left">
                                        <img src="{{ url('frontend/images/ic_bahasa1.png') }}" alt=""
                                            class="features-image" />
                                        <div class="description">
                                            <h3>Language</h3>
                                            <p>{{ $item->language }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 border-left">
                                        <img src="{{ url('frontend/images/ic_foods1.png') }}" alt=""
                                            class="features-image" />
                                        <div class="description">
                                            <h3>Foods</h3>
                                            <p>{{ $item->foods }}</p>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="details-container">
                                    <h2>About</h2>
                                    <p>
                                        {!! $item->about !!}
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-details card-right">
                            <h2>Travel Vendor</h2>
                            <p>{{ $item->user->name }}</p>
                            <hr />
                            <br>
                            
                            <table class="trip-informations">
                                <tr>
                                    <th >Departure</th>
                                    <td  class="text-right">
                                        {{ $item->departure_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th >Duration</th>
                                    <td  class="text-right">{{ $item->duration }}</td>
                                </tr>
                                <tr>
                                    <th >Type</th>
                                    <td  class="text-right">{{ $item->type }}</td>
                                </tr>
                                <tr>
                                    <th >Price</th>
                                    <td  class="text-right">Rp {{ number_format($item->price) }} / pax</td>
                                </tr>
                            </table>
                        </div>
                        <div class="join-container">
                            @auth
                                <form action="{{ route('checkout_process', $item->id) }}" method="post">
                                    @csrf
                                    <button class="btn btn-block btn-join-now" type="submit">
                                        Join Now
                                    </button>
                                </form>
                            @endauth
                            @guest
                                <a href="{{ route('login') }}" class="btn btn-block btn-join-now mt-3 py-2">Sign In to Join</a>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('prepend-style')
    <link rel="stylesheet" href="{{ url('frontend/libraries/xzoom/dist/xzoom.css') }}" />
@endpush

@push('addon-script')
    <script src="{{ url('frontend/libraries/xzoom/dist/xzoom.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.xzoom, .xzoom-gallery').xzoom({
                zoomWidth: 500,
                title: false,
                tint: '#333',
                Xoffset: 15
            });
        });
    </script>
@endpush
