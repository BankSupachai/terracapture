<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CasesExport;
use Illuminate\Support\Facades\Log;

class ExportCasesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $query;
    protected $heads;
    protected $values;
    protected $filename;

    public function __construct($query, $filename, $heads, $values)
    {
        $this->query = $query;
        $this->filename = $filename;
        $this->heads = $heads;
        $this->values = $values;
    }

    public function handle()
    {
        // dd(1);
        // Log::info('Job started with query count: ' . count($this->query));
        // $filePath = 'cases_' . now()->timestamp . '.xls';
        // Excel::store(new CasesExport($this->query, $this->heads, $this->values), $this->filename);
        // Log::info('File stored at: ' . $filePath);
    }
}
