@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Get Customer Quote</div>
                <form class="get-customer-quote-form" method="POST">
                    <div class="card-body reponse-body">
                        <ul class="response-list"></ul>
                    </div>
                    <div class="card-body">
                        <label for="email" class="email">E-Mail</label><br>
                        <input class="input-type form-control input-email" type="text" name="email" value=""> <br> 

                        <button type="submit" class="submit-customer-quote btn btn-info">Get Quote</button>
                    </div>
                    <div class="card-body quote-result-body">
                        <ul class="quote-response-list"></ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection