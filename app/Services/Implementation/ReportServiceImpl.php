<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 12/16/2016
 * Time: 8:19 AM
 */

namespace App\Services\Implementation;

use File;
use Storage;
use Carbon\Carbon;
use App\Services\ReportService;

class ReportServiceImpl implements ReportService
{
    public function doReportHousekeeping()
    {
        foreach (Storage::disk('report_storage')->files() as $filename) {
            $processFile = storage_path("app/public/reports/").$filename;

            if (Carbon::createFromFormat('U', File::lastModified($processFile))->diffInDays(Carbon::now()) > 0) {
                File::delete($processFile);
            }
        }
    }
};