@component('user.activities.activity')
@slot('heading')

                <a href="#">{{ $profile->name }} </a> publish thread
                <a href="{{ $activity->subject->path() }}">{{ $activity->subject->title }}</a>
@endslot
@slot('body')
        {{ $activity->subject->body }} 
@endslot
@endcomponent
