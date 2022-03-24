<?php

namespace App\Services;

use App\Interfaces\QuestionRepositoryInterface;
use App\Models\Question;
use Symfony\Component\HttpFoundation\Response;

class QuestionService
{
    private QuestionRepositoryInterface $questionRepository;

    public function __construct(QuestionRepositoryInterface $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function computeNextQuestion($answer)
    {
        //if answer has next_question_id already just return this question
        if (!empty($answer) && !empty($answer->next_question_id)) {
            //if answer has point, we can compute total_point by incrementing points
            $answer->checkPoints($answer);
            return response()->json($this->questionRepository->getQuestionById($answer->next_question_id),
                Response::HTTP_OK);
        }

        //if question has next_question_id already just return this question
        if (!empty($answer) && !empty($answer->question->next_question_id)) {
            //if answer has point, we can compute total_point by incrementing points
            $answer->checkPoints($answer);
            return response()->json($this->questionRepository->getQuestionById($answer->question->next_question_id),
                Response::HTTP_OK);
        }

        //if question has check_point we must check out how many points gained respondent
        if (!empty($answer->question->check_out)) {
            //if expected points to pass to next question gained || computed total_point equal to expected point
            if ($answer->question->survey->total_point == $answer->question->survey->points) {
                //return success question
                return response()
                    ->json($this->questionRepository->getQuestionById($answer->question->survey->success_question_id),
                        Response::HTTP_OK);
            } else {
                //return fail question
                return response()
                    ->json($this->questionRepository->getQuestionById($answer->question->survey->fail_question_id),
                        Response::HTTP_OK);
            }
        }
    }
}
