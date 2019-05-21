@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1>Gente</h1>
            <form method="GET" action="{{ route('user.index') }}" id="buscador">
               <div class="row justify-content-center">
                    <div class="form-group col">
                        <input type="text" id="search" class="form-control">
                    </div>
                    <div class="form-group col">
                        <input type="submit" value="Buscar" class="btn btn-success">
                    </div>
               </div>
            </form>

            @foreach($users as $user)
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
                        <a href="{{ route('profile', ['id' => $user->id])}}" class="btn btn-outline-secondary">Ver perfil</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-8 ">
            <div class="clearfix d-flex justify-content-end">
                {{$users->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
