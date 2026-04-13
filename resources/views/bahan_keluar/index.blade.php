<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inventori Bahan Keluar</title>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    </head>

    <body class="bg-light">

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-dark sidebar min-vh-100 p-3">
                    <h4 class="text-white">Bakery Inv</h4>
                    <hr class=text-white>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <a class="nav-link text-white {{ request()->is('/') ? 'bg-secondary' : '' }}" href="{{ url('/') }}">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link text-white {{ request()->is('bahan_masuk') ? 'bg-secondary' : '' }}" href="{{ route('bahan_masuk.index') }}">
                                Bahan Masuk
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link text-white {{ request()->is('bahan_keluar') ? 'bg-secondary' : '' }}" href="{{ route('bahan_keluar.index') }}">
                                Bahan Keluar
                            </a>
                        </li>
                    </ul>
                </nav>
        <main class="col-md-10 ms-sm aoto px-md-4 py-4">
        <div class="container mt-5">
            <div class="card shadow">
                <div class="card-header bg-success text-white d-flex justify-content-between">
                    <h5 class="mb-0">Daftar Bahan Keluar</h5>
                    <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalKurang">
                        + Input Bahan Keluar
                    </button>
                </div>
                @if(session('success'))
                    <div class="alert alert-success m-3">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card-body">
                </div>
            </div>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Kode Bahan</th>
                        <th>Nama Bahan</th>
                        <th>Jumlah Keluar</th>
                        <th>Tanggal Keluar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($semua_bahan_keluar as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->kode_bahan }}</td>
                        <td>{{ $row->nama_bahan }}</td>
                        <td>{{ $row->jumlah_keluar }}</td>
                        <td>{{ $row->tanggal_keluar }}</td>
                        </tr>
                        @empty
                        <tr>
                        <td colspan="8" class="text-center">Tidak ada data bahan keluar.</td>
                            @endforelse
                        </tr>
                    </tbody>
                </table>
                </div>
                </div>
            </div>
        </div>
    </main>
</div>
            <button type="button" class="btn btn-secondary btn-sm" onclick="window.location.href='{{route('bahan.index')}}'">
               Kembali ke Stok Bahan
            </button>

        </div>

        <!-- Modal Tambah Bahan Keluar -->
        <div class="modal fade" id="modalKurang" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('bahan_keluar.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">input pemakaian barang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Kode Bahan</label>
                                <input type="text" name="kode_bahan" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Bahan</label>
                                <input type="text" name="nama_bahan" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jumlah Keluar</label>
                                <input type="number" name="jumlah_keluar" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Keluar</label>
                                <input type="date" name="tanggal_keluar" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                    <!-- Form untuk tambah bahan masuk -->
                    <!-- ... (form fields dan submit button) ... -->
                </div>
            </div>
        </div>

        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
