@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">

                    <div class="card-body">
                        <div class="card-title">

                            <div class="d-flex align-items-center">

                                <h1 >{{ $question->title }}</h1>


                                <div class="ml-auto">
                                    <a href="{{ route('questions.index') }}" class="btn btn-secondary">Back to all the
                                        Questions</a>
                                </div>

                            </div>

                        </div>

                        <hr>

                        <div class="media">

                            <div class="d-flex flex-column vote-controls">
                                <a title="" class="vote-up">
                                    <i class="fas fa-caret-up fa-3x"></i>

                                </a>
                                <span class="votes-count">1234</span>
                                <a title="this question is not useful" class="vote-down off">
                                    <i class="fas fa-caret-down fa-3x"></i>
                                </a>

                                <a title="Click to mark as favourite question" class="favourite mt-2 favourited">
                                    <i class="fas fa-star fa-2x"></i>
                                    <span class="favourites-count">123</span>
                                </a>
                            </div>

                            <div class="media-body">
                                {!! $question->body_html !!}

                                <div class="float-right">
                                    <span class="text-muted">Answered {{ $question->created_at->diffForHumans() }}</span>
                                    <div class="media mt-2">
                                        <a href="{{ $question->user->url }}" class="pr-2">
                                            <img src="{{ $question->user->avatar }}" alt="avatar">
                                        </a>
                                        <div class="media-body mt-1">
                                            <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>

        @include('answers._index', [
        'answers' => $question->answers,
        'answersCount' => $question->answers_count
        ])

        @include('answers._create')
    </div>
@endsection
