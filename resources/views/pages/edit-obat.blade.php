<!DOCTYPE html>
<html lang="en">

<head>
  <title>Edit Obat</title>
    @include('layouts.head')
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    @include('layouts.header')
  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    @include('layouts.sidebar')
    </aside><!-- End Sidebar-->

  <main id="main" class="main">

    @if (session()-> has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="row row-profile">
        <div class="col-3 mb-4" style="text-align: center">
            @foreach ($data as $d)
            <img src="{{ asset('public/ObatPic/'.$d->gambar) }}" alt="Profile" class="pic-obat">
        </div>
        <div class="col-9">

                <h4>
                    {{ $d->nama_obat }}
                </h4>
            @endforeach
            <form action="/update-obat" enctype="multipart/form-data" method="POST">
                @csrf

            <button type="submit" class="btn btn-int">
                Save Data
            </button>

        </div>
    </div>

    <div class="card-detail">

        <div class="card-bdetail">

            <div class="tab-content pt-2">
                    <div class="row">
                        <div class="col">

                            <h4 class="card-htitle mt-3">Informasi Obat</h4>

                                @foreach ($data as $d)

                                    <input type="hidden" name="slug" value="{{ $d->slug }}">
                                    <h5 class="header-dpasien">Nama Obat</h5>
                                    <div class="mb-3 row">
                                        <div class="align-items-end col-sm-4">
                                          <input type="text" name="nama_obat" value="{{ $d->nama_obat }}" class="form-control int-lbl" required>
                                        </div>
                                    </div>

                                    <h5 class="header-dpasien">Stok Obat</h5>
                                    <div class="mb-3 row">
                                        <div class="align-items-end col-sm-4">
                                          <input type="text" name="stock_obat" value="{{ $d->stock_obat }}" class="form-control int-lbl" required>
                                        </div>
                                    </div>

                                    <h5 class="header-dpasien">Ganti Foto Obat</h5>
                                    <div class="mb-3 row">
                                        <div class="align-items-end col-sm-4">
                                            <input type="file" class="form-control int-lbl" name="gambar" placeholder="yes">
                                        </div>
                                    </div>

                                @endforeach
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End Bordered Tabs -->


        <div class="modal fade" id="delMed-{{ $d->slug }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="dellApolabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="dellApolabel">Hapus Data Obat</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Anda yakin ingin menghapus data obat ini?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                  <a href="/delete-obat-{{ $d->slug }}" class="btn btn-danger">Hapus Data</a>
                </div>
              </div>
            </div>
        </div>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    @include('layouts.footer')
  </footer><!-- End Footer -->


  <!-- Vendor JS Files -->
  <script src="Admin/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="Admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="Admin/vendor/chart.js/chart.min.js"></script>
  <script src="Admin/vendor/echarts/echarts.min.js"></script>
  <script src="Admin/vendor/quill/quill.min.js"></script>
  <script src="Admin/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="Admin/vendor/tinymce/tinymce.min.js"></script>
  <script src="Admin/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="Admin/js/main.js"></script>

</body>

</html>
