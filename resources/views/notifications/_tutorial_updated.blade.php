<div class="media">
    <div class="pull-left">
        <a href="{{ route('users.show', $notification->data['author_id']) }}">
            <img src="{{ $notification->data['author_avatar'] }}" alt="{{ $notification->data['author_id'] }}" class="avatar">
        </a>
    </div>
    <div class="infos">
        <div class="media-heading">
            <a href="{{ route('articles.show', $notification->data['tutorial_id']) }}">{{ $notification->data['tutorial_title'] }}</a>
            已被作者修改
            <span class="meta pull-right" title="{{ $notification->created_at }}">
                <span class="glyphicon glyphicon-clock" aria-hidden="true"></span>
                {{ $notification->created_at->diffForHumans() }}
            </span>
        </div>
    </div>
</div>
<hr>