<!--            主要内容             -->
<div class="row page-background">
    <div class="col-xs-12">
        <div class="center-block" style="width: 1000px;">
            <div class="card-list">
                @foreach($articles as $article)
                    @include('articles._normal_card', ['article' => $article])
                @endforeach
                {{ $articles->render() }}
            </div>
        </div>
    </div>
</div>