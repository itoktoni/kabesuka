@extends(Views::frontend())

@section('content')

<section class="tf-section wrap-category-style03">
    <div class="container-fluid cleafix">
        <div class="row">
            <div class="col-md-12 cleafix">
                <div class="content-heading-wrap">
                    <div class="tf-heading text-center">
                        <h4 class="tf-title tf-title-style3 mt-5">{{ $data->marketing_page_name }}</h4>
                    </div>
                </div>

                <div class="container" style="color:white;font-size:17px !important;line-height:1.5">

                    {!! $data->marketing_page_description !!}

                </div>
            </div>

        </div>
    </div>
</section>

@endsection