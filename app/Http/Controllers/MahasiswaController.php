<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function show(string $param1)
{
    if($param1 == 'detail'){
        return view('halaman-mahasiswa-detail');
    } else if ($param1 == 'profil'){
        return view('halaman-mahasiswa-profil');
    }
}
}

