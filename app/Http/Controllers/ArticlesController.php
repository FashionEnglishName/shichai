<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Notifications\Refunded;
use Illuminate\Http\Request;
use App\Models\Article;
use Auth;
use App\Http\Requests\ArticleRequest;
use App\Handlers\ImageUploadHandler;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    public function create(Article $article){
        $categories = Category::all();
        return view('articles.create_and_edit', compact('article', 'categories'));
    }

    public function edit($id){
        $article = Article::find($id);
        $categories = Category::all();
        return view('articles.create_and_edit', compact('article', 'categories'));
    }

    public function show($id){
        $article = Article::find($id);
        $user = Auth::user();
        if(!$user->purchased_articles->pluck('id')->contains($id) && $user->id !== $article->user->id && $article->work_or_tutorial){
            $work = $article->work;
            return redirect()->route('articles.show', compact('work'))->with('error', '请先为作品添柴！');
        }
//        $this->authorize('canRead', $article);
        $firewood_sum = 0;
        foreach($article->purchaser->where('id', '=', Auth::id()) as $item){
            $firewood_sum += $item->pivot->firewood_count;
        }
        return view('articles.show',compact('article', 'firewood_sum'));
    }

    public function update($id, Request $request, ImageUploadHandler $uploader){
        dd($request);
        $article = Article::find($id);
        $data = $request->all();

//        $result = $uploader->save($request->cover, 'cover', $id, 1024);
//        if($result){
//            $data['cover'] = $result['path'];
//        }

        $article->update($data);
        return redirect()->route('articles.show', $id)->with('success', '修改成功！');
    }

    public function destroy($id){
        $article = Article::find($id);
        $article->delete();

        return redirect()->route('home')->with('success', '删除成功！');
    }

    public function store(ArticleRequest $request, Article $article, ImageUploadHandler $uploader){
        $data = $request->all();
        $id = Auth::id();
        $data['user_id'] = $id;

        $data['cover'] = $request->cover;

        $article->fill($data);
        $article->user_id = $data['user_id'];
        $article->save();

        return redirect()->route('articles.show', compact('article'))->with('success', '发布成功！');
    }

    public function uploadImage(Request $request, ImageUploadHandler $uploader){
        $data = [
            'success' => false,
            'msg' => '上传失败！',
            'file_path' => ''
        ];
        $result = [];

        if($file = $request->upload_file) {
            $result = $uploader->save($request->upload_file, 'articles', \Auth::id(), 1024);
        }
        if($result) {
            $data['success'] = true;
            $data['msg'] = '上传成功！';
            $data['file_path'] = $result['path'];
        }
        return $data;
    }

    public function uploadCover(Request $request){
        $path = uploadFileThumbnail($request->imgBase, 'cover', Auth::id(), 422, 316);
        return response()->json([
            'path' => $path
        ]);
    }



}
