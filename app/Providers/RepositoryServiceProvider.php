<?php

namespace App\Providers;

use App\Interfaces\AnswerRepositoryInterface;
use App\Interfaces\QuestionRepositoryInterface;
use App\Repositories\AnswerRepository;
use App\Repositories\QuestionRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerAnswerRepository();
        $this->registerQuestionRepository();

    }

    /**
     * Register Answer Repository.
     *
     * @return void
     */
    public function registerAnswerRepository()
    {
        $this->app->bind(AnswerRepositoryInterface::class, AnswerRepository::class);
    }

    /**
     * Register Question Repository.
     *
     * @return void
     */
    public function registerQuestionRepository()
    {
        $this->app->bind(QuestionRepositoryInterface::class, QuestionRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
