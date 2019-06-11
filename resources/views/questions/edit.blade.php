@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                        <div class="d-flex align-items-center">

                            <h2>Edit Question</h2>


                            <div class="ml-auto">
                                <a href="{{ route('questions.index') }}" class="btn btn-secondary">Back to all the Questions</a>
                            </div>

                        </div>

                    </div>

                    @include('errors')

                    <div class="card-body">

                        <form action="/questions/{{$question->id}}" method="post">

                            @method('PATCH')

                            @include("questions._form", ['buttonText' => 'Update Question'])

                        </form>

                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
