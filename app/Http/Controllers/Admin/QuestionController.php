<?php

namespace App\Http\Controllers\Admin;

use App\Models\Question;
use App\Models\Test;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
include(app_path('Constants\Constants.php'));

class QuestionController extends Controller
{
    protected function create_answers($answers, $question)
    {
        foreach ($answers as $answer) {
            if ($question->type_id != QUESTION_TYPE_SINGLE_ANSWER)
                $is_correct = boolval($answer['isCorrect'] ?? 0);
            else
                $is_correct = true;
            $question->answers()->create([
                'text' => $answer['text'],
                'is_correct' => $is_correct
            ]);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Models\Test $test
     * @return \Illuminate\Http\Response
     */
    public function create(Test $test)
    {
        return view('admin.question.create', compact('test'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Test $test
     * @return void
     */
    public function store(Request $request, Test $test)
    {
        /** @var Question $question */
        $question = $test->questions()->create($request->only(['text', 'type_id']));
        $this->create_answers($request->get('answer'),$question);

        return redirect()->back()->with('message', 'Вопрос добавлен!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public
    function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public
    function edit(Question $question)
    {
        return view('admin.question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, Question $question)
    {
        $question->update($request->only(['text', 'type_id']));
        $question->answers()->delete();
        $this->create_answers($request->get('answer'),$question);

        return redirect()->back()->with('message', 'Вопрос обновлён!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public
    function destroy(Question $question)
    {
        $question->delete();

        return redirect(action('Admin\TestController@edit',$question->test))->with('message', 'Вопрос удалён');
    }
}
