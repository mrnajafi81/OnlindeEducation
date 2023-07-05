<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Lesson;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Lesson $lesson)
    {
        return view('admin.questions.index', compact('lesson'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Lesson $lesson)
    {
        return view('admin.questions.create', compact('lesson'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionRequest $request)
    {
        // get lesson that this question belongs to it
        $lesson = Lesson::findOrFail($request->lesson_id);

        Question::create([
            'lesson_id' => $lesson->id,
            'question_text' => $request->question_text,
            'option1' => $request->option1,
            'option2' => $request->option2,
            'option3' => $request->option3,
            'option4' => $request->option4,
            'answer' => $request->answer,
            'score' => $request->score,
        ]);

        return redirect(route('questions.index', $lesson->id))->with('success', 'سوال با موفقیت اضافه شد');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        return view('admin.questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        $question->update([
            'lesson_id' => $question->lesson_id,
            'question_text' => $request->question_text,
            'option1' => $request->option1,
            'option2' => $request->option2,
            'option3' => $request->option3,
            'option4' => $request->option4,
            'answer' => $request->answer,
            'score' => $request->score,
        ]);

        return redirect(route('questions.index', $question->lesson_id))->with('success', 'سوال با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();

        return back()->with('warning', 'سوال با موفقیت حذف شد');
    }
}
