<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah CV Baru</title>
    <link href="https://jsdelivr.net" rel="stylesheet">
</head>
<body class="bg-light py-5">
    <div class="container" style="max-width: 800px;">
        <div class="mb-4">
            <a href="{{ route('cv.index') }}" class="btn btn-sm btn-outline-secondary">&larr; Kembali</a>
            <h2 class="mt-2">Buat CV Baru</h2>
        </div>

        <form action="{{ route('cv.store') }}" method="POST">
            @csrf

            <!-- IDENTITAS UTAMA -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-dark text-white fw-bold">Informasi Pribadi & Kontak</div>
                <div class="card-body row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" required placeholder="Daniel Gallego">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Peran / Profesi</label>
                        <input type="text" name="peran" class="form-control" required placeholder="UI/UX Designer">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required placeholder="name@domain.com">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No. Telepon</label>
                        <input type="text" name="phone" class="form-control" placeholder="+62-xxx">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" placeholder="Jakarta, Indonesia">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Website</label>
                        <input type="text" name="website" class="form-control" placeholder="://mywebsite.com">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Tentang Saya</label>
                        <textarea name="tentang_saya" class="form-control" rows="3" placeholder="Tulis deskripsi profil singkat Anda..."></textarea>
                    </div>
                </div>
            </div>

            <!-- DINAMIS ARRAY: PENDIDIKAN -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center fw-bold">
                    <span>Riwayat Pendidikan</span>
                    <button type="button" class="btn btn-sm btn-light" id="add-pendidikan">+ Tambah</button>
                </div>
                <div class="card-body" id="pendidikan-container">
                    <!-- Baris Form Pendidikan Pertama -->
                    <div class="row g-2 mb-3 pb-3 border-b-input item-pendidikan">
                        <div class="col-md-4">
                            <input type="text" name="gelar[]" class="form-control" placeholder="Gelar (S1 DKV)" required>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="institusi[]" class="form-control" placeholder="Universitas" required>
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="tahun[]" class="form-control" placeholder="Tahun (2017-2021)" required>
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="ipk[]" class="form-control" placeholder="IPK (3.70)">
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success w-100 py-2 fw-bold">Simpan & Buat CV</button>
        </form>
    </div>

    <!-- Script Input Dinamis -->
    <script>
        document.getElementById('add-pendidikan').addEventListener('click', function() {
            const container = document.getElementById('pendidikan-container');
            const newRow = document.createElement('div');
            newRow.className = 'row g-2 mb-3 pb-3 border-b-input item-pendidikan align-items-end';
            newRow.innerHTML = `
                <div class="col-md-4"><input type="text" name="gelar[]" class="form-control" placeholder="Gelar" required></div>
                <div class="col-md-3"><input type="text" name="institusi[]" class="form-control" placeholder="Universitas" required></div>
                <div class="col-md-2"><input type="text" name="tahun[]" class="form-control" placeholder="Tahun" required></div>
                <div class="col-md-2"><input type="text" name="ipk[]" class="form-control" placeholder="IPK"></div>
                <div class="col-md-1"><button type="button" class="btn btn-danger btn-sm w-100 remove-btn">X</button></div>
            `;
            container.appendChild(newRow);

            newRow.querySelector('.remove-btn').addEventListener('click', function() {
                newRow.remove();
            });
        });
    </script>
</body>
</html>
