<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionRate;
use App\Models\TopicCategoryModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class SupportController extends Controller
{
    /**
     *
     * Отображение главной страницы /support
     *
     * @return Application|Factory|View
     */
    public function index(){
        return view('supportPages.support');
    }

    /**
     *
     * Отображение страницы справки /support/faq
     *
     * @return Application|Factory|View
     */
    public function faqPage(){
        $categories = TopicCategoryModel::with("questions")->get()->all();
        return view('supportPages.faq', compact("categories"));
    }

    /**
     *
     * Отображение страницы ответа на вопрос /support/faq/answer/{answer_id}
     *
     * @param $answer
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function answerPage($answer){
        $answer = Question::where("id", $answer)->first();

        if($answer == null)
            return redirect("/support/faq");

        return view("supportPages.answer", compact("answer"));
    }

    /**
     *
     * AJAX: обработка ответа о полезности ответа на вопрос /support/faq/answer/helpful
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function isHelpful(Request $request): JsonResponse
    {
        $rate = QuestionRate::find($request->answer_id);
        if($rate != null){
            if(\request("type") != null){
                switch (\request("type")){
                    case "1":
                        $rate->helpful = (int)$rate->helpful + 1;
                        break;
                    case "2":
                        $rate->useless = (int)$rate->useless + 1;
                        break;
                    default:
                        return response()->json(["error" => "Bad rate type"], 400);
                }
                $rate->update();

                return response()->json(["error" => null], 200);
            }
            else{
                return response()->json(["error" => "Answer rate null"], 400);
            }
        }
        else{
            return response()->json(["error" => "Answer not found"], 400);
        }
    }

    /**
     *
     * AJAX: обработка ответа ввода в поисковую форму слова /support/faq/answer/suggestions
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function suggestions(Request $request): JsonResponse
    {
        $data = Question::where("title", "like", "%". \request("word") ."%")->get();

        return response()->json($data);
    }
}
