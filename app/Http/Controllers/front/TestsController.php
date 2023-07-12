<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Test;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TestsController extends Controller
{
    public function index(Request $request, Lesson $lesson)
    {
        //گرفتن کاربر لاگین کرده
        $user = auth()->user();

        //چک کردن اینکه کاربر دوره را خریده
        $userHasBoughtCourse = $user->courses()->wherePivot('course_id', $lesson->course->id)->first() ? true : false;
        if (!$userHasBoughtCourse)
            return redirect(route('front.course', $lesson->course->id));

        //چک کردن اینکه کاربر محتوای درس را مشاهده کرده باشد و سپس آزمون دهد.
        if (!$request->cookie('lesson' . $lesson->id, false))
            return redirect(route('front.lessons', $lesson->id))->withErrors('قبل از انجام آزمون باید محتوای درس را مشاهده کرده باشد.');

        //چک کردن اینکه گروه آموزشی فعال باشد
        $enableGroupe = $lesson->course->groups()->where('ended_at', '>=', Carbon::now())->first();
        if (!$enableGroupe) {
            return redirect(route('front.lessons', $lesson->id))->withErrors('زمان پاسخ دادن به آزمون های این دوره تمام شده است.');
        }

        // سپس چک کردن اینکه گروه آموزشی کاربر با گروه فعال حال حاضر یکی باشد
        $userGroup = $user->groups()->wherePivot('course_id', $lesson->course->id)->first();
        if (!($userGroup && $userGroup->id == $enableGroupe->id))
            return redirect(route('front.lessons', $lesson->id))->withErrors('زمان پاسخ دادن به آزمون های این دوره تمام شده است.');


        //هر کاربر فقط سه بار می تواند در آزمون شرکت کند
        $userNumberOfDoTest = auth()->user()->tests()->where('lesson_id', $lesson->id)->count();
        if ($userNumberOfDoTest >= 3)
            return redirect(route('front.lessons', $lesson->id))->withErrors('شما قبلا در سه بار در این آزمون شرکت کرده اید.');


        //چک کردن اینکه کاربر حتما نمره قبولی آزمون درس قبل را کسب کرده باشد(درصورتی که این درس اولین درس نباشد)//
        //گرفتن درس قبلی
        $previous_lesson = Lesson::where('order', '<', $lesson->order)->orderBy('order', 'desc')->first();

        //چک کردن اینکه درس قبلی وجود داشته باشد (این درس اولین درس نباشد)
        if ($previous_lesson) {
            //گرفتن آزمون درس قبلی به شرط قبولی کاربر
            $previous_lesson_passed_test = $previous_lesson->tests()->where('user_id', $user->id)->where('passed', true)->first();

            //اگر کاربر در آزمون درس قبل قبول نشده باشد
            if (!$previous_lesson_passed_test) {
                return redirect(route('front.lessons', $lesson->id))->withErrors('برای انجام آزمون این درس اول باید نمره قبولی در آزمون درس قبل را کسب کنید.');
            }
        }

        return view('front.tests.form', compact('lesson'));
    }

    public function store(Request $request, Lesson $lesson)
    {
        //create validation rules
        $rules = [];
        foreach ($lesson->questions as $question) {
            $rules['question' . $question->id] = ['required', 'in:1,2,3,4'];
        }

        //validation answers
        $validator = Validator::make($request->all(), $rules);

        //if validation fails return error
        if ($validator->fails())
            return back()->withErrors('لطفا به همه سوالات پاسخ دهید.');


        //get answers information
        $userAnswers = [];
        foreach ($lesson->questions as $question) {
            $answer = [
                'question_id' => $question->id,
                'user_answer' => $request->{'question' . $question->id},
                'question_answer' => $question->answer,
                'question_score' => $question->score,
            ];

            $answer['is_correct_answer'] = ($answer['user_answer'] == $answer['question_answer']);

            array_push($userAnswers, $answer);
        }


        //get test final score
        $testFinalScore = 0;
        foreach ($userAnswers as $answer) {
            if ($answer['is_correct_answer']) {
                $testFinalScore += $answer['question_score'];
            }
        }


        DB::beginTransaction();

        //store test info to database
        $test = Test::create([
            'user_id' => auth()->user()->id,
            'lesson_id' => $lesson->id,
            'score' => $testFinalScore,
            'passed' => ($testFinalScore >= $lesson->passing_mark),
        ]);


        //store answers info to database
        foreach ($userAnswers as $answer) {
            Answer::create([
                'test_id' => $test->id,
                'question_id' => $answer['question_id'],
                'user_answer' => $answer['user_answer'],
                'is_correct' => $answer['is_correct_answer']
            ]);
        }

        DB::commit();

        return redirect(route('tests.result', $test->id));
    }


    public function result(Test $test)
    {
        //هر کاربر می تواند فقط سه بار در آزمون شرکت کند.
        //بدست آوردن تعداد دفعات باقی مانده برای شرکت در آزمون
        $userChance = 3 - (auth()->user()->tests()->where('lesson_id', $test->lesson->id)->count());

        return view('front.tests.result', compact('test', 'userChance'));
    }

}
