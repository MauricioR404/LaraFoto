<div class="card mb-4">
                    <div class="card-header">
                        <a href="{{ route('profile', ['id' => $image->user->id]) }}" class="enlace">
                            <img src="{{ route('user.avatar', ['filename' =>  $image->user->image ? $image->user->image : 'avatar.png'])}}" class="avatar">

                            {{ $image->user->name. ' ' . $image->user->surname }}
                            <span class="nick">| {{$image->user->nick}}</span>
                        </a>
                    </div>

                    <div class="card-body p-0">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 p-0">
                                        <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" class="img-fluid">
                                </div>
                                <div class="col-md-12 pt-3 elemento">
                                   <span class="sub">{{' @'. $image->user->nick . ' | '}}</span>
                                   <span class="sub">{{ \FormatTime::LongTimeFilter($image->created_at) }}</span>
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
                                    <a href="{{route('image.detail', ['id' => $image->id])}}" class="btn btn-warning boton">Comentarios {{ count($image->comments)}}</a>

                                </div>

                                <div class="col-md-12">
                                    <p class="py-3 m-0">
                                        {{ $image->description}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>