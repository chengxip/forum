@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create a Thread</div>

                <div class="panel-body">
                    <form method="post" action="/threads">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="Channel">Channel</label>
                            <select name="channel_id" id="channel" class="form-control">
                                <option value="">Select one</option>
                                @foreach ($channels as $channel)
                                <option value="{{$channel->id}}" {{ old('channel_id')== $channel->id ? 'selected':'' }}>{{$channel->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="{{ old('title') }}">
                        </div>

                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea class="form-control" name="body" id="body" rows="8">{{ old('body') }}</textarea>
                        </div>
                        <div class="form-group">
                        <button class="btn btn-primary" type="submit">Publish</button>
                        </div>
                        @include('layouts.errors')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
