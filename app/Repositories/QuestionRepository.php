<?php

namespace App\Repositories;

use App\Interfaces\QuestionRepositoryInterface;
use App\Models\Question;

class QuestionRepository implements QuestionRepositoryInterface
{

    public function getQuestionById($id)
    {
        return Question::findOrFail($id);
    }
}
