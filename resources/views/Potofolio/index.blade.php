<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar CV - Admin Panel</title>
    <link href="https://jsdelivr.net" rel="stylesheet">
</head>
<body class="bg-light py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Manajemen Data CV</h2>
            <a href="{{ route('cv.create') }}" class="btn btn-primary">+ Tambah CV Baru</a>
        </div>

        <!-- Notifikasi Flash Data Sukses -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover table-striped mb-0 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%">#</th>
                            <th>Nama Lengkap</th>
                            <th>Peran / Profesi</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th width="25%" class="text-center">Aksi (CRUD)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataCv as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                class="fw-bold">{{ $item->nama }}</td>
                                <td>{{ $item->peran }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td class="text-center">
                                    <!-- R - Read (Detail) -->
                                    <a href="{{ route('cv.show', $item->cv_id) }}" class="btn btn-sm btn-secondary" target="_blank">Lihat CV</a>
                                    
                                    <!-- U - Update -->
                                    <a href="{{ route('cv.edit', $item->cv_id) }}" class="btn btn-sm btn-info text-white">Edit</a>
                                    
                                    <!-- D - Destroy (Hapus via Form Request) -->
                                    <form action="{{ route('cv.destroy', $item->cv_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus CV ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Belum ada data CV yang terdaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <script src="https://jsdelivr.net"></script>
</body>
</html>
