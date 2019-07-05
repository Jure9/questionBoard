@if($model instanceof App\Question)

    @php

        $name= 'question';
        $firstURISegment= 'questions';

    @endphp

@else

    @php

        $name= 'answer';
        $firstURISegment= 'answers';

    @endphp

@endif

<div class="d-flex flex-column vote-controls">
    <a title="This {{ $name }} is useful"
       class="vote-up {{ Auth::guest() ? 'off' : '' }}"
       onclick="event.preventDefault(); document.getElementById('up-vote-{{ $name }}-{{ $model->id }}').submit();"
    >
        <i class="fas fa-caret-up fa-3x"></i>

    </a>

    <form action="/{{ $firstURISegment }}/{{ $model->id }}/vote"
          id="up-vote-{{ $name }}-{{ $model->id }}" method="post" style="display: none">

        @csrf

        <input type="hidden" name="vote" value="1">

    </form>

    <span class="votes-count">{{ $model->votes_count }}</span>

    <a title="this {{ $name }} is not useful"
       class="vote-down {{ Auth::guest() ? 'off' : '' }}"
       onclick="event.preventDefault(); document.getElementById('down-vote-{{ $name }}-{{ $model->id }}').submit();"
    >
        <i class="fas fa-caret-down fa-3x"></i>
    </a>

    <form action="/{{ $firstURISegment }}/{{ $model->id }}/vote"
          id="down-vote-{{ $name }}-{{ $model->id }}" method="post" style="display: none">

        @csrf

        <input type="hidden" name="vote" value="-1">

    </form>

    @if($model instanceof App\Question)

        <favourite :question="{{ $model }}"></favourite>

    @elseif($model instanceof App\Answer)

        {{--@include('includes._acceptAnswer', [--}}
            {{--'model' => $model--}}
        {{--])--}}
<<<<<<< HEAD
=======

        <accept :answer="{{ $model }}"></accept>
>>>>>>> rewrite/auth-logic

        <accept :answer=" {{ $model }} "></accept>
    @endif

</div>
