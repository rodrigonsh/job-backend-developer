@extends('layout')

@section('content')

@if( $product->image_url )
<img src="{{ $product->image_url }}" id="image_url" />
@endif

<h2>{{$product->name}}</h2>

<p>
    ID: {{ $product->id }} || 
    Category: {{ $product->category }} || 
    Price: {{ $product->price }} || 
</p>

<p>{{ $product->description }}</p>

<a href="/" class='btn'>&lt;&lt; Voltar</a>

<style> 

    #image_url
    {
        display: block;
        width: 300px;
        margin-right: 32px;
        float: left;
    }

    .btn
    {
        display: inline-block;
        padding: 16px;
        color: black;
        text-decoration: none;
        background-color: #eee;
        border-radius: 5px;
        box-shadow: 0px 2px 2px black;
    }

</style>

@endsection