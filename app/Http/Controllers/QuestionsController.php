<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestion;
use App\Question;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth')->only('create');
    }

    public function index()
    {

//        \DB::enableQueryLog();
        $questions= Question::with('user')->latest()->paginate(5);


        return view('questions.index', ['questions' => $questions]);

//        view('questions.index', ['questions' => $questions])->render();

//        dd(\DB::getQueryLog());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $question= new Question();

        return view('questions.create', ['question' => $question]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestion $request)
    {
//        $validated = $request->validated();

        $request->user()->questions()->create($request->all());

//        auth()->user()->questions()->create($validated);
        return redirect('questions')->with('success', 'Your question has been submited');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {

//        $question->increment('views');

        return view('questions.show', [ 'question' => $question]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {

        if (Gate::denies('update-question', $question)) {

            abort(403, "Access denied");
        }

        return view('questions.edit', ['question' => $question]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(StoreQuestion $request, Question $question)
    {
        $question->update($request->all());

        if ($request->expectsJson())
        {
            return response()->json([
                'message' => "Your question has been updated.",
                'body_html' => $question->body_html
            ]);
        }

        return redirect('/questions')->with('success' , 'Your question has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {

        if (Gate::denies('update-question', $question)) {

            abort(403, "Access denied");
        }

        $question->delete();

        if (request()->expectsJson())
        {
            return response()->json([
                'message' => "Your question has been deleted."
            ]);
        }

        return redirect('/questions')->with('success', "Your question has beedn deleted");
    }
}
