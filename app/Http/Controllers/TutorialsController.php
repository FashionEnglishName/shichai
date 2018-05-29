<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Models\Article;
use App\Notifications\TutorialPublished;
use App\Notifications\TutorialUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TutorialsController extends Controller
{
    public function index(){
        $user = Auth::user();
        $type = 'index';
        $articles = $user->articles()->where('work_or_tutorial', '=', 0)->orderBy('is_assigned', 'desc')->orderBy('created_at', 'desc')->paginate(20);
        return view('tutorials.index', compact('articles', 'type'));
    }

    public function finished() {
        $user = Auth::user();
        $type = 'finished';
        $articles = $user->articles()->where('tutorial_id', '>', 0)->orderBy('created_at', 'desc')->paginate(20);
        return view('tutorials.index', compact('articles', 'type'));
    }

    public function waiting() {
        $user = Auth::user();
        $type = 'waiting';
        $articles = $user->articles()->where([
            ['firewood_count', '>', 0],
            ['tutorial_id', '=', null]
            ])->orderBy('created_at', 'desc')->paginate(20);
        return view('tutorials.index', compact('articles', 'type'));
    }

    public function unfired(){
        $user = Auth::user();
        $type = 'unfired';
        $articles = $user->articles()->where('firewood_count', '0')->orderBy('created_at', 'desc')->paginate(20);
        return view('tutorials.index', compact('articles', 'type'));
    }

    public function create($id){
        $article = Article::find($id);
        return view('tutorials.create_and_edit', compact('article'));
    }

    public function store($work_id, Request $request, ImageUploadHandler $uploader){
        $work = Article::find($work_id);
        $tutorial = new Article();
        $tutorial->fill($request->all());
        $tutorial->firewood_count = $work->firewood_count;
        $tutorial->work_or_tutorial = 1;
        $tutorial->work_id = $work->id;
        $tutorial->user_id = $work->user_id;
        $tutorial->category_id = $work->category_id;
        $tutorial->save();
        $work->tutorial_id = $tutorial->id;
        $work->save();
        $tutorial->hasSamePurchaser($work);
        $author = $work->user;
        $users = $work->purchaser;
        foreach($users as $user){
            $user->notify(new TutorialPublished($work, $tutorial, $author));
        }
        // 转移与文章等量的firewood到作者上
        $author->firewood_count += $work->firewood_count;
        $author->save();
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

        foreach($users as $user){
            $user->notify(new TutorialUpdated($tutorial, $author));
        }
        return redirect()->route('articles.show', compact('tutorial'))->with('success', '编辑成功');
    }
}
