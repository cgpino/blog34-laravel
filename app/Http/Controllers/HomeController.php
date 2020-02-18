<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Traits\UploadTrait;
use App\User;
use App\Post;
use App\Topic;
use App\Comment;
use Auth;

class HomeController extends Controller
{

    use UploadTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* POSTS */

    // Lista todos los posts de forma ordenada
    public function index()
    {
        // Se obtienen los posts ordenados por fecha descendente
        $posts = Post::orderBy('created_at', 'desc')->paginate(2);
        $title = __('back.postList');
        return view('home', compact('title', 'posts'));
    }

    // Detalle de un post
    public function detail($pk)
    {
        // Se obtiene el post especifico o devuelve un 404 si no lo encuentra
        $post = Post::findOrFail($pk);
        return view('detail', compact('post'));
    }

    // Muestra el formulario para crear un post
    public function create()
    {
        $title = __('back.createPost');

        // Se obtienen todas las categorias para mostrarlas al usuario
        $topics = Topic::all();
        return view('create', compact('title', 'topics'));
    }

    // Almacena los datos del formulario y crea un post
    public function store()
    {
        // Se obtiene el usuario autenticado
        $user = Auth::user();

        // Se verifican los datos del formulario
        $data = request()->validate([
            'title' => 'required',
            'topic' => 'required',
            'image' => 'nullable',
            'body' => 'required',
        ]);

        $filePath = null;

        // Subir imagen
        if (request()->has('image')) {
            $image = request()->file('image');
            $name = Str::slug(request()->input('name')).'_'.time();
            $folder = '/uploads/images/';
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);
        }

        // Se crea el post
        Post::create([
            'title' => $data['title'],
            'body' => $data['body'],
            'user_id' => $user->id,
            'topic_id' => $data['topic'],
            'image_url' => $filePath
        ]);

        return redirect()->route('home');
    }

    // Muestra el formulario para editar un post
    public function edit($pk)
    {
        $title = __('back.editPost');
        $post = Post::findOrFail($pk);

        // Se obtienen todas las categorias para mostrarlas al usuario
        $topics = Topic::all();
        return view('edit', compact('title', 'post', 'topics'));
    }

    // Actualiza los datos de post provenientes de formulario
    public function update($pk)
    {
        // Se verifican los datos del formulario
        $data = request()->validate([
            'title' => 'required',
            'topic' => 'required',
            'image' => 'nullable',
            'body' => 'required',
        ]);

        $post = Post::findOrFail($pk);

        // Subir imagen
        if (request()->has('image')) {
            $image = request()->file('image');
            $name = Str::slug(request()->input('name')).'_'.time();
            $folder = '/uploads/images/';
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);

            // Actualizar url de imagen
            $post->image_url = $filePath;
        }

        $post->title = $data['title'];
        $post->body = $data['body'];
        $post->topic_id = $data['topic'];
        $post->save();

        return redirect()->route('detail', ['pk' => $pk]);
    }

    // Elimina un post
    public function delete($pk)
    {
        $post = Post::findOrFail($pk);
        $post->delete();
        return redirect()->route('home');
    }

    /* COMENTARIOS */

    // Crea un comentario
    public function commentate($pk)
    {
        // Se verifican los datos del formulario
        $data = request()->validate([
            'body' => 'required',
        ]);

        // Se obtiene el post donde enviar el mensaje
        $post = Post::findOrFail($pk);

        // Se obtiene el usuario autenticado
        $user = Auth::user();

        // Se crea el comentario
        Comment::create([
            'body' => $data['body'],
            'user_id' => $user->id,
            'post_id' => $post->id
        ]);

        return redirect()->route('detail', ['pk' => $pk]);
    }

    // Elimina un comentario
    public function deleteComment($pk)
    {
        $comment = Comment::findOrFail($pk);

        $post_id = $comment->post->id;

        $comment->delete();
        return redirect()->route('detail', ['pk' => $post_id]);
    }

}
