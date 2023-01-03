<?php

namespace App\Http\Controllers;

use App\Http\Services\MNSGameSEO;
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
use Jenssegers\Date\Date;

class SupportController extends Controller
{
    use MNSGameSEO;

    /**
     * Отображение главной страницы /support
     *
     * @return Application|Factory|View
     */
    public function index(){
        return view('supportPages.support');
    }

    /**
     * Отображение страницы справки /support/faq
     *
     * @return Application|Factory|View
     */
    public function faqPage(){
        $this->setPageSEO(true, false, [
            "title" => "MNS Game - наиболее частые вопросы",
            "description" => "Наиболее частые вопросы MNS Game",
            "url" => url("/support/faq")
        ]);

        $categories = TopicCategoryModel::with("questions")->get()->all();
        return view('supportPages.faq', compact("categories"));
    }

    /**
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
     * AJAX: обработка ответа о полезности ответа на вопрос /support/faq/answer/helpful
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function isHelpful(Request $request): JsonResponse
    {
        $rate = QuestionRate::where("id", (int)\request("answer_id"))->first();
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
     * AJAX: обработка ответа ввода в поисковую форму слова /support/faq/answer/suggestions
     *
     * @return JsonResponse
     */
    public function suggestions(): JsonResponse
    {
        $data = Question::where("title", "like", "%". \request("word") ."%")->take(5)->get();

        return response()->json($data);
    }

    public function searchSuggestion(){
        if(\request("question") == null)
            return redirect("/support/faq");

        $question = \request("question");

        $suggestions = Question::where("title", "like", "%". $question ."%")->paginate(10);

        Date::setLocale("ru");

        return view("supportPages.search", compact("question", "suggestions"));
    }
}
