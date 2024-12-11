<!--Services Style One-->
<section class="services-style-one padd-1 bg-1">
    <div class="container">
        <div class="sec-title center">
            <h2>Our <span>Services</span></h2>
        </div>
        <div class="row clearfix">
            @foreach ($tenants as $tenant)
                <!--Service Block-->
                <div class="column col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="service-block wow fadeIn" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <!-- Logo Tenant -->
                                <img src="{{ $tenant->logo_tenant }}" alt="{{ $tenant->name_tenant }}"/>
                                <!-- Caption Tenant -->
                                <div class="caption">{{ $tenant->name_tenant }}</div>
                                <div class="overlay-box">
                                    <h3>{{ $tenant->name_tenant }}</h3>
                                    <div class="text">{{ $tenant->desc_tenant }}</div>
                                    <a class="btn-style-three" href="#">Read More <span class="fa fa-angle-double-right"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
