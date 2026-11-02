<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data CV</title>
    <link href="https://jsdelivr.net" rel="stylesheet">
</head>
<body class="bg-light py-5">
    <div class="container" style="max-width: 800px;">
        <div class="mb-4">
            <a href="{{ route('cv.index') }}" class="btn btn-sm btn-outline-secondary">&larr; Kembali</a>
            <h2 class="mt-2">Edit Data CV: {{ $dataCv->nama }}</h2>
        </div>

        <form action="{{ route('cv.update', $dataCv->cv_id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Wajib ditambahkan untuk memodifikasi request method form edit -->

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-dark text-white fw-bold">Informasi Pribadi & Kontak</div>
                <div class="card-body row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="{{ $dataCv->nama }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Peran / Profesi</label>
                        <input type="text" name="peran" class="form-control" value="{{ $dataCv->peran }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $dataCv->email }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No. Telepon</label>
                        <input type="text" name="phone" class="form-control" value="{{ $dataCv->phone }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" value="{{ $dataCv->lokasi }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Website</label>
                        <input type="text" name="website" class="form-control" value="{{ $dataCv->website }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Tentang Saya</label>
                        <textarea name="tentang_saya" class="form-control" rows="3">{{ $dataCv->tentang_saya }}</textarea>
                    </div>
                </div>
            </div>

            <!-- TAMPILAN LOOP DATA PENDIDIKAN EKSISTING -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-dark text-white fw-bold">Riwayat Pendidikan Saat Ini</div>
                <div class="card-body">
                    @foreach($dataCv->pendidikan as $edu)
                        <div class="row g-2 mb-2 pb-2 border-bottom">
                            <div class="col-md-4"><input type="text" name="gelar[]" class="form-control form-control-sm" value="{{ $edu->gelar }}" required></div>
                            <div class="col-md-4"><input type="text" name="institusi[]" class="form-control form-control-sm" value="{{ $edu->institusi }}" required></div>
                            <div class="col-md-2"><input type="text" name="tahun[]" class="form-control form-control-sm" value="{{ $edu->tahun }}" required></div>
                            <div class="col-md-2"><input type="text" name="ipk[]" class="form-control form-control-sm" value="{{ $edu->ipk }}"></div>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-info text-white w-100 py-2 fw-bold">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
