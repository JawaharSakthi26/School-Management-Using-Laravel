@extends('layouts.auth')
@section('title', 'PreSkool | My Calendar')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <section class="pricing-section">
                <div class="container">
                    <div class="sec-title text-center">
                        <span class="title">Get plan</span>
                        <h2>Choose a Plan</h2>
                    </div>
                    <div class="row">
                        @foreach ($plans as $plan)
                            <div class="col-lg-4 mb-4">
                                <div class="pricing-block wow fadeInUp">
                                    <div class="inner-box">
                                        <div class="icon-box">
                                            <div class="icon-outer"><img src="{{ asset('assets/img/logo-small.png') }}" alt=""></div>
                                        </div>
                                        <div class="price-box">
                                            <div class="title">{{ config('custom.plan_name')[$plan->name] }}</div>
                                            <h4 class="price">&pound;{{ number_format($plan->amount, 2, '.', ',') }}</h4>
                                            <h6 class="period">{{ $plan->interval_count }} {{ $plan->billing_method }}</h6>
                                        </div>
                                        <div class="btn-box">
                                            <a href="{{route('pay-fees.show',$plan->plan_id)}}" class="theme-btn">Choose Plan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
