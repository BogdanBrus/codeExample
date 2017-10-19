<?php

namespace App\MyCore\Implementers;

use App\MyCore\Contracts\ParserExcelDb ;
use Illuminate\Http\Request;
use App\Worker;
use Illuminate\Support\Facades\{DB, Input};
use Maatwebsite\Excel\Facades\Excel;


/**
 * Implementer for ParserExcelDb with lib Maatwebsite
 * for table db(workers)
 */
class MaatWorkersParserExcelDb implements ParserExcelDb
{
    private $current_table;

    /**
     * MaatWorkersParserExcelDb constructor.
     * current data table from ServiceProvider
     */
    public function __construct()
    {
        $this->current_table = view()->shared('current_table');
    }

    /**
     * Read file, prepare data end write to db(workers)
     * @param Request $request
     * @return void
     */
    public function importExcel(Request $request)
    {
        $path = Input::file('document')->getRealPath();
        $data = Excel::load($path)->get()->toArray();

        if (empty($data)) return [];

        $data = $this->prepareDataImport($data);
        DB::table('workers')->insert($data);
    }

    /**
     *  Read db(workers), prepare data end download File
     * @param bool $deleteTable
     * @return mixed File
     */
    public function exportExcel($deleteTable = false)
    {
        $data = Worker::get()->toArray();

        if (!empty($data)) {
            $data = $this->prepareDataExport($data);
        }

        if ($deleteTable) {
            DB::table('workers')->truncate();// clear db
        }

        return Excel::create('workers', function($excel) use ($data) {
            $excel->sheet('workers_info', function($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download();
    }

    /**
     * Prepare data for DB(workers)
     * @param $data
     * @return array
     */
    private function prepareDataImport($data)
    {
        $new_data = [];

            for ($i=0; $i<count($data); $i++) {
                $arr_item = [];

                foreach ($data[$i] as $key => $value) {
                    if ($key) {
                        if ($key == 'zp_v_god.') $value = str_replace("грн.", '', $value);//remove грн.
                        $arr_item[ $this->current_table[$key]['db_value'] ] = $value;
                    }
                }
                $new_data[$i] = $arr_item;
            }
            return $new_data;
    }

    /**
     * Prepare data for export
     * @param $data
     * @return array Ready data
     */
    private function prepareDataExport($data)
    {
        $new_data = [];

        for ($i = 0; $i < count($data); $i++) {
            $arr_item = [];
            foreach ($data[$i] as $key => $value) {
                if ($key == 'salary_for_year') $value = $value.'грн.';//add грн.
                if ($key != 'id') {

                    foreach ($this->current_table as $attr) {
                        if ($key == $attr['db_value']) {
                            $arr_item[ $attr['ru'] ] = $value;
                            break;
                        }
                    }
                }
            }
            $new_data[$i] = $arr_item;
        }

        return $new_data;
    }

}