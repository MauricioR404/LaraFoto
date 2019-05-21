@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @include('includes.message')
            {{-- dd($images)--}}

            @foreach($images as $image)
                @include('includes.image', ['image' => $image])
            @endforeach
        </div>
        <div class="col-md-8 ">
            <div class="clearfix d-flex justify-content-end">
                {{$images->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
