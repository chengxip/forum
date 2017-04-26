<div class="panel panel-default">
    <div class="panel-heading">
        <div class="level">
            <h5 class="flex">
            <a href="/profile/{{ $reply->owner->name }}">{{ $reply->owner->name }} </a> Said {{ $reply->created_at->diffForHumans() }} ...
            </h5>
            <div>
                <form method="post" action="/reply/{{ $reply->id }}/favorite" >
                    {{ csrf_field() }}
                    <button type="submit"  class="btn btn-default" {{ $reply->isFavorited()?'disabled':'' }}> {{ $reply->favorite_count }} Favorite</button>
                </form>
            </div>
        </div>
    </div>
    <div class="panel-body">
        {{ $reply->body }} 
    </div>
</div>
