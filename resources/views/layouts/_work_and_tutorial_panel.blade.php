<div class="row page-background">
    <div class="col-xs-12">
        <div class="center-block" style="width: 1000px;">
            <div class="card-list">
                @if($articles->pluck('user_id')->contains(Auth::id()))
                    @foreach($articles as $article)
                        @include('articles._purchased_card_for_author', ['article' => $article])
                    @endforeach
                @else
                    @foreach($articles as $article)
                        @include('articles._purchased_card', ['article' => $article])
                    @endforeach
                @endif

                {{ $articles->links('') }}
            </div>
        </div>
    </div>
</div>