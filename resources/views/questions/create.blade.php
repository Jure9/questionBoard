@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                        <div class="d-flex align-items-center">

                            <h2>Ask a Question</h2>

                            @include('errors')


                            <div class="ml-auto">
                                <a href="{{ route('questions.index') }}" class="btn btn-secondary">Back to all the Questions</a>
                            </div>

                        </div>

                    </div>

                    <div class="card-body">

                        <form action="/questions" method="post">

                            @csrf

                            <div class="form-group">

                                <label for="question-title">Question Title</label>
                                <input type="text" name="title" id="question-title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}">

                            </div>

                            <div class="form-group">

                                <label for="question-body">Question</label>
                                <textarea name="body" id="question-body" cols="30" rows="10" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}">
                                </textarea>

                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-primary btn-lg">Ask a question</button>
                            </div>
                        </form>

                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
