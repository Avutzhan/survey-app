<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnswerRequest;
use App\Interfaces\AnswerRepositoryInterface;
use App\Models\Answer;
use App\Services\QuestionService;
use Illuminate\Http\JsonResponse;

class WebhookController extends Controller
{
    private AnswerRepositoryInterface $answerRepository;

    public function __construct(AnswerRepositoryInterface $answerRepository)
    {
        $this->answerRepository = $answerRepository;
    }
    /**
     * @param AnswerRequest $request
     * @param QuestionService $question
     * @return JsonResponse
     */
    public function input(AnswerRequest $request, QuestionService $question): JsonResponse
    {
        $validated = $request->validated();

        return $question->computeNextQuestion($this->answerRepository->getAnswerById($validated['id']));
    }
}
