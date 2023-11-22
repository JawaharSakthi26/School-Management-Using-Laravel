@extends('layouts.auth')
@section('title', 'PreSkool | Checkout')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Checkout</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('pay-fees.index') }}">Plans</a></li>
                            <li class="breadcrumb-item active">Checkout</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form action="{{ route('pay-fees.store') }}" method="POST" id="subscribe-form">
                        @csrf
                        <input type="hidden" name="plan_id" value="{{ $plans->plan_id }}">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Enter Card Details</h5>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="subscription-option">
                                            <label for="plan-{{ $plans->id }}">
                                                <span
                                                    class="plan-name">{{ config('custom.plan_name')[$plans->name] }}</span>
                                                <br>
                                                <span
                                                    class="plan-price">&pound;{{ number_format($plans->amount, 2, '.', ',') }}<small>/{{ $plans->interval_count }}
                                                        {{ $plans->billing_method }}</small></span>
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="card-holder-name">Card Holder Name</label>
                                    <input id="card-holder-name" type="text" class="form-control">
                                </div>
                                <label for="card-element">Credit or debit card</label>
                                <div id="card-element" class="form-control">
                                </div>
                                <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button id="card-button" data-secret="{{ $intent->client_secret }}" class="btn btn-info">Process
                                Payment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        $(document).ready(function() {
            var stripe = Stripe('{{ env('STRIPE_KEY') }}');
            var elements = stripe.elements();
            var style = {
                base: {
                    color: '#32325d',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };

            var card = elements.create('card', {
                hidePostalCode: true,
                style: style
            });

            card.mount('#card-element');
            card.on('change', function(event) {
                var displayError = $('#card-errors');
                if (event.error) {
                    displayError.text(event.error.message);
                } else {
                    displayError.text('');
                }
            });

            const cardHolderName = $('#card-holder-name');
            const cardButton = $('#card-button');
            const clientSecret = cardButton.data('secret');

            cardButton.on('click', async function(e) {
                e.preventDefault();
                console.log("attempting");
                const {
                    setupIntent,
                    error
                } = await stripe.confirmCardSetup(clientSecret, {
                    payment_method: {
                        card: card,
                        billing_details: {
                            name: cardHolderName.val()
                        }
                    }
                });

                if (error) {
                    var errorElement = $('#card-errors');
                    errorElement.text(error.message);
                } else {
                    paymentMethodHandler(setupIntent.payment_method);
                }
            });

            function paymentMethodHandler(payment_method) {
                var form = $('#subscribe-form');
                var hiddenInput = $('<input>')
                    .attr('type', 'hidden')
                    .attr('name', 'payment_method')
                    .attr('value', payment_method);
                form.append(hiddenInput);
                form.submit();
            }
        });
    </script>
@endsection
