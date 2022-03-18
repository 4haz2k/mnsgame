<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionRate;
use App\Models\TopicCategoryModel;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index(){
        return view('supportPages.support');
    }

    public function faqPage(){
        $categories = TopicCategoryModel::with("questions")->get()->all();
        return view('supportPages.faq', compact("categories"));
    }

    public function answerPage($answer){
        $answer = Question::where("id", $answer)->first();

        if($answer == null)
            return redirect("/support/faq");

        return view("supportPages.answer", compact("answer"));
    }

    public function isHelpful(Request $request): \Illuminate\Http\JsonResponse
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
}
