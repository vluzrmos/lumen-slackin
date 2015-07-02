<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        /*
         * Validates a minimum words required
         * @example min_words:1
         */
        $this->app['validator']->extend(
            'min_words', function ($attribute, $value, $parameters) {
            return str_word_count($value) >= array_get($parameters, 0, 1);
        }
        );

        /*
         * Validate a maximun words required
         * @example max_words:10
         */
        $this->app['validator']->extend(
            'max_words', function ($attribute, $value, $parameters) {
            return str_word_count($value) <= array_get($parameters, 0, 1);
        }
        );

        /*
         * Replace the :words in messages for min_words rules.
         */
        $this->app['validator']->replacer(
            'min_words', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':words', $parameters[0], $message);
        }
        );

        /*
         * Replace the :words in messages for max_words rules.
         */
        $this->app['validator']->replacer(
            'max_words', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':words', $parameters[0], $message);
        }
        );
    }
}
