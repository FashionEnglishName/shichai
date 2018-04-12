<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Notifications\TutorialPublished;
use App\Notifications\TutorialUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TutorialsController extends Controller
{
    public function index(){
        $user = Auth::user();
        $assigned_works = $user->articles()->where('is_assigned', '=', 1)->paginate(20);
        return view('main-pages.tutorials', compact('assigned_works'));
    }

    public function create($id){
        $article = Article::find($id);
        return view('tutorials.create_and_edit', compact('article'));
    }

    public function store($work_id, Request $request){
        $work = Article::find($work_id);
        $tutorial = new Article();
        $tutorial->fill($request->all());
        $tutorial->firewood_count = $work->firewood_count;
        $tutorial->purchaser = $work->purchaser;
        $tutorial->work_or_tutorial = 1;
        $tutorial->work_id = $work->id;
        $tutorial->user_id = $work->user_id;
        $tutorial->category_id = $work->category_id;
        $tutorial->save();
        $work->tutorial_id = $tutorial->id;
        $work->save();
        $author = $work->user;
        $users = $work->purchaser;
        foreach($users as $user){
            $user->notify(new TutorialPublished($work, $tutorial, $author));
        }
        return redirect()->route('articles.show', compact('tutorial'));
    }

    public function edit($tutorial_id){
        $article = Article::find($tutorial_id);
        return view('tutorials.create_and_edit', compact('article'));
    }

    public function update($tutorial_id, Request $request){
        $tutorial = Article::find($tutorial_id);
        $tutorial->update($request->all());

        $author = $tutorial->user;
        $users = $tutorial->purchaser;
        dd($users);

        foreach($users as $user){
            $user->notify(new TutorialUpdated($tutorial, $author));
        }
        return redirect()->route('articles.show', compact('tutorial'));
    }
}
