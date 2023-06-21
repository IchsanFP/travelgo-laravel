@extends('layouts.app')

@section('title', 'Travel Package')
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
                                        <a href="{{ route('home') }}">
                                            <span style="color: white;">Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item" aria-current="page">
                                        <a href="{{ route('travel') }}">
                                            <span style="color: white;">Package</span>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item " aria-current="page">
                                        <a href="{{ route('history.index') }}">
                                            <span style="color: white;">History</span>
                                        </a>
                                    </li>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 pl-lg-0">
                        <div class="card card-details mb-3">
                            <div class="attendee">
                                <table class="table table-responsive-sm text-center">
                                    <thead class="title-trip">
                                        <tr>
                                            <td scope="col">Picture</td>
                                            <td scope="col">Trip</td>
                                            <td scope="col">Location</td>
                                            <td scope="col">Type</td>
                                            <td scope="col">Language</td>
                                            <td scope="col">Price</td>
                                        </tr>
                                        <br>
                                    </thead>
                                    <tbody class="trip-details">
                                        @foreach ($items as $item)
                                            <tr>
                                                <td>
                                                    <div class="image-travel">
                                                        <img class="image-travel" src="{{$item->galleries->count() ? Storage::url($item->galleries->first()->image) : '' }}" alt="" height="120" />
                                                    </div>
                                                </td>
                                                <td class="align-middle">{{ $item->title }}</td>
                                                <td class="align-middle">{{ $item->location }}</td>
                                                <td class="align-middle">{{ $item->type }}</td>
                                                <td class="align-middle">{{ $item->language }}</td>
                                                <td class="align-middle">Rp {{ number_format($item->price) }}</td>
                                                <td>
                                                    <a href="{{ route('detail', $item->slug) }}"
                                                        class="btn btn-view-details align-middle">
                                                        View Details
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
