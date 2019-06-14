@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                        <div class="d-flex align-items-center">

                            <h2>All Questions</h2>

                            <div class="ml-auto">
                                <a href="{{ route('questions.create') }}" class="btn btn-secondary">Ask a Question</a>
                            </div>

                        </div>

                    </div>

                    <div class="card-body">

                        @include('messages')


                        @foreach($questions as $question)

                            <div class="media">

                                <div class="d-flex flex-column counters">

                                    <div class="vote">
                                        <strong>{{ $question->votes }}</strong> {{ Str::plural('vote', $question->votes) }}
                                    </div>

                                    <div class="status {{ $question->status }}">
                                        <strong>{{ $question->answers_count }}</strong> {{ Str::plural('answer', $question->answer) }}
                                    </div>

                                    <div class="view">
                                        {{ $question->views . ' ' . Str::plural('view', $question->views) }}
                                    </div>
                                </div>

                                <div class="media-body">

                                    <div class="d-flex align-items-center">
                                        <h3 class="mt-0">
                                            <a href="{{$question->url}}">{{  $question->title }}</a>
                                        </h3>
                                        <div class="ml-auto">

                                            @auth

                                                @if(Auth::user()->can('update-question', $question))

                                                    <a href="{{ route('questions.edit', $question->id) }}"
                                                       class="btn btn-sm btn-outline-info">Edit</a>

                                                @endif

                                                @if(Auth::user()->can('delete-question', $question))

                                                    <form class="form-delete" method="post"
                                                          action="/questions/{{ $question->id }}">

                                                        @method('DELETE')

                                                        @csrf

                                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                                onclick="return confirm('Are you sure?')">Delete
                                                        </button>

                                                    </form>

                                                @endif

                                            @endauth

                                        </div>
                                    </div>

                                    <p class="lead">
                                        Asked by <a href="{{$question->user->url}}"> {{ $question->user->name }}</a>
                                        <small class="text-muted">{{ $question->created_at->diffForHumans() }}</small>
                                    </p>

                                    {{ Str::limit($question->body, 250) }}

                                </div>
                            </div>

                            <hr>

                        @endforeach


                    </div>

                    <hr>

                    <div class="justify-content-center">
                        {{ $questions->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
