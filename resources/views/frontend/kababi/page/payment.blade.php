@extends(Views::frontend())

@section('content')

<section class="tf-section wrap-category-style03">
    <div class="container-fluid cleafix">
        <div class="row">
            <div class="col-md-12 cleafix">
                <div class="content-heading-wrap">
                    <div class="tf-heading text-center">
                    @if(isset($model) && $model->booking_status == BookingType::Create)
                        <h4 class="tf-title tf-title-style3 mt-5">Payment Confirmation</h4>
                        @else
                        <h4 class="tf-title tf-title-style3 mt-5 mb-5">Waiting List</h4>
                    @endif
                    </div>
                </div>

                <div class="container mt-3" style="color:white">

                    @if(isset($model) && $model->booking_status == BookingType::Create)
                    <h5 class="tf-sub-heading color-style4 text-center">Segera lakukan pembayaran DP dalam {{ env('PAYMENT_TIME') }} Menit</h5>

                    <h3 class="text-center" style="color: white;clear:both;margin-bottom:20px">QRIS</h3>

                    <h5 class="text-center">
                        <img style="text-align: center;" src="data:image/png;base64,{{ DNS2D::getBarcodePNG($model->booking_qris_content, 'QRCODE', 5, 5, array(241,197,19)) }}"
                        alt="barcode" />
                    </h5>

                    <h5 class="text-center" style="color: white;margin-top:20px">NMID : {{ $model->booking_qris_nmid ?? '' }}</h5>

                    @if(empty($model->booking_qris_status))
                    <h5 class="text-center">
                        <a style="text-align: center;" class="btn btn-primary btn-lg text-center"
                        href="{{ route('payment', ['code' => $model->booking_code, 'check' => 'qris']) }}">CEK STATUS
                        PEMBAYARAN</a>
                    </h5>
                    @elseif($model->booking_qris_status == 'paid')
                    <a class="btn btn-success btn-lg"
                        href="{{ route('payment', ['code' => $model->booking_code, 'check' => 'qris']) }}">SUDAH
                        DIBAYAR</a>
                    @else
                    <a class="btn btn-danger btn-lg"
                        href="{{ route('payment', ['code' => $model->booking_code, 'check' => 'qris']) }}">BELUM
                        DIBAYAR, CEK LAGI !</a>
                    @endif

                    @elseif(isset($model) && $model->booking_status == BookingType::Booked)

                    @push('javascript')
                    <script>
                    (function worker() {
                        var link = "{{ route('waiting_list') }}";
                        $.ajax({
                            url: link,
                            method: 'POST',
                            data: {
                                id: '{{ $model->booking_meja_code }}'
                            },
                            success: function(data) {
                                $('#insert').html(data);
                            },
                            complete: function() {
                                setTimeout(worker, 90000);
                            }
                        });
                    })();
                    </script>
                    @endpush

                    <div id="insert" class="col-md-6 container" style="margin-top: -100px;">

                    </div>
                    @endif


                </div>
            </div>

        </div>
    </div>
</section>

@endsection