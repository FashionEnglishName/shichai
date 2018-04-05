<!--            主要内容             -->
<div class="row page-background">
    <div class="col-xs-12">
        <div class="center-block" style="width: 1000px;">
            <div class="card-list">
                @foreach($articles as $article)
                    <div class="card">
                        <a href="{{ route('articles.show', $article) }}">
                            <img src="{{ $article->cover?$article->cover:'/imgs/carousel-1.jpg' }}" alt="first">
                        </a>
                        <div class="card-info">
                            <h5 class="card-info-title">
                                <a href="{{ route('articles.show', $article) }}">{{ $article->excerpt }}</a>
                                <br>
                                <small><a href="{{ route('category', $article->category) }}">{{ str_replace_array('　', ['', ''], $article->category->name )}}</a></small>
                            </h5>
                            <p class="text-right lead"><span class="card-info-sales">{{ $article->firewood_count }}</span>根柴火</p>
                        </div>
                    </div>
                @endforeach
                {{ $articles->render() }}
            </div>
        </div>
    </div>
</div>