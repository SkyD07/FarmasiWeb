<!DOCTYPE html>
<html lang="en">

<head>
  <title>Detail Pasien</title>
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

    <a href="/pasien" type="button" class="btn btn-back">
        < &nbsp; Kembali
    </a>

    <div class="row row-profile">
        <div class="col-3 mb-4" style="text-align: center">
            <img src="{{ asset('public/ImageUser/'.auth()->user()->avatar) }}" alt="Profile" class="rounded-circle pic-pasien">
        </div>
        <div class="col-9">
            @foreach ($data as $d)
                <h4>
                    {{ $d->name }}
                </h4>
                <label class="id_p">
                    {{ $d->user->username }} / UID
                </label><br>
            @endforeach
            <a href="/edit-pasien-{{ $d->slug }}" type="button" class="btn btn-int">
                Edit Data
            </a>
        </div>
    </div>

    <div class="card-detail">
        <div class="card-hdetail">
            <ul class="nav nav-tabs">
                <li class="nav-ditem">
                    <button class="nav-link {{ Route::currentRouteName() == 'pasien' ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#profile-overview">Data Diri</button>
                </li>
                <li class="nav-ditem">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-riwayat">Riwayat Medik</button>
                </li>
                <li class="nav-ditem">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-log-lab">Log Laboratorium</button>
                </li>
                <li class="nav-ditem">
                    <button class="nav-link {{ Route::currentRouteName() == 'set-timer' ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#profile-time-medic">Waktu Konsumsi Obat</button>
                </li>
                <li class="nav-ditem">
                    <button class="nav-link {{ Route::currentRouteName() == 'keluhan-pasien' ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#profile-drp">DRP</button>
                </li>
            </ul>
        </div>

        <div class="card-bdetail">

            <div class="tab-content pt-2">
                <div class="tab-pane fade show {{ Route::currentRouteName() == 'pasien' ? 'active' : '' }} profile-overview pt-3" id="profile-overview">
                    <div class="row">
                        <div class="col">

                            <h4 class="card-htitle">Informasi Pasien</h4>

                                @foreach ($data as $d)
                                    <h5 class="header-dpasien">Nomor Induk Kewarganegaraan</h5>
                                    <span class="dpasien">
                                        {{ $d->nik }}
                                    </span>

                                    <h5 class="header-dpasien">Nama Lengkap</h5>
                                    <span class="dpasien">
                                        {{ $d->name }}
                                    </span>

                                    <h5 class="header-dpasien">Tanggal Lahir</h5>
                                    <span class="dpasien">
                                        {{ $d->tgl_lahir }}
                                    </span>

                                    <h5 class="header-dpasien">Gender</h5>
                                    <span class="dpasien">
                                        {{ $d->gender }}
                                    </span>

                                    <h5 class="header-dpasien">Emergency Contact</h5>
                                    <span class="dpasien">
                                        {{ $d->user->phone_number }}
                                    </span>

                                    <h5 class="header-dpasien">Helper</h5>
                                    <span class="dpasien">
                                        {{ $d->user->phone_number }}
                                    </span>
                                @endforeach
                            </div>

                            <div class="col">
                                <br><h4 class="card-htitle">Detail Obat Pasien</h4>
                                <h5>
                                    Estimasi Obat Habis :
                                </h5>

                                    <div class="d-flex align-items-center">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th scope="col">Nama Obat</th>
                                                    <th scope="col">Stok Pada Pasien</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($obat as $o)
                                                    <tr>
                                                        <th scope="row">
                                                            {{ $o->nama_obat}}
                                                        </th>
                                                        <td>
                                                            {{ $o->jumlah_obat }}
                                                        </td>
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>

                                    <br><br><h4 class="card-htitle">Schedule Terdekat</h4>

                                    <h5>
                                        Tanggal Bertemu :
                                        @foreach ($data as $d)


                                        @if ($d->status == '0' )

                                        @else
                                            @foreach ($sch as $s)
                                                {{ $s->schedule }}
                                            @endforeach
                                        @endif
                                        @endforeach
                                    </h5>

                                    <div class="modal fade" id="deleteMed" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="dellApolabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h1 class="modal-title fs-5" id="dellApolabel">Delete Account</h1>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="/delete-schedule" method="post" enctype="multipart/form-data">
                                                @csrf

                                                <input type="hidden" name="slug" value="{{ $d->slug }}">
                                                @foreach ($sch as $s)
                                                <input type="hidden" name="id" value="{{ $s->id }}">
                                                @endforeach
                                                <div class="modal-body">
                                                    Are you sure you want to delete this Schedule?
                                                </div>

                                                <div class="modal-footer">
                                                    <button class="btn btn-danger" type="submit">Delete Schedule</button>
                                            </form>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                          </div>
                                        </div>
                                    </div>


                            </div>
                        </div>

                    </div>

                    <div class="tab-pane fade profile-edit pt-3" id="profile-riwayat">
                        <h4 class="card-htitle">Riwayat Medik Pasien</h4>

                        @foreach ($data as $d)
                        <h5 class="header-dpasien">Berat Badan</h5>
                        <span class="dpasien">
                            {{ $d->bb }} Kg
                        </span>

                        <h5 class="header-dpasien">Tinggi Badan</h5>
                        <span class="dpasien">
                            {{ $d->tb }} cm
                        </span>

                        <h5 class="header-dpasien">Tekanan Darah</h5>
                        <span class="dpasien">
                            {{ $d->td_tds }} /  {{ $d->td_tdd }} mmHg
                        </span>

                        <h5 class="header-dpasien">Heart Rate</h5>
                        <span class="dpasien">
                            {{ $d->h_rate }}
                        </span>

                        <h5 class="header-dpasien">History Life</h5>
                        <div class="row">
                            <div class="col-1">
                                Merokok <br>
                                Diet <br>
                                Alkohol
                            </div>
                            <div class="col">
                                {!! $d->cigarettes($d->cigarettes) !!} <br>
                                {!! $d->diet($d->diet) !!} <br>
                                {!! $d->alcohol($d->alcohol) !!}
                            </div>
                        </div>
                    @endforeach

                    </div>
                    <div class="tab-pane fade pt-3" id="profile-log-lab">
                        <h4 class="card-htitle">Log Laboratorium Pasien</h4>

                        <div class="d-flex align-items-center">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">Kolesterol</th>
                                    <th scope="col">Kreatinin</th>
                                    <th scope="col">Gula Darah Puasa</th>
                                    <th scope="col">Gula Darah Sewaktu</th>
                                    <th scope="col">Gula Darah 2 jam PP</th>
                                    <th scope="col">hbA1c</th>
                                    <th scope="col">Log Data</th>
                                </tr>
                                </thead>
                                <tbody>

                                    @foreach ($lab as $l)
                                    <tr>
                                        <td scope="row">
                                            {{ $l->kolesterol}} mg/dl
                                        </td>
                                        <td>
                                            {{ $l->kreatinin }} µmol/L
                                        </td>
                                        <td>
                                            {{ $l->gd_puasa }} mmol/L
                                        </td>
                                        <td>
                                            {{ $l->gd_sewaktu }} mg/dL
                                        </td>
                                        <td>
                                            {{ $l->gd_2jam_pp }} mg/dL
                                        </td>
                                        <td>
                                            {{ $l->hbA1c }} %
                                        </td>
                                        <td>
                                            {{ $l->created_at->isoformat('dddd, D MMMM Y') }}
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="tab-pane fade show {{ Route::currentRouteName() == 'set-timer' ? 'active' : '' }} pt-3" id="profile-time-medic">
                        <h4 class="card-htitle">Waktu Konsumsi Obat Pasien</h4>

                        <div class="d-flex align-items-center">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">Nama Obat</th>
                                    <th scope="col">Jumlah Konsumsi per-Hari</th>
                                    <th scope="col">Waktu Konsumsi</th>
                                    <th scope="col">Sesudah/Sebelum Makan</th>
                                    <th scope="col">Stok Pada Pasien</th>
                                    <th scope="col">TanggaL Pemberian Obat</th>
                                </tr>
                                </thead>
                                <tbody>

                                    @foreach ($obat as $o)
                                    <tr>
                                        <th scope="row">
                                            {{ $o->nama_obat}}
                                        </th>
                                        <td>
                                            {{ $o->dosis_harian }}
                                        </td>
                                        <td>
                                            {{ $o->waktu }}
                                        </td>
                                        <td>
                                            {{ $o->waktu_minum }}
                                        </td>
                                        <td>
                                            {{ $o->jumlah_obat }}
                                        </td>
                                        <td>
                                            {{ $o->created_at->isoformat('dddd, D MMMM Y') }}
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                </div>
                <div class="tab-pane fade show {{ Route::currentRouteName() == 'keluhan-pasien' ? 'active' : '' }} pt-3" id="profile-drp">
                    <h4 class="card-htitle">DRP Pasien</h4>

                    <h4> Pertanyaan</h4>
                    <span class="dpasien">
                        Jawaban Pasien
                    </span>

                </div>


        </div><!-- End Bordered Tabs -->

    </div>


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    @include('layouts.footer')
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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
