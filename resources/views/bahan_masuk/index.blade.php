<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inventori Bahan Masuk</title>
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
                    </ul>
                </nav>
        <main class="col-md-10 ms-sm aoto px-md-4 py-4">
        <div class="container mt-5">
            <div class="card shadow">
                <div class="card-header bg-success text-white d-flex justify-content-between">
                    <h5 class="mb-0">Daftar Bahan Masuk</h5>
                    <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
                        + Tambah Bahan Masuk
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
                        <th>Jumlah</th>
                        <th>Tanggal Masuk</th>
                        <th>Metode Pembayaran</th>
                        <th>Jatuh Tempo</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($semua_bahan_masuk as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->kode_bahan }}</td>
                        <td>{{ $row->nama_bahan }}</td>
                        <td>{{ $row->jumlah }}</td>
                        <td>{{ $row->tanggal_masuk }}</td>
                        <td>{{ $row->metode_pembayaran }}</td>
                        <td>{{ $row->jatuh_tempo }}</td>
                        </tr>
                        @empty
                        <tr>
                        <td colspan="8" class="text-center">Tidak ada data bahan masuk.</td>
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

        <!-- Modal Tambah Bahan Masuk -->
        <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('bahan_masuk.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Bahan Masuk Baru</h5>
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
                                <label class="form-label">Jumlah</label>
                                <input type="number" name="jumlah" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Masuk</label>
                                <input type="date" name="tanggal_masuk" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Metode Pembayaran</label>
                                <select name="metode_pembayaran" class="form-control" required>
                                    <option value="">Pilih Metode Pembayaran</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Transfer">Transfer</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jatuh Tempo</label>
                                <input type="date" name="jatuh_tempo" class="form-control">
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
