@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            @include('includes.message')
            {{-- dd($images)--}}


                <div class="card mb-4">
                    <div class="card-header">

                            <img src="{{ route('user.avatar', ['filename' =>  $image->user->image ? $image->user->image : 'avatar.png'])}}" class="avatar">

                        {{ $image->user->name. ' ' . $image->user->surname }}
                        <span class="nick">| {{$image->user->nick}}</span>
                    </div>

                    <div class="card-body p-0">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 p-0">
                                        <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" class="img-fluid">
                                </div>
                                <div class="col-md-12">
                                    {{count($image->likes)}}
                                    <!-- Comprobar si el usuario le dio like a la imagen -->
                                    <?php $user_like = false; ?>
                                    @foreach($image->likes as $like)
                                        @if($image->user->id)
                                            <?php $user_like = true; ?>
                                        @endif
                                    @endforeach

                                    @if($user_like)
                                        <img src=" {{ asset('img/dos.png')}}" data-id="{{$image->id}}" class="btn-dislike corazon">
                                    @else
                                        <img src=" {{ asset('img/uno.png')}}" data-id="{{$image->id}}" class="btn-like corazon">
                                    @endif
                                    <a href="" class="btn btn-warning boton">Comentarios {{ count($image->comments)}}</a>

                                </div>
                                <div class="col-md-12">
                                    @if(Auth::user() && Auth::user()->id == $image->user->id)
                                        <a href="{{ route('image.edit', ['id' => $image->id]) }}" class="btn btn-sm btn-primary">Actualizar</a>
                                        <a href="" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal">Borrar</a>
                                    @endif
                                </div>
                                <div class="col-md-12 pb-3 text-right">
                                    <p class="py-3 m-0 text-left">
                                        {{ $image->description}}
                                    </p>
                                    <h2 class="text-left">Comentarios {{ count($image->comments)}}</h2>
                                    <hr>

                                    <form method="POST" action="{{ route('comment.save') }}">
                                        @csrf

                                        <input type="hidden" name="image_id" value="{{$image->id}}">
                                        <p>
                                            <textarea class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" ></textarea>

                                            @if ($errors->has('content'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('content') }}</strong>
                                                </span>
                                            @endif
                                        </p>
                                        <button type="submit" class="btn btn-success">Comentar</button>
                                    </form>
                                </div>

                                @foreach($image->comments as $comment)
                                    <div class="col-md-12">
                                        <hr>
                                        <img src="{{route('user.avatar', ['filename' => $comment->user->image])}}" class="avatar">
                                        <span class="nick">{{'@'.$comment->user->nick}} {{'| '.\FormatTime::LongTimeFilter($comment->created_at)}}</span>
                                        <p>
                                            {{$comment->content}}
                                            @if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                                            <a href="{{ route('comment.delete', ['id' => $comment->id]) }}" class="btn btn-sm btn-danger">Eliminar</a>
                                            @endif
                                        </p>
                                        <hr>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Si continuas ya no podras recuperar, ¿Estas seguro?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <a href="{{ route('image.delete', ['id' => $image->id]) }}" class="btn btn-primary">Borrar</a>
      </div>
    </div>
  </div>
</div>
@endsection
