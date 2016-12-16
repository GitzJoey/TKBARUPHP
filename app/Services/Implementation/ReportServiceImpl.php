<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 12/16/2016
 * Time: 8:19 AM
 */

namespace App\Services\Implementation;

use Storage;
use App\Services\ReportService;

class ReportServiceImpl implements ReportService
{
    public function doReportHousekeeping()
    {
        dd(Storage::disk('report_storage')->allFiles());
    }
};