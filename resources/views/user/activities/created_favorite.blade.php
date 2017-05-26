@component('user.activities.activity')
@slot('heading')
    <a href="#">{{ $profile->name }} </a> Favorited thread
@endslot
@slot('body')
        {{ $activity->subject->body }} 
@endslot
@endcomponent
