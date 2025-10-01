@extends('qrpay-gateway.layouts.master')

@push('css')
<style>
  .landing-hero { background: linear-gradient(90deg,#0d6efd,#20c997); color: #fff; }
  .landing-hero .title { font-weight: 800; letter-spacing: -0.5px; }
  .feature-card { border: 1px solid #eef2f7; transition: box-shadow .2s; }
  .feature-card:hover { box-shadow: 0 8px 24px rgba(13,110,253,.12) }
</style>
@endpush

@section('content')
<section class="landing-hero py-5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-7">
        <h1 class="title display-5 mb-3">QRPay — Fast, Secure, Global Payments</h1>
        <p class="lead mb-4">Accept and send money instantly with QR codes, APIs, and seamless checkout experiences.</p>
        <div class="d-flex gap-2 flex-wrap">
          <a href="{{ route('merchant.checkout.index') }}" class="btn btn-light text-primary fw-semibold">Try Checkout Demo</a>
          <a href="{{ route('developer.index') }}" class="btn btn-outline-light fw-semibold">View Developer Docs</a>
        </div>
      </div>
      <div class="col-lg-5 text-center">
        <img src="{{ get_fav($basic_settings ?? null) }}" alt="QRPay" class="img-fluid" style="max-height:140px">
      </div>
    </div>
  </div>
</section>

<section class="py-5 bg-light">
  <div class="container">
    <div class="row g-3">
      <div class="col-6 col-md-3">
        <div class="feature-card p-3 rounded h-100">
          <div class="fs-4 mb-2">⚡</div>
          <h6 class="mb-1">Instant</h6>
          <small class="text-muted">Real-time payments and QR checkout.</small>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="feature-card p-3 rounded h-100">
          <div class="fs-4 mb-2">🛡️</div>
          <h6 class="mb-1">Secure</h6>
          <small class="text-muted">AI fraud detection, 2FA & encryption.</small>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="feature-card p-3 rounded h-100">
          <div class="fs-4 mb-2">🌎</div>
          <h6 class="mb-1">Global</h6>
          <small class="text-muted">Multi-currency & cross-border support.</small>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="feature-card p-3 rounded h-100">
          <div class="fs-4 mb-2">🔗</div>
          <h6 class="mb-1">APIs</h6>
          <small class="text-muted">Simple integrations for your apps.</small>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-5">
  <div class="container text-center">
    <p class="mb-2 text-muted">Get started now</p>
    <a class="btn btn-primary" href="{{ route('merchant.checkout.index') }}">Launch QRPay Demo</a>
  </div>
</section>
@endsection

@push('script')
@endpush
