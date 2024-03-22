<?php
namespace App\Http\Controllers\User\Cabinet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CabinetController extends Controller
{
    public function __invoke(Request $request)
    {
        return Inertia::render("User/Cabinet/Dashboard");
    }
}
