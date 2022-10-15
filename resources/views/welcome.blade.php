@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($products as $product)
        <div class="col-md-4 mt-2">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{ $product->image_name }}" height="250" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">{{ $product->name }}</h5>
                  <p class="card-text">{{ $product->description }}</p>
                  
                </div>
                <div class="card-footer">
                   <add-to-cart product-id="{{ $product->id }}" user-id="{{ auth()->user()->id ?? 0 }}"/>
                </div>
              </div>
        </div>
        @endforeach
    </div>
</div>
@endsection