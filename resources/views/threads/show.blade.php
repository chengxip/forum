@extends('layouts.app')

@section('content')
<thread-view :initialCount="{{ $thread->replies_count }}" inline-template>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="level">
                        <span class="flex">
                    <a href="/profile/{{ $thread->creator->name }}">{{ $thread->creator->name }} </a> Post:
                    {{ $thread->title }}
                </span>
                @can ('update', $thread)
                    <form action="{{ $thread->path() }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-link">delete</button>
                    </form>
                    @endcan
                </div>

                </div>

                <div class="panel-body">
                    {{ $thread->body }} 
                </div>
            </div>

            <replies :data="{{ $thread->replies }}" @removed="repliesCount --"></replies>
            <!--

            @foreach ($replies as $reply)
                @include('threads.reply')
            @endforeach
            {{ $replies -> links() }}
            -->


                    </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <a href="#">{{ $thread->creator->name }}</a> Post at {{ $thread->created_at->diffForHumans() }} and with <span v-text="repliesCount"></span> comments
                </div>
            </div>

        </div>
    </div>
</div>
</thread-view>
@endsection
