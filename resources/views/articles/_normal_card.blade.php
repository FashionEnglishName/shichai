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