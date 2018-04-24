<div class="card">
    <a href="{{ route('articles.show', $article) }}">
        <img src="{{ $article->cover?$article->cover:'/imgs/carousel-1.jpg' }}" alt="first" class="cover">
    </a>
    <div class="card-info" style="height: 80px; padding-bottom: 0;">
        <div class="row" style="margin-top: 10px">
            <div class="col-xs-12">
                <a href="{{ route('articles.show', $article) }}" class="card-info-title">{{ $article->excerpt }}</a>
            </div>

        </div>
        <div class="row" style="margin-top: 15px">
            <div class="col-xs-8 card-collect-time">
                <p class="text-left">收藏于 {{ $article->pivot->created_at->diffForHumans() }}</p>
            </div>
            <div class="col-xs-4 card-uncollect">
                <form action="{{ route('collections.destroy', $article) }}" method="post" class="uncollect-form">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                </form>
                <p class="text-right" id="card-uncollect-button">取消收藏</p>
            </div>
        </div>
    </div>
</div>