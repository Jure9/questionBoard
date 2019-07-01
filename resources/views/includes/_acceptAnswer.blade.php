@can('acceptBest', $model)
    <a title="Mark this answer as best"
       class="{{ $model->status }} mt-2"
       onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $model->id }}').submit();"
    >
        <i class="fas fa-check fa-2x"></i>
    </a>
    <form action="/answers/{{ $model->id }}/accept"
          id="accept-answer-{{ $model->id }}" method="post" style="display: none">

        @csrf

    </form>

@else

    @if($model->is_best)

        <a title="Mark this answer as best"
           class="{{ $model->status }} mt-2">
            <i class="fas fa-check fa-2x"></i>

        </a>
    @endif

@endcan