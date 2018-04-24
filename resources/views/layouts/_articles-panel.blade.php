<!--            主要内容             -->
<div class="row page-background">
    <div class="col-xs-12">
        <div class="center-block" style="width: 1000px;">
            <div class="card-list">
                @if(isset($type))
                    @if($type === 'collections')
                        @foreach($articles as $article)
                            @include('articles._collection_card', ['article' => $article])
                        @endforeach
                    @endif
                 @else
                    @foreach($articles as $article)
                        @include('articles._normal_card', ['article' => $article])
                    @endforeach
                @endif
                {{ $articles->render() }}
            </div>
        </div>
    </div>
</div>