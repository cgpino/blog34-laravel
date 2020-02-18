<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Topic;
use Auth;

class TopicController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* TOPICS */

    // Lista todos los topics de forma ordenada
    public function list()
    {
        // Se obtienen los topics
        $topics = Topic::all();
        $title = __('back.topicList');
        return view('topic.list', compact('title', 'topics'));
    }

    // Detalle de un topic
    public function detail($pk)
    {
        // Se obtiene el topic especifico o devuelve un 404 si no lo encuentra
        $topic = Topic::findOrFail($pk);
        $title = __('back.topicDetail');
        return view('topic.detail', compact('topic', 'title'));
    }

    // Muestra el formulario para crear un topic
    public function create()
    {
        $title = __('back.createTopic');
        return view('topic.create', compact('title'));
    }

    // Almacena los datos del formulario y crea un topic
    public function store()
    {
        // Se verifican los datos del formulario
        $data = request()->validate([
            'name' => 'required',
        ]);

        // Se crea el topic
        Topic::create([
            'name' => $data['name'],
        ]);

        return redirect()->route('topic.list');
    }

    // Muestra el formulario para editar un topic
    public function edit($pk)
    {
        $title = __('back.editTopic');
        $topic = Topic::findOrFail($pk);
        return view('topic.edit', compact('title', 'topic'));
    }

    // Actualiza los datos de topic provenientes de formulario
    public function update($pk)
    {
        // Se verifican los datos del formulario
        $data = request()->validate([
            'name' => 'required',
        ]);

        $topic = Topic::findOrFail($pk);
        $topic->update(request()->all());
        return redirect()->route('topic.list');
    }

    // Elimina un topic
    public function delete($pk)
    {
        $topic = Topic::findOrFail($pk);
        $topic->delete();
        return redirect()->route('topic.list');
    }
}
