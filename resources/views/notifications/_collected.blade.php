<div class="media">
    <div class="pull-left">
        <a href="{{ route('users.show', $notification->data['user_id']) }}">
            <img src="{{ $notification->data['user_avatar'] }}" alt="{{ $notification->data['user_id'] }}">
        </a>
    </div>
    <div class="infos">
        <div class="media-heading">
            <a href="{{ route('users.show', $notification->data['user_id']) }}">{{ $notification->data['user_name'] }}</a>
            收藏了你的文章
            <a href="{{ route('articles.show', $notification->data['article_id']) }}">{{ $notification->data['article_title'] }}</a>
            <span class="meta pull-right" title="{{ $notification->created_at }}">
                <span class="glyphicon glyphicon-clock" aria-hidden="true"></span>
                {{ $notification->created_at->diffForHumans() }}
            </span>
        </div>
    </div>
</div>
<hr>