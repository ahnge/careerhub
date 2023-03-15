<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    // Displaying a list of the companies
    public function index()
    {
        return view('employers.index', [
            'employers' => Employer::paginate(5)
        ]);
    }
}
