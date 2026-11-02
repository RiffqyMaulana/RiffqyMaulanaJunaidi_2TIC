<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CvProfile;

class CvController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataCv'] = CvProfile::all();
        return view('admin.cv.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cv.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $namaFoto = null;

        // Jika user mengunggah file foto profil
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            // Membuat nama file unik berdasarkan waktu
            $namaFoto = time() . '_' . $file->getClientOriginalName();
            // Memindahkan file foto ke dalam folder public/uploads/foto/
            $file->move(public_path('uploads/foto'), $namaFoto);
        }

        $dataProfile = [
            'nama'         => $request->nama,
            'peran'        => $request->peran,
            'foto'         => $namaFoto, // Simpan nama file ke database
            'tentang_saya' => $request->tentang_saya,
            'phone'        => $request->phone,
            'email'        => $request->email,
            'lokasi'       => $request->lokasi,
            'website'      => $request->website,
        ];

        $cv = CvProfile::create($dataProfile);

        // Proses simpan data pendidikan array tetap seperti kode sebelumnya...
        if ($request->has('gelar')) {
            foreach ($request->gelar as $key => $val) {
                $cv->pendidikan()->create([
                    'gelar'     => $request->gelar[$key],
                    'institusi' => $request->institusi[$key],
                    'tahun'     => $request->tahun[$key],
                    'ipk'       => $request->ipk[$key]
                ]);
            }
        }

        return redirect()->route('cv.index')->with('success', 'Pembuatan CV Berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['dataCv'] = CvProfile::with('pendidikan')->findOrFail($id);
        return view('admin.cv.show', $data);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataCv'] = CvProfile::with(['pendidikan', 'pengalaman'])->findOrFail($id);
        return view('admin.cv.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cv = CvProfile::findOrFail($id);

        $cv->nama         = $request->nama;
        $cv->peran        = $request->peran;
        $cv->tentang_saya = $request->tentang_saya;
        $cv->phone        = $request->phone;
        $cv->email        = $request->email;
        $cv->lokasi       = $request->lokasi;
        $cv->website      = $request->website;
        $cv->save();

        return redirect()->route('cv.index')->with('success', 'Perubahan CV Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cv = CvProfile::findOrFail($id);
        $cv->delete();

        return redirect()->route('cv.index')->with('success', 'CV berhasil dihapus');
    }
}
