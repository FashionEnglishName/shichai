<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        return view('articles.show',compact('article'));
    }

    public function update($id, Request $request){
        $article = Article::find($id);
        $article->update($request->all());

        return redirect()->route('articles.show', $id)->with('success', '修改成功！');
    }

    public function destroy($id){
        $article = Article::find($id);
        $article->delete();

        return redirect()->route('home')->with('success', '删除成功！');
    }

    public function store(ArticleRequest $request, Article $article){
        $article->fill($request->all());
        $article->user_id = Auth::id();
        $article->save();

        return redirect()->route('articles.show', compact('article'))->with('success', '发布成功！');
    }

    public function uploadImage(Request $request, ImageUploadHandler $uploader){
        $data = [
            'success' => false,
            'msg' => '上传失败！',
            'file_path' => ''
        ];

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


}
