@extends('layouts.app')
@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="">
                <p>You will be charged ${{ number_format($product->price, 2) }} for {{ $product->name }} Product</p>
            </div>
            <div class="card"> -->
                <!-- <form action="{{ route('subscription.create') }}" method="post" id="payment-form">
                                       
                    <div class="form-group">
                        <div class="card-header">
                            <label for="card-element">
                                Enter your credit card information
                            </label>
                        </div>
                        <div class="card-body">
                            <div id="card-element">
                           
                            </div>
                           
                            <div id="card-errors" role="alert"></div>
                            <input type="hidden" name="product" value="{{ $product->id }}" />
                        </div>
                    </div>
                    <div class="card-footer">
                      <button
                      id="card-button"
                      class="btn btn-dark"
                      type="submit"
                     
                    > Pay </button>
                    </div>
                </form> -->
            <!-- </div>
        </div>
    </div>
</div> -->

<div class="container">
    
    <h1>You will be charged ${{ number_format($product->price, 2) }} for {{ $product->name }} Product</h1>
    <div class="card">
        <div class="row mt-3"  >
            <div class="col-md-6 col-md-offset-3 m-auto">
                <div class="panel panel-default credit-card-box">
                    <div class="panel-heading display-table" >
                            <h3 class="panel-title text-center" >Payment Details</h3>
                    </div>
                    <div class="panel-body">
        
                        <form 
                                role="form" 
                                action="{{ route('subscription.create') }}" 
                                method="post" 
                                class="require-validation"
                                id="payment-form">
                            <!-- @csrf -->

                            <div class='form-row row mt-3'>
                                <div class='col-xs-12 form-group required'>
                                    <label class='control-label'>Product Name</label> 
                                    <input class='form-control' type='text' name='product' readonly value= '{{ $product->name }}'/>
                                </div>
                            </div>
        
                            <div class='form-row row mt-3'>
                                <div class='col-xs-12 form-group required'>
                                    <label class='control-label'>Name on Card</label> 
                                    <input class='form-control' size='4'  type='text' name='name' />
                                    @if($errors)
                                        <p class="text-danger mb-0">{{$errors['name']}}</p>
                                    @endif
                                </div>
                            </div>
        
                            <div class='form-row row mt-3'>
                                <div class='col-xs-12 form-group  required'>
                                    <label class='control-label'>Card Number</label> 
                                    <input autocomplete='off' class='form-control card-number'  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                        maxlength = "16" type='number' name='card'  />
                                    @if($errors)
                                        <p class="text-danger mb-0">{{$errors['card']}}</p>
                                    @endif
                                </div>
                            </div>
        
                            <div class='form-row row mt-3' >
                                <div class='col-xs-12 col-md-4 form-group cvc required'>
                                    <label class='control-label'>CVC</label> 
                                    <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='3' maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type='number' name='cvv'  />
                                    @if($errors)
                                        <p class="text-danger mb-0">{{$errors['cvv']}}</p>
                                    @endif
                                </div>
                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                    <label class='control-label'>Expiration Month</label> 
                                    <input class='form-control card-expiry-month' placeholder='MM' size='2' maxlength="2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type='number' name='month' />
                                    @if($errors)
                                        <p class="text-danger mb-0">{{$errors['month']}}</p>
                                    @endif
                                </div>
                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                    <label class='control-label'>Expiration Year</label> <input
                                        class='form-control card-expiry-year' placeholder='YYYY' size='4' maxlength="4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                        type='number' name='year' />
                                    @if($errors)
                                        <p class="text-danger mb-0">{{$errors['year']}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-3 mb-3">
                                <div class="col-xs-12">
                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now</button>
                                </div>
                            </div>
                                
                        </form>
                    </div>
                </div>        
            </div>
        </div>  
    </div>
</div>

@endsection
