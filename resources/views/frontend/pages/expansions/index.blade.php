@extends('frontend.layouts.master')
@section('breadcrumb')
    @include('frontend.partials.breadcrumb',['breadcrumbs' => [
        [
            'name' => __("Dashboard"),
            'url' => setRoute("user.dashboard"),
        ]
    ], 'active' => __("Expansions")])
@endsection
@section('content')
<div class="body-wrapper">
    <div class="row mb-20-none">
        @include('frontend.partials.expansion-sidebar')
        <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12">
            <div class="custom-card mt-10">
                <div class="dashboard-header-wrapper">
                    <h4 class="title">@lang('Expansion Services')</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="expansion-card">
                                <div class="icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <h5 class="title">@lang('Personal')</h5>
                                <p>@lang('Secure personal payments and individual finance management')</p>
                                <a href="{{ setRoute('user.expansion.personal') }}" class="btn btn-primary">@lang('Get Started')</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="expansion-card">
                                <div class="icon">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                                <h5 class="title">@lang('Business')</h5>
                                <p>@lang('Business payment solutions and financial tools')</p>
                                <a href="{{ setRoute('user.expansion.business') }}" class="btn btn-primary">@lang('Get Started')</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="expansion-card">
                                <div class="icon">
                                    <i class="fas fa-building"></i>
                                </div>
                                <h5 class="title">@lang('Enterprise')</h5>
                                <p>@lang('Enterprise-grade payment infrastructure and solutions')</p>
                                <a href="{{ setRoute('user.expansion.enterprise') }}" class="btn btn-primary">@lang('Get Started')</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="expansion-card">
                                <div class="icon">
                                    <i class="fas fa-industry"></i>
                                </div>
                                <h5 class="title">@lang('Company')</h5>
                                <p>@lang('Corporate financial management and payment solutions')</p>
                                <a href="{{ setRoute('user.expansion.company') }}" class="btn btn-primary">@lang('Get Started')</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="expansion-card">
                                <div class="icon">
                                    <i class="fas fa-code"></i>
                                </div>
                                <h5 class="title">@lang('Developer')</h5>
                                <p>@lang('API integration and development tools')</p>
                                <a href="{{ setRoute('user.expansion.developer') }}" class="btn btn-primary">@lang('Get Started')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection