<?php

namespace App\Http\Controllers\Export;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\SantriExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportSantriController extends Controller
{
    /**
     * Fungsi untuk mengekspor data ke file Excel
     */
    public function exportSantri()
    {
        return Excel::download(new SantriExport, 'santri.xlsx');
    }
}
