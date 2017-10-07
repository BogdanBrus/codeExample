<?php

namespace App\Http\Controllers;

use App\Worker;
use Illuminate\Http\Request;

class WorkerCrudController extends Controller
{
    /**
     * Show All workers from DB
     */
    public function index()
    {
        $workers = Worker::all();

        return view('ParserXlsToDb.workers')->with('workers', $workers)->with('current_table', ParserXlsToDbController::$current_table);
    }

    /**
     * Show the form for add a new Worker.
     */
    public function create()
    {
        return view('ParserXlsToDb.createWorkerForm')->with('current_table', ParserXlsToDbController::$current_table);

    }

    /**
    * Simple Validation
    */
    public function simpleValidator(Request $request)
    {
        $this->validate($request, [
            'last_name' => 'required',
            'first_name' => 'required',
            'surname' => 'required',
            'year_of_birth' => 'required|numeric',
            'position' => 'required',
            'salary_for_year' => 'required|numeric',
        ]);
    }

    /**
     * Store a newly created Worker in storage.
     */
    public function store(Request $request)
    {
        $this->simpleValidator($request);
       //save to DB
        $worker = new Worker();
        foreach (ParserXlsToDbController::$current_table as $key => $value) {
            $attribute = $value['db_value'];
            $worker->$attribute = $request->$attribute;
        }
        $worker->save();
        $request->session()->flash('success', 'Работник добавлен!');

        return redirect()->route('workers.show', $worker->id);
    }

    /**
     * Display the specified Worker.
     */
    public function show($id)
    {
        $worker = Worker::find($id);

        return view('ParserXlsToDb.showWorker')->with('worker', $worker)->with('current_table', ParserXlsToDbController::$current_table);
    }

    /**
     * Show the form for editing the worker
     */
    public function edit($id)
    {
        $worker = Worker::find($id);

        return view('ParserXlsToDb.editWorker')->with('worker', $worker)->with('current_table', ParserXlsToDbController::$current_table);;
    }

    /**
     * Update worker
     */
    public function update(Request $request, $id)
    {
        $this->simpleValidator($request);
        $worker = Worker::find($id);
        foreach (ParserXlsToDbController::$current_table as $key => $value) {
            $attribute = $value['db_value'];
            $worker->$attribute = $request->$attribute;
        }
        $worker->save();
        $request->session()->flash('success', 'Изменения сохранены!');

        return redirect()->route('workers.show', $worker->id);
    }

    /**
     * Remove worker
     */
    public function destroy(Request $request, $id)
    {
        $worker = Worker::find($id);
        $worker->delete();
        $request->session()->flash('success', 'Работник удален!');

        return redirect('/workers');
    }
}
