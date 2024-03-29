@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="page-header">
                <h1>
                    {{ $profile->name }} <small> Since {{ $profile->created_at->diffForHumans() }} </small>

                </h1>
            </div>
            @foreach ($activities as $date=> $activity)
            <p>{{ $date }}</p>
                @foreach ($activity as $record)
                @include("user.activities.{$record->type}", ['activity'=>$record])
                @endforeach
            @endforeach

        </div>
    </div>
</div>
@endsection
