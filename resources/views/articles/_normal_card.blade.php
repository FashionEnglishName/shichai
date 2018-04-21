<div class="card">
    <a href="{{ route('articles.show', $article) }}">
        <img src="{{ $article->cover?$article->cover:'/imgs/carousel-1.jpg' }}" alt="first" class="cover">
    </a>
    <div class="card-info">
        <div class="row">
            <div class="col-xs-12">
                <a href="{{ route('articles.show', $article) }}" class="card-info-title">{{ $article->excerpt }}</a>
            </div>
            <div class="col-xs-12 card-info-title-small">
                <a href="{{ route('category', $article->category) }}">{{ str_replace_array('　', ['', ''], $article->category->name )}}</a>
                丨
                {{ $article->created_at->diffForHumans() }}
            </div>
        </div>
        <div class="row card-avatar-row">
            <div class="col-xs-12">
                <a href="{{ route('users.show', $article->user) }}">
                    <img src="{{ $article->user->avatar }}" class="avatar avatar-sm"> <span>{{ $article->user->name }}</span>
                </a>
            </div>
        </div>
        <div class="row article-info-row" >
            <div class="col-xs-4" title="被收藏{{ $article->collection_count }}次"><p style="margin-bottom: 0;" class="text-center"><span class="glyphicon glyphicon-star"></span><span style="position: relative; bottom: 1px;">{{ $article->collection_count }}</span></p></div>
            <div class="col-xs-4" title="已有{{ $article->firewood_count }}根柴火"><p style="margin-bottom: 0;" class="text-center"><span class="glyphicon glyphicon-fire"></span><span style="position: relative; bottom: 1px;">{{ $article->firewood_count }}</span></p></div>
            <div class="col-xs-4" title="{{ $article->tutorial_id ? "已有教程" : "教程未出" }}"><p style="margin-bottom: 0;" class="text-center"><span class="glyphicon glyphicon-book"></span>&nbsp;@if($article->tutorial_id)<span style="position: relative; bottom: 3px; font-size:11px;">√</span>@else<span style="position: relative; bottom: 1px; font-size:12px;">X</span>@endif</p></div>
        </div>
    </div>
</div>