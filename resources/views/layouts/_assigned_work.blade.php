<div class="meida">
    <div class="infos">
        <div class="media-heading">
            <a href="{{ $assigned_work->tutorial_id ? route('articles.show', $assigned_work->tutorial_id ) : route('tutorials.create', $assigned_work->id) }}">{{ $assigned_work->title }}</a>
            <span class="meta pull-right" title="{{ $assigned_work->assigned_at }}">
                <span class="glyphicon glyphicon-clock" aria-hidden="true"></span>
                {{ $assigned_work->updated_at->diffForHumans() }}
            </span>
        </div>
    </div>
</div>
<hr>