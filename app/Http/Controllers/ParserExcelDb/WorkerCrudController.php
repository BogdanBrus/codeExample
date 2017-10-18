<?php

namespace App\Http\Controllers\ParserExcelDb;

use App\Worker;
use Illuminate\Http\Request;
use App\Http\Requests\WorkerCrudRequest;
use App\Http\Controllers\Controller;

class WorkerCrudController extends Controller
{
    private $request;
    private $current_table;

    /**
     * WorkerCrudController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->current_table = view()->shared('current_table');
    }

    /**
     * Show All workers from DB
     */
    public function index()
    {
        $workers = Worker::all();

        return view('ParserXlsToDb.workers')->with('workers', $workers);
    }

    /**
     * Show the form for add a new Worker.
     */
    public function create()
    {
        return view('ParserXlsToDb.createWorkerForm');
    }

    /**
     * Store a newly created Worker in storage.
     * @param WorkerCrudRequest $request Validator for data
     * @return redirect
     */
    public function store(WorkerCrudRequest $request)
    {
        $worker = new Worker();

        foreach ($this->current_table as $key => $value) {
            $attribute = $value['db_value'];
            $worker->$attribute = $request->$attribute;
        }

        $worker->save();

        return $worker->toJson();
    }

    /**
     * Display the specified Worker.
     */
    public function show($id)
    {
        $worker = Worker::find($id);

        return view('ParserXlsToDb.showWorker')->with('worker', $worker);
    }

    /**
     * Show the form for editing the worker
     */
    public function edit($id)
    {
        $worker = Worker::find($id);

        return view('ParserXlsToDb.editWorker')->with('worker', $worker);
    }

    /**
     * Update worker
     * @param WorkerCrudRequest $request Validator for data
     * @return redirect
     */
    public function update(WorkerCrudRequest $request, $id)
    {
        $worker = Worker::find($id);

        foreach ($this->current_table as $key => $value) {
            $attribute = $value['db_value'];
            $worker->$attribute = $request->$attribute;
        }

        $worker->save();

        return $worker->toJson();
    }

    /**
     * Remove worker
     */
    public function destroy($id)
    {
        $worker = Worker::find($id);
        $worker->delete();
    }

}