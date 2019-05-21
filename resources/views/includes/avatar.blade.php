@if( Auth::user()->image)
	<img src="{{ route('user.avatar', ['filename' =>  Auth::user()->image])}}" class="avatar">
@else
	<img src="{{ route('user.avatar', ['filename' =>  'avatar.png'])}}" class="avatar">
@endif