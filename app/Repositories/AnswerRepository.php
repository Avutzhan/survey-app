<?php

namespace App\Repositories;

use App\Interfaces\AnswerRepositoryInterface;
use App\Models\Answer;

class AnswerRepository implements AnswerRepositoryInterface
{

    public function getAnswerById($id)
    {
        return Answer::findOrFail($id);
    }
}
