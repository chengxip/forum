@extends('layouts.app')

@section('content')
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

            @foreach ($replies as $reply)
                @include('threads.reply')
            @endforeach
            {{ $replies -> links() }}

            @if (auth()->check())
            <form method="post" action="{{$thread->path().'/reply'}}">
                {{ csrf_field() }}
                <div class="form-group">
                    <textarea name="body" placeholder="Have something to say" class="form-control" rows="5" ></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            @else
            <p class="text-center"> Please <a href="{{ route('login') }}"> Sign in </a> to participate in this discussions.
            @endif
        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <a href="#">{{ $thread->creator->name }}</a> Post at {{ $thread->created_at->diffForHumans() }} and with {{ $thread->replies_count }} comments
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
