<?php

namespace App\Http\Controllers;

use App\Models\Citie;
use App\Models\Department;
use Illuminate\Http\Request;

class CitiesDepartmentsController extends Controller
{
    public function getCities(int $id)
    {
        $array = array(
            'id' => 0,
            'name' => "Selecciona una ciudad"
        );
        $cities = Citie::where('department', $id)->get();
        $cities->prepend($array);
        
        return $cities;
    }

    public function getDepartments()
    {
        $array = array(
            'id' => 0,
            'name' => "Selecciona un departamento"
        );
        $departments = Department::select('id', 'name')->get();
        $departments->prepend($array);
        return $departments;
    }
}
