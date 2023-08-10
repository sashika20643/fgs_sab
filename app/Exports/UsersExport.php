<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class UsersExport implements FromCollection
{

    use Exportable;

    public function query()
    {
        return DB::table('users')->select('id', 'name', 'email', 'created_at');
    }

    public function headings(): array
    {
        return ['ID', 'Name', 'Email', 'Created At'];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
    }
}
