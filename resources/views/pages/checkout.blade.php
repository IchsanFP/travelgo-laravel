@extends('layouts.checkout')

@section('title', 'Checkout Travel')

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
                        <div class="card card-details mb-3">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <h1>Who's Going?</h1>
                            <p>
                                Trip to {{ $item->travel_package->title }}, {{ $item->travel_package->location }}
                            </p>
                            <br>
                            <div class="attendee">
                                <table class="table table-responsive-sm text-center">
                                    <thead>
                                        <tr>
                                            <td scope="col">Picture</td>
                                            <td scope="col">Name</td>
                                            <td scope="col">NIK</td>
                                            <td scope="col"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($item->details as $detail)
                                            <tr>
                                                <td>
                                                    <img src="https://ui-avatars.com/api/?name={{ $detail->name }}"
                                                        alt="" height="60" class="rounded-circle" />
                                                </td>
                                                <td class="align-middle">{{ $detail->name }}</td>
                                                <td class="align-middle">{{ $detail->nik_ktp }}</td>
                                                <td class="align-middle">
                                                    <a href="{{ route('checkout-remove', $detail->id) }}">
                                                        <img src="{{ url('frontend/images/ic_remove.png') }}"
                                                            alt="" />
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No Visitor</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <div class="member mt-3">
                                <h2>Add Member</h2>
                                <form class="form-inline" method="post" action="{{ route('checkout-create', $item->id) }}">
                                    @csrf
                                    <label class="sr-only" for="name">Name</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2 form-co" id="name" name="name"
                                        placeholder="Name" />

                                    <label class="sr-only" for="nik_ktp">NIK KTP</label>
                                    <input type="number" class="form-control mb-2 mr-sm-2 form-co" id="nik_ktp" name="nik_ktp"
                                        placeholder="NIK" />

                                    <button type="submit" class="btn btn-add-now mb-2 px-4 form-co">
                                        Add Now
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-details card-right">
                            <h2>Checkout Information</h2>
                            <p>{{ $item->user->name }}</p>
                            <hr>
                            <br>
                            <table class="trip-informations">
                                <tr>
                                    <th>Members</th>
                                    <td class="text-right">{{ $item->details->count() }} person</td>
                                </tr>
                                <tr>
                                    <th>Trip Price</th>
                                    <td class="text-right">Rp {{ number_format($item->travel_package->price) }} / pax
                                    </td>
                                </tr>
                                <tr style="padding-bottom: 20px;">
                                    <th>Sub Total</th>
                                    <td class="text-right">{{ number_format($item->transaction_total) }}</td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td class="text-right text-total">
                                        <span class="text-blue">Rp {{ number_format($item->transaction_total) }}</span>
                                    </td>
                                </tr>
                            </table>
                            <br>
                            <hr>
                            <br>
                            <h2>Payment Instructions</h2>
                            <p class="payment-instructions">
                                Please complete your payment before to continue the wonderful
                                trip
                            </p>
                            <br>
                            <div class="bank">
                                <div class="bank-item pb-3">
                                    <img src="{{ url('frontend/images/ic_bank1.png') }}" alt=""
                                        class="bank-image" />
                                    <div class="description">
                                        <h3>PT Bahagia Bersamamu</h3>
                                        <p style="color:#B08D74">
                                            8808-1001-801028
                                            <br />
                                        </p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="join-container">
                            <button type="button" class="btn btn-block btn-join-now mt-3 py-2" data-toggle="modal" data-target="#checkoutModal">
                                Payment
                            </button>
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ route('detail', $item->travel_package->slug) }}" class="text-muted">Cancel
                                Booking</a>
                        </div>
                    </div>
                </div>
                
                <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('checkout.upload', $item->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="uploadImageModalLabel">Upload Receipt</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="image">Payment Proof</label>
                                        <input type="file" name="payment_proof" class="form-control-file" id="image">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="upload" class="btn btn-primary">Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>                  
            </div>
            
        </section>
    </main>
@endsection


@push('prepend-style')
    <link rel="stylesheet" href="{{ url('frontend/libraries/gijgo/css/gijgo.min.css') }}" />
@endpush

@push('addon-script')
    <script src="{{ url('frontend/libraries/gijgo/js/gijgo.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            $('.datepicker').datepicker({
                uiLibrary: 'bootstrap4',
                icons: {
                    rightIcon: '<img src="{{ url('frontend/images/ic_doe.png') }}" alt="" />'
                }
            });
        });
    </script>
@endpush
