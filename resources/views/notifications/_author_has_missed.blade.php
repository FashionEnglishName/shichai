<div class="media">
    <div class="pull-left">
        <a href="{{ route('users.show', $notification->data['author_id']) }}">
            <img src="{{ $notification->data['author_avatar'] }}" alt="{{ $notification->data['author_id'] }}" class="avatar">
        </a>
    </div>
    <div class="infos">
        <div class="media-heading">
            <a href="{{ route('users.show', $notification->data['author_id']) }}">{{ $notification->data['author_name'] }}</a>
            已经错过了制作<a href="{{ route('articles.show', $notification->data['article_id']) }}">{{ $notification->data['article_title'] }}</a>的截止日期，柴火已经退还到您的账户上
            <span class="meta pull-right" title="{{ $notification->created_at }}">
                <span class="glyphicon glyphicon-clock" aria-hidden="true"></span>
                {{ $notification->created_at->diffForHumans() }}
            </span>
        </div>
    </div>
</div>
<hr>