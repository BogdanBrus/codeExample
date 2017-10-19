<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ExcelToDbServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share('current_table', [
            'familiya' => array('ru' => 'Фамилия', 'db_value' => 'last_name'),
            'imya' => array('ru' => 'Имя', 'db_value' => 'first_name'),
            'otchestvo' => array('ru' => 'Отчество', 'db_value' => 'surname'),
            'god._rozhdeniya' => array('ru' => 'Год. рождения', 'db_value' => 'year_of_birth'),
            'dolzhnost' => array('ru' => 'Должность', 'db_value' => 'position'),
            'zp_v_god.' => array('ru' => 'Зп в год.', 'db_value' => 'salary_for_year'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\MyCore\Contracts\ParserExcelDb', 'App\MyCore\Implementers\MaatWorkersParserExcelDb');
    }
}
