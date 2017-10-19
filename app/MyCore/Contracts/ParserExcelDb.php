<?php

namespace App\MyCore\Contracts;

use Illuminate\Http\Request;

/**
 * Interface for import/export excel to/from db
 */
Interface ParserExcelDb
{

    /**
     * Import excel to db
     * @param Request $request File excel
     * @return void
     */
    public function importExcel(Request $request);

    /**
     * Download file excel
     * @param boolean $deleteTable Flag for flush table in db
     */
    public function exportExcel($deleteTable = false);

}