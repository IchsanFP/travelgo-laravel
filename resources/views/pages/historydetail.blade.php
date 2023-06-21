@extends('layouts.app')

@section('title', 'History Detail')
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
                                <li class="breadcrumb-item " aria-current="page">
                                    <a href="{{ route('history.show', $item->id) }}">
                                        <span style="color: white;">Detail History</span>
                                    </a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8 pl-lg-0">
                        <div class="card card-details mb-3">
                            <div class="attendee">
                                <table class="table table-responsive-sm text-center">
                                    <tr>
                                        <th>Paket Travel</th>
                                        <td>{{ $item->travel_package->title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pembeli</th>
                                        <td>{{ $item->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Transaksi</th>
                                        <td>Rp {{ number_format($item->transaction_total) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status Transaksi</th>
                                        <td>{{ $item->transaction_status }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pembelian</th>
                                        <td>
                                            <table class="table table-responsive-sm text-center">
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>NIK KTP</th>
                                                </tr>
                                                @foreach ($item->details as $detail)
                                                    <tr>
                                                        <td>{{ $detail->name }}</td>
                                                        <td>{{ $detail->nik_ktp }}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2"></div>
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
