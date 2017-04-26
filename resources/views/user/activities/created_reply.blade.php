@component('user.activities.activity')
@slot('heading')
<a href="#">{{ $profile->name }} </a> replied to thread
<a href="{{ $activity->subject->thread->path() }}">{{ $activity->subject->thread->title }}</a>
@endslot
@slot('body')
{{ $activity->subject->body }} 
@endslot
@endcomponent
