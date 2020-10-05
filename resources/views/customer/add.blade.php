@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Customer</div>
                <form class="new-customer-form" method="POST">
                    <div class="card-body reponse-body">
                        <ul class="response-list"></ul>
                    </div>
                    <div class="card-body">
                        <label for="name" class="name">Name:</label><br>
                        <input class="input-type form-control input-name" type="text" name="name" value=""> <br>
                        <label for="email" class="email">E-Mail</label><br>
                        <input class="input-type form-control input-email" type="text" name="email" value=""> <br>
                        <label for="premium-price" class="premium-price">Premium Price</label><br>
                        <input class="input-type form-control input-premium-price" type="input" name="premium_price" value=""> <br>    

                        <button type="button" class="btn btn-default"><a href="/home"> Cancel </a></button>
                        <button type="submit" class="submit-add-customer btn btn-info">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection