<?php

namespace App\Http\Controllers;

use App\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Input};
use File;
use Maatwebsite\Excel\Facades\Excel;

class ParserXlsToDbController extends Controller
{
    /*
     * For change data table in future
     */
    public static $current_table = array(
        'familiya' => array('ru' => 'Фамилия', 'db_value' => 'last_name'),
        'imya' => array('ru' => 'Имя', 'db_value' => 'first_name'),
        'otchestvo' => array('ru' => 'Отчество', 'db_value' => 'surname'),
        'god._rozhdeniya' => array('ru' => 'Год. рождения', 'db_value' => 'year_of_birth'),
        'dolzhnost' => array('ru' => 'Должность', 'db_value' => 'position'),
        'zp_v_god.' => array('ru' => 'Зп в год.', 'db_value' => 'salary_for_year'),
    );

    /*
     * Show workers or upload form
     */
    public function index()
    {
        if (Worker::find(1)) {
           return redirect('workers');
        } else {
            return view('ParserXlsToDb.getUploadForm');
        }
    }

    /*
     * Upload Excel file and parse to db
     */
    public function importExcel(Request $request)
    {
        // validation file type
        if ($request->hasFile('document')) {
            $extension = File::extension($request->document->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
            } else {
                $file_err = 'File is a ' . $extension . ' file! Please upload a valid type xls/xlsx/csv file!';
                return view('ParserXlsToDb.getUploadForm')->with('file_err', $file_err);
            }
        } else {
            $request->session()->flash('errorUpload', 'Выберите файл Ексель!');
            return back();
        }
        // read file, prepare end write to db
        $path = Input::file('document')->getRealPath();
        $data = Excel::load($path)->get()->toArray();
        if (!empty($data)) {
            // Prepare import data (change name for db_name)
            $new_data = [];
            for ($i=0; $i<count($data); $i++) {
                $arr_item = [];
                foreach ($data[$i] as $key => $value) {
                    if ($key) {
                        if ($key == 'zp_v_god.') $value = str_replace("грн.", '', $value);//remove грн.
                        $arr_item[ ParserXlsToDbController::$current_table[$key]['db_value'] ] = $value;
                    }
                }
                $new_data[$i] = $arr_item;
            }
            // clear table and Insert data to db
            DB::table('workers')->truncate();
            DB::table('workers')->insert($new_data);
            // return table for front with crud
            $workers = Worker::all();

            return view('ParserXlsToDb.workers')->with('workers', $workers)->with('current_table', ParserXlsToDbController::$current_table);
        }
    }

    /*
     * generate and download Excel file from db table
     */
    public function exportExcel($type, $deleteTable=null)
    {
        $data = Worker::get()->toArray();
        if (!empty($data)) {
            // Prepare import data (change db_name for export ru_name)
            $new_data = [];
            for ($i = 0; $i < count($data); $i++) {
                $arr_item = [];
                foreach ($data[$i] as $key => $value) {
                    if ($key == 'salary_for_year') $value = $value.'грн.';//add грн.
                        if ($key != 'id') {
                            foreach (ParserXlsToDbController::$current_table as $attr) {
                               if ($key == $attr['db_value']) {
                                   $arr_item[ $attr['ru'] ] = $value;
                                   break;
                               }
                            }
                        }
                }
                $new_data[$i] = $arr_item;
            }
        }
        // clear db
        if ($deleteTable) {
            DB::table('workers')->truncate();
        }

        return Excel::create('workers', function($excel) use ($new_data) {
            $excel->sheet('workers_info', function($sheet) use ($new_data) {
                $sheet->fromArray($new_data);
            });
        })->download($type);
    }
}
