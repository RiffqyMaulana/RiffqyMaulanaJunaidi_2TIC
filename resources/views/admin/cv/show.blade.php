<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV - {{ $dataCv->nama }}</title>
    
    <!-- Memanggil CSS Volt Lokal bawaan praktikum Anda -->
    <link type="text/css" href="{{ asset('assets-admin/css/volt.css') }}" rel="stylesheet">
    
    <style>
        body {
            background-color: #f4f4f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .cv-container {
            max-width: 900px;
            min-height: 1123px;
            background: #ffffff;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .sidebar-left {
            background-color: #0B2545;
            color: #ffffff;
            padding: 40px 30px;
        }
        .content-right {
            background-color: #ffffff;
            color: #0B2545;
            padding: 50px 40px;
        }
        .heading-section {
            background-color: #0B2545;
            color: #ffffff;
            padding: 6px 15px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
            display: inline-block;
            margin-bottom: 15px;
        }
        .timeline-border {
            border-left: 2px solid #0B2545;
            padding-left: 20px;
            position: relative;
        }
        .timeline-dot {
            position: absolute;
            left: -7px;
            top: 5px;
            width: 12px;
            height: 12px;
            background-color: #0B2545;
            border-radius: 50%;
        }
        @media print {
            body { background-color: #ffffff; }
            .cv-container { box-shadow: none; margin: 0; width: 100%; }
            .no-print { display: none !important; }
        }
    </style>
</head>


<body>

    <!-- Tombol Aksi Navigasi (Disembunyikan saat dicetak) -->
    <div class="container my-3 text-center no-print">
        <a href="{{ route('cv.index') }}" class="btn btn-secondary me-2">&larr; Kembali ke List</a>
        <button onclick="window.print()" class="btn btn-success">🖨️ Cetak / Simpan ke PDF</button>
    </div>

    <!-- MAIN CV CONTAINER -->
    <div class="container cv-container p-0 my-4 shadow rounded-overflow">
        <div class="row g-0 m-0">

            <!-- KOLOM KIRI (Sidebar) -->
            <div class="col-4 sidebar-left flex-column">
                <!-- Foto & Nama Profil Utama -->
                <div class="mx-auto rounded-circle bg-light border border-4 border-white mb-3" style="width: 130px; height: 130px; overflow:hidden;">
                    @if($dataCv->foto)
                    <!-- Menampilkan foto yang diunggah dari folder public -->
                    <img src="{{ asset('uploads/foto/' . $dataCv->foto) }}" class="w-100 h-100 object-fit-cover" alt="Foto Profil">
                    @else
                    <!-- Tampilan gambar cadangan jika user tidak mengunggah foto -->
                    <img src="https://ui-avatars.com{{ urlencode($dataCv->nama) }}&background=random&size=150" class="w-100 h-100 object-fit-cover" alt="Foto Profil">
                    @endif
                </div>

                <div class="text-center mb-5">
                    <div class="mx-auto rounded-circle bg-light border border-4 border-white mb-3" style="width: 130px; height: 130px; overflow:hidden;">
                        <!-- Placeholder jika belum ada fitur upload foto resmi -->
                        <img src="https://placeholder.com" class="w-100 h-100 object-fit-cover" alt="Foto Profil">
                    </div>
                    <h3 class="fw-bold text-uppercase tracking-wide m-0" style="font-size: 1.3rem;">{{ $dataCv->nama }}</h3>
                    <div class="text-muted text-uppercase tracking-widest small mt-1 text-white-50" style="font-size: 0.75rem;">{{ $dataCv->peran }}</div>
                </div>

                <!-- Kontak -->
                <div class="mb-4">
                    <h5 class="text-uppercase border-bottom border-white-50 pb-2 mb-3 fw-bold small text-white tracking-widest">Kontak</h5>
                    <ul class="list-unstyled lh-lg" style="font-size: 0.8rem;">
                        <li class="mb-1">📞 {{ $dataCv->phone }}</li>
                        <li class="mb-1">✉️ {{ $dataCv->email }}</li>
                        <li class="mb-1">📍 {{ $dataCv->lokasi }}</li>
                        <li class="mb-1">🌐 {{ $dataCv->website }}</li>
                    </ul>
                </div>

                <!-- Riwayat Pendidikan -->
                <div>
                    <h5 class="text-uppercase border-bottom border-white-50 pb-2 mb-3 fw-bold small text-white tracking-widest">Pendidikan</h5>
                    @foreach($dataCv->pendidikan as $edu)
                    <div class="mb-3" style="font-size: 0.8rem;">
                        <div class="fw-bold">{{ $edu->gelar }}</div>
                        <div class="text-white-50">{{ $edu->institusi }}</div>
                        <div class="text-white-50 small">{{ $edu->tahun }} @if($edu->ipk) | IPK: {{ $edu->ipk }} @endif</div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- KOLOM KANAN (Content Body) -->
            <div class="col-8 content-right">

                <!-- Tentang Saya -->
                <div class="mb-5">
                    <div class="heading-section">Tentang Saya</div>
                    <p class="text-secondary small lh-base text-justify" style="font-size: 0.85rem;">
                        {{ $dataCv->tentang_saya ?? 'Deskripsi profil belum diisi.' }}
                    </p>
                </div>

                <!-- Pengalaman Kerja -->
                <div class="mb-5">
                    <div class="heading-section">Pengalaman Kerja</div>
                    <div class="timeline-border ms-2">

                        <!-- Menggunakan Relasi HasMany jika diisi, atau fallback dummy statis sesuai format gambar -->
                        @forelse($dataCv->pengalaman as $kerja)
                        <div class="mb-4 position-relative">
                            <div class="timeline-dot"></div>
                            <h6 class="fw-bold text-uppercase m-0" style="font-size: 0.85rem;">{{ $kerja->posisi }}</h6>
                            <div class="text-muted fw-semibold small mb-2">{{ $kerja->perusahaan }} | <span class="text-dark opacity-75">{{ $kerja->periode }}</span></div>
                            <p class="text-secondary small">{{ $kerja->deskripsi }}</p>
                        </div>
                        @empty
                        <!-- Tampilan Fallback Placeholder default agar layout terisi manis seperti di gambar -->
                        <div class="mb-4 position-relative">
                            <div class="timeline-dot"></div>
                            <h6 class="fw-bold text-uppercase m-0" style="font-size: 0.85rem;">Senior UI/UX Designer</h6>
                            <div class="text-muted fw-semibold small mb-2">PT Teknologi Aplikasi Mandiri | <span class="text-dark opacity-75">2023 - Sekarang</span></div>
                            <ul class="text-secondary small ps-3">
                                <li>Merancang ulang (redesign) alur transaksi aplikasi seluler dan meningkatkan user retention sebesar 20%.</li>
                                <li>Membangun dan mengelola Design System perusahaan untuk mempercepat alur kerja tim developer hingga 30%.</li>
                            </ul>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Penghargaan -->
                <div>
                    <div class="heading-section">Penghargaan</div>
                    <ul class="text-secondary small ps-3 lh-lg" style="font-size: 0.85rem;">
                        <li>Top 10 Finalist - UI Design Challenge Dicoding 2021</li>
                        <li>Best Design Award - UI Design Challenge Dicoding 2023</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <script src="https://jsdelivr.net"></script>
</body>

</html>