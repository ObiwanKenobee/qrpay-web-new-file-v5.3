
@php
    $lang = selectedLang();
    $system_default    = $not_removable_code;
    $banner_slug = Illuminate\Support\Str::slug(App\Constants\SiteSectionConst::BANNER_SECTION);
    $banner = App\Models\Admin\SiteSections::getData( $banner_slug)->first();
@endphp

<section class="banner-section bg_img position-relative enhanced-banner" data-background="{{ asset('frontend/') }}/images/banner/bg-1.jpg">
    <div class="banner-gradient-overlay"></div>
    <div class="container home-container">
        <div class="row align-items-center mb-30-none">
            <div class="col-lg-6 col-md-6 mb-30">
                <div class="banner-thumb-area text-center">
                    <img src="{{ get_image(@$banner->value->images->banner_image,'site-section') }}" alt="banner" class="img-fluid animated fadeInLeft">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-30">
                <div class="banner-content">
                    <span class="banner-sub-titel"><i class="fas fa-qrcode"></i> {{ __($banner->value->language->$lang->title ?? $banner->value->language->$system_default->title) }}</span>
                    <h1 class="banner-title display-4 fw-bold animated fadeInDown">
                        {{ __($banner->value->language->$lang->heading ?? $banner->value->language->$system_default->heading) }}
                    </h1>
                    <p class="lead animated fadeInUp">{{ __($banner->value->language->$lang->sub_heading ?? $banner->value->language->$system_default->sub_heading) }}</p>
                    <div class="app-btn-area d-flex gap-3 mt-4">
                        <a href="{{ @$app_urls->android_url }}" class="app-btn enhanced-btn animated pulse" target="_blank">
                            <div class="icon">
                                <img src="{{ asset('frontend/') }}/images/app/play-store.png" alt="play-store">
                            </div>
                            <div class="content">
                                <span class="sub-title">{{ __("Get It On") }}</span>
                                <h5 class="title">{{ __("Google Play") }}</h5>
                            </div>
                        </a>
                        <a href="{{ @$app_urls->iso_url }}" class="app-btn enhanced-btn animated pulse" target="_blank">
                            <div class="icon">
                                <img src="{{ asset('frontend/') }}/images/app/apple-store.png" alt="apple-store">
                            </div>
                            <div class="content">
                                <span class="sub-title">{{ __("Download On The") }}</span>
                                <h5 class="title">{{ __("Apple Store") }}</h5>
                            </div>
                        </a>
                    </div>
                    <div class="tech-stack-highlight mt-5 p-3 rounded shadow-sm bg-white animated fadeInUp">
                        <h6 class="mb-2 text-primary"><i class="fas fa-laptop-code"></i> {{ __('Built With') }}</h6>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-primary">Laravel</span>
                            <span class="badge bg-success">PHP</span>
                            <span class="badge bg-info text-dark">Blade</span>
                            <span class="badge bg-warning text-dark">Bootstrap</span>
                            <span class="badge bg-dark">Vite</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
