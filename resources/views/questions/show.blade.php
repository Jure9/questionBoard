@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">

                    <div class="card-body">
                        <div class="card-title">

                            <div class="d-flex align-items-center">

                                <h1>{{ $question->title }}</h1>


                                <div class="ml-auto">
                                    <a href="{{ route('questions.index') }}" class="btn btn-secondary">Back to all the
                                        Questions</a>
                                </div>

                            </div>

                        </div>

                        <hr>

                        <div class="media">

                            <vote :model="{{ $question }}" name="question"></vote>

                            <div class="media-body">
                                {!! $question->body_html !!}

                                <div class="float-right">
                                    {{--@include('includes._author', [--}}
                                            {{--'model' => $question,--}}
                                            {{--'label' => 'asked'--}}
                                    {{--])--}}

                                    <user-info :model="{{ $question }}" label="Asked"></user-info>

                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>

        <answers :question="{{ $question }}"></answers>

        @include('answers._create')
    </div>
@endsection
