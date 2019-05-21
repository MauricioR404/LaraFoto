@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="row align-items-center">
            	<div class="col-md-4">
            		 @if($user->image)
		            	<img src="{{route('user.avatar', ['filename' => $user->image ? $user->image : 'avatar.png'])}}" class="perfil">
		            @endif
            	</div>
            	<div class="col-md-6">
            		<h1>{{'@'.$user->nick}}</h1>
            		<h2>{{$user->name. '' . $user->surname}}</h2>
            		<p>{{'Se unio:'.  \FormatTime::LongTimeFilter($user->created_at)}}</p>
            	</div>
            </div>

            @foreach($user->images as $image)
            	@include('includes.image', ['image' => $image])
            @endforeach
        </div>
    </div>
</div>
@endsection
