<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save(Request $request)
    {
    	$validate = $this->validate($request, [
    		'image_id' => 'integer|required',
    		'content' => 'string|required'
    	]);

    	$user = \Auth::user();


        $id = $user->id;
    	$image_id = $request->input('image_id');
    	$content = $request->input('content');

    	//Asigno los valores a mi objecto
    	$comment = new Comment();
    	$comment->user_id = $id;
    	$comment->image_id = $image_id;
    	$comment->content = $content;

    	//Guardar en la db
    	$comment->save();

    	//Redireccion
    	return redirect()->route('image.detail', ['id' => $image_id])
    					 ->with([
    					 	'message' => 'Has publicado tu comentario'
    					 ]);
    }

    public function delete($id)
    {
        //Conseguir datos del usuario logueado
        $user = \Auth::user();
        //Conseguir objecto del comentario
        $comment = Comment::find($id);
        //Comprobar si soy el dueño del comentario o de la publicacion
        if($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id))
        {
            $comment->delete();

            return redirect()->route('image.detail', ['id' => $comment->image->id])
                         ->with([
                            'message' => 'Comentario eliminado!!'
                         ]);
        }else
        {
            return redirect()->route('image.detail', ['id' => $comment->image->id])
                         ->with([
                            'message' => 'El comentario no se ha eliminado'
                         ]);
        }
    }

}
