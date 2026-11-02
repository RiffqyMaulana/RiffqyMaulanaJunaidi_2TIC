<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat CV Baru - Admin Panel</title>
    
    <!-- Perbaikan Jalur Pemanggilan CSS Volt Sesuai Master Layout Anda -->
    <link type="text/css" href="{{ asset('assets-admin/css/volt.css') }}" rel="stylesheet">
    
    <!-- Bootstrap Icons untuk mempermanis tombol -->
    <link rel="stylesheet" href="https://jsdelivr.net">
</head>

<body class="bg-gray-100 py-5">
    <div class="container" style="max-width: 850px;">
        <!-- Tombol Kembali -->
        <div class="mb-4">
            <a href="{{ route('cv.index') }}" class="btn btn-sm btn-outline-gray-600 d-inline-flex align-items-center">
                <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar CV
            </a>
            <h2 class="h3 mt-3 fw-bold text-gray-800">Buat Dokumen CV Baru</h2>
        </div>

        <form action="{{ route('cv.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- BLOK KARTU 1: INFORMASI PROFIL & KONTAK -->
            <div class="card border-0 shadow mb-4">
                <div class="card-header bg-gray-800 text-white p-3">
                    <h5 class="mb-0 fw-bold d-inline-flex align-items-center">
                        <i class="bi bi-person-vcard me-2"></i> Informasi Pribadi & Kontak
                    </h5>
                </div>
                <div class="card-body row p-4 g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control border-gray-300" required placeholder="Contoh: Daniel Gallego">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Peran / Profesi</label>
                        <input type="text" name="peran" class="form-control border-gray-300" required placeholder="Contoh: UI/UX Designer">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Alamat Email</label>
                        <input type="email" name="email" class="form-control border-gray-300" required placeholder="name@domain.com">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">No. Telepon / WhatsApp</label>
                        <input type="text" name="phone" class="form-control border-gray-300" placeholder="Contoh: +628123456789">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Lokasi Saat Ini</label>
                        <input type="text" name="lokasi" class="form-control border-gray-300" placeholder="Contoh: Jakarta, Indonesia">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tautan Portofolio / Website</label>
                        <input type="text" name="website" class="form-control border-gray-300" placeholder="Contoh: www.mywebsite.com">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Tentang Saya (Ringkasan Profil)</label>
                        <textarea name="tentang_saya" class="form-control border-gray-300" rows="4" placeholder="Tulis deskripsi singkat mengenai keahlian dan kelebihan profesional Anda..."></textarea>
                    </div>
                </div>
            </div>

            <!-- BLOK KARTU 2: DAFTAR RIWAYAT PENDIDIKAN DINAMIS -->
            <div class="card border-0 shadow mb-4">
                <div class="card-header bg-gray-800 text-white p-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold d-inline-flex align-items-center">
                        <i class="bi bi-mortarboard-fill me-2"></i> Riwayat Pendidikan
                    </h5>
                    <button type="button" class="btn btn-sm btn-light fw-bold" id="add-pendidikan">
                        <i class="bi bi-plus-lg"></i> Tambah Baris
                    </button>
                </div>
                <div class="card-body p-4" id="pendidikan-container">
                    <!-- Baris Input Standar Pertama -->
                    <div class="row g-3 mb-3 pb-3 border-bottom item-pendidikan align-items-end">
                        <div class="col-md-3">
                            <label class="form-label small fw-semibold text-gray-600">Gelar / Jenjang</label>
                            <input type="text" name="gelar[]" class="form-control border-gray-300" placeholder="S1 Desain Komunikasi Visual" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-gray-600">Nama Universitas / Sekolah</label>
                            <input type="text" name="institusi[]" class="form-control border-gray-300" placeholder="Universitas Bina Nusantara" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-semibold text-gray-600">Periode Tahun</label>
                            <input type="text" name="tahun[]" class="form-control border-gray-300" placeholder="2017 - 2021" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small fw-semibold text-gray-600">Nilai / IPK</label>
                            <input type="text" name="ipk[]" class="form-control border-gray-300" placeholder="3.70">
                        </div>
                    </div>
                </div>
            </div>

            <!-- TOMBOL SUBMIT AKSI -->
            <div class="mb-5">
                <button type="submit" class="btn btn-success w-100 py-2.5 fw-bold text-white shadow-sm transition-300">
                    <i class="bi bi-cloud-arrow-up-fill me-2"></i> Simpan Data & Generate Tampilan CV
                </button>
            </div>
        </form>
    </div>

    <!-- JavaScript Dinamis Mengikuti Class Form Bootstrap Volt -->
    <script>
        document.getElementById('add-pendidikan').addEventListener('click', function() {
            const container = document.getElementById('pendidikan-container');
            const newRow = document.createElement('div');
            newRow.className = 'row g-3 mb-3 pb-3 border-bottom item-pendidikan align-items-end';
            newRow.innerHTML = `
                <div class="col-md-3">
                    <input type="text" name="gelar[]" class="form-control border-gray-300" placeholder="Gelar" required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="institusi[]" class="form-control border-gray-300" placeholder="Universitas" required>
                </div>
                <div class="col-md-3">
                    <input type="text" name="tahun[]" class="form-control border-gray-300" placeholder="Tahun" required>
                </div>
                <div class="col-md-1.5 col-9">
                    <input type="text" name="ipk[]" class="form-control border-gray-300" placeholder="IPK">
                </div>
                <div class="col-md-0.5 col-3 text-end">
                    <button type="button" class="btn btn-danger btn-block remove-btn" title="Hapus baris ini">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </div>
            `;
            container.appendChild(newRow);

            newRow.querySelector('.remove-btn').addEventListener('click', function() {
                newRow.remove();
            });
        });
    </script>
</body>

</html>
