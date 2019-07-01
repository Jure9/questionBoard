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

                            @include('questions._question')

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
