<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Member;

class MemberController extends BaseController
{
    public function index(Request $request) {
        $firstname = $request->input('firstname', '');
        $surname = $request->input('surname', '');
        $email = $request->input('email', '');
        $gender = $request->input('gender', '');
        $members = Member::filter()->paginate(20);

        return response()->json($members);
    }
}
