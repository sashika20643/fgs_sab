<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //


    public function getSemesterName()
    {
        $semester = $this->semester;

        // Extracting year and semester values from the semester format "x-y"
        [$year, $sem] = explode('-', $semester);

        // Mapping the year and semester values to their corresponding names
        $yearNames = ['First Year', 'Second Year', 'Third Year', 'Fourth Year'];
        $semNames = ['First Semester', 'Second Semester'];

        $yearIndex = intval($year) - 1;
        $semIndex = intval($sem) - 1;

        // Generating the semester name based on the year and semester values
        $semesterName = $yearNames[$yearIndex] . ', ' . $semNames[$semIndex];

        return $semesterName;
    }

    public function results()
{
    return $this->hasMany(Result::class, 'subject_id', 'id');
}


}
