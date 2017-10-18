<?php

namespace App\Http\Controllers\ParserExcelDb;

use App\Worker;
use Illuminate\Http\Request;
use File;
use App\MyCore\Contracts\ParserExcelDb;
use App\Http\Controllers\Controller;
use Exception;

class ParserExcelDbController extends Controller
{
    private $parserExcelDb;

    /**
     * ParserXlsToDbController constructor.
     * @param ParserExcelDb $parserExcelDb - di Interface
     */
    public function __construct(ParserExcelDb $parserExcelDb)
    {
        $this->parserExcelDb = $parserExcelDb;
    }


    /**
     * Show workers or upload form
     */
    public function index()
    {
        if (Worker::get()->first()) {
           return redirect('workers');
        } else {
            return view('ParserXlsToDb.getUploadForm');
        }
    }

    /**
     * Upload Excel file, parse and insert to db
     */
    public function importExcel(Request $request)
    {
        echo $request->hasFile('document');
        if ($request->hasFile('document')) {
            $extension = File::extension($request->document->getClientOriginalName());

            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {

                try {
                    $this->parserExcelDb->importExcel($request);
                    return redirect('workers');
                } catch(Exception $e) {
                    $error = "Данные в Ексель файле не корректные!";
                    return back()->withErrors($error);
                }

            } else {
                $textError = 'Вы пытаетесь загрузить файл: ' . $extension . '! Пожалуйста выберите файл: xls/xlsx/csv!';
                return back()->withErrors($textError);
            }

        } else {
            $textError = 'Вы не выбрали файл!!!';
            return back()->withErrors($textError);
        }
    }

    /**
     * generate and download Excel file from db table
     * @param boolean $deleteTable Flag to flush table
     */
    public function exportExcel($deleteTable=false)
    {
        $this->parserExcelDb->exportExcel($deleteTable);
    }

}