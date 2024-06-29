@extends('layouts.master')

@section('title', 'Profil Pelanggan')
@section('css')

@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profil Pelanggan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Profil Pelanggan</a></li>
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline">
                        {{-- <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  Vertical Tabs Examples
                </h3>
              </div> --}}
                        <div class="card-body">
                            @include('include.admin.alert')
                            {{-- <h4>Left Sided</h4> --}}
                            <form action="{{ route('profil-pelanggan.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill"
                                            href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home"
                                            aria-selected="true">Legalitas Produsen</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                            href="#custom-tabs-one-profile" role="tab"
                                            aria-controls="custom-tabs-one-profile" aria-selected="false">Korespondensi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill"
                                            href="#custom-tabs-one-messages" role="tab"
                                            aria-controls="custom-tabs-one-messages" aria-selected="false">Teknis
                                            Produksi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill"
                                            href="#custom-tabs-one-settings" role="tab"
                                            aria-controls="custom-tabs-one-settings" aria-selected="false">Organisasi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-smm-tab" data-toggle="pill"
                                            href="#custom-tabs-one-smm" role="tab" aria-controls="custom-tabs-one-smm"
                                            aria-selected="false">Sistem Manajemen</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-ppj-tab" data-toggle="pill"
                                            href="#custom-tabs-one-ppj" role="tab" aria-controls="custom-tabs-one-ppj"
                                            aria-selected="false">Perusahaan Penanggung Jawab (Untuk Produsen Luar Negeri)</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-home-tab">
                                        <br />
                                        <h5>Akun Pelanggan</h5>
                                        <hr style="border:1px solid blue;">
                                        <div class="form-group row">
                                            <label for="id_perusahaan" class="col-sm-4 col-form-label">ID Perusahaan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="id_perusahaan"
                                                    placeholder="ID Perusahaan" readonly value="{{ $klien[0]['id_perusahaan'] }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-4 col-form-label">Jenis Badan
                                                Usaha</label>
                                            <div class="col-sm-8">
                                                <select name="jenis_badan_usaha" class="form-control">
                                                    <option value="">--</option>
                                                    <option {{ $klien[0]['jenis_badan_usaha'] == 'UD' ? 'selected' : '' }} value="UD">UD</option>
                                                    <option {{ $klien[0]['jenis_badan_usaha'] == 'Fa' ? 'selected' : '' }} value="Fa">Fa</option>
                                                    <option {{ $klien[0]['jenis_badan_usaha'] == 'CV' ? 'selected' : '' }} value="CV">CV</option>
                                                    <option {{ $klien[0]['jenis_badan_usaha'] == 'Koperasi' ? 'selected' : '' }} value="Koperasi">Koperasi</option>
                                                    <option {{ $klien[0]['jenis_badan_usaha'] == 'PJ' ? 'selected' : '' }} value="PJ">PJ</option>
                                                    <option {{ $klien[0]['jenis_badan_usaha'] == 'Perum' ? 'selected' : '' }} value="Perum">Perum</option>
                                                    <option {{ $klien[0]['jenis_badan_usaha'] == 'PT' ? 'selected' : '' }} value="PT">PT</option>
                                                    <option {{ $klien[0]['jenis_badan_usaha'] == 'Yayasan' ? 'selected' : '' }} value="Yayasan">Yayasan</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nama Perusahaan
                                                Produsen</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan"
                                                    placeholder="Nama Perusahaan Produsen" value="{{ $klien[0]['nama_perusahaan'] }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="ln_dn" class="col-sm-4 col-form-label">Jenis Produsen</label>
                                            <div class="col-sm-8">
                                                <select name="ln_dn" class="form-control">
                                                    <option value="">--</option>
                                                    <option {{ $klien[0]['ln_dn'] == 'LN' ? 'selected' : '' }} value="LN">Luar Negeri</option>
                                                    <option {{ $klien[0]['ln_dn'] == 'DN' ? 'selected' : '' }} value="DN">Dalam Negeri</option>
                                                    <option {{ $klien[0]['ln_dn'] == 'DK' ? 'selected' : '' }} value="DK">Dalam Kota</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br />
                                        <h5>Akta Pendirian Perusahaan</h5>
                                        <hr style="border:1px solid blue;">
                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-5 col-form-label">Salinan Akta
                                                Pendirian Perusahaan</label>
                                            <div class="col-sm-7">
                                                <input type="file" name="salinan_akta_pendirian_perusahaan" onchange="validateFile()"
                                                    id="salinanAktaPendirianPerusahaan" class="form-control">
                                                <input type="hidden" name="salinan_akta_pendirian_perusahaan_old" value="{{ count($klien) ? $klien[0]['salinan_akta_pendirian_perusahaan'] : '' }}">
                                                <div style="margin-top:10px; display: none;" id="alertSalinanExtention"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File Harus berupa PDF
                                                </div>

                                                <div style="margin-top:6px; display: none;" id="alertSalinanPDF"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 1
                                                    MB
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-5 col-form-label">Salinan Akta
                                                Pendirian Perusahaan Terjemahan Tersumpah</label>
                                            <div class="col-sm-7">
                                                <input type="file" name="salinan_akta_pendirian_perusahaan_tersumpah" onchange="validateFileTersumpah()"
                                                    id="salinanAktaPendirianPerusahaanTersumpah" class="form-control">
                                                <input type="hidden" name="salinan_akta_pendirian_perusahaan_tersumpah_old" value="{{ count($klien) ? $klien[0]['salinan_akta_pendirian_perusahaan_tersumpah'] : '' }}">
                                                <div style="margin-top:10px; display: none;"
                                                    id="alertSalinanExtentionTersumpah"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File Harus berupa PDF
                                                </div>

                                                <div style="margin-top:6px; display: none;" id="alertSalinanPDFTersumpah"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 1
                                                    MB
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-5 col-form-label">Nama
                                                Notaris</label>
                                            <div class="col-sm-7">
                                                
                                                <input type="text" name="nama_notaris_akta_pendiri" class="form-control" value="{{ count($klien) ? $klien[0]['nama_notaris_akta_pendiri'] : '' }}" placeholder="Nama Notaris">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-5 col-form-label">Kedudukan
                                                Notaris</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="kedudukan_notaris_akta_pendiri" value="{{ count($klien) ? $klien[0]['kedudukan_notaris_akta_pendiri'] : '' }}" class="form-control"
                                                    placeholder="Kedudukan Notaris">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-5 col-form-label">Tanggal Akta
                                                Pendirian Perusahaan</label>
                                            <div class="col-sm-7">
                                                <input type="date" name="tanggal_akta_pendiri" value="{{ count($klien) ? $klien[0]['tanggal_akta_pendiri'] : '' }}" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-5 col-form-label">Nomor Akta
                                                Pendirian Perusahaan</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="nomor_akta_pendiri" value="{{ count($klien) ? $klien[0]['nomor_akta_pendiri'] : '' }}" class="form-control"
                                                    placeholder="Nomor Akta Pendirian Perusahaan">
                                            </div>
                                        </div>

                                        <br />
                                        <h5>Akta Perubahan Pendirian Perusahaan</h5>
                                        <hr style="border:1px solid blue;">
                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-5 col-form-label">Salinan Akta
                                                Pendirian Perusahaan</label>
                                            <div class="col-sm-7">
                                                <input type="file" name="salinan_akta_perubahan_perusahaan" onchange="validateFilePerubahan()"
                                                    id="salinanAktaPerubahanPendirianPerusahaan" class="form-control">
                                                <input type="hidden" name="salinan_akta_perubahan_perusahaan_old" value="{{ count($klien) ? $klien[0]['salinan_akta_perubahan_perusahaan'] : '' }}">
                                                <div style="margin-top:10px; display: none;"
                                                    id="alertSalinanExtentionPerubahan"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File Harus berupa PDF
                                                </div>

                                                <div style="margin-top:6px; display: none;" id="alertSalinanPDFPerubahan"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 1
                                                    MB
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-5 col-form-label">Salinan Akta
                                                Pendirian Perusahaan Terjemahan Tersumpah</label>
                                            <div class="col-sm-7">
                                                <input type="file" name="salinan_akta_perubahan_perusahaan_tersumpah" onchange="validateFilePerubahanTersumpah()"
                                                    id="salinanAktaPerubahanPendirianPerusahaanTersumpah"
                                                    class="form-control">
                                                <input type="hidden" name="salinan_akta_perubahan_perusahaan_tersumpah_old" value="{{ count($klien) ? $klien[0]['salinan_akta_perubahan_perusahaan_tersumpah'] : '' }}">
                                                <div style="margin-top:10px; display: none;"
                                                    id="alertSalinanExtentionTersumpahPerubahan"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File Harus berupa PDF
                                                </div>

                                                <div style="margin-top:6px; display: none;"
                                                    id="alertSalinanPDFTersumpahPerubahan"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 1
                                                    MB
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-5 col-form-label">Nama
                                                Notaris</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="nama_notaris" class="form-control" value="{{ count($klien) ? $klien[0]['nama_notaris'] : '' }}" placeholder="Nama Notaris">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-5 col-form-label">Kedudukan
                                                Notaris</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="kedudukan_notaris" class="form-control"
                                                    placeholder="Kedudukan Notaris" value="{{ count($klien) ? $klien[0]['nama_notaris'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-5 col-form-label">Tanggal Akta
                                                Pendirian Perusahaan</label>
                                            <div class="col-sm-7">
                                                <input type="date" name="tanggal" class="form-control" value="{{ count($klien) ? $klien[0]['tanggal'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-5 col-form-label">Nomor Akta
                                                Pendirian Perusahaan</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="nomor_akta" class="form-control" value="{{ count($klien) ? $klien[0]['nomor_akta'] : '' }}"
                                                    placeholder="Nomor Akta Pendirian Perusahaan">
                                            </div>
                                        </div>

                                        <br />
                                        <h5>Izin Usaha Industri</h5>
                                        <hr style="border:1px solid blue;">

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-5 col-form-label">Salinan Izin
                                                Industri</label>
                                            <div class="col-sm-7">
                                                <input type="file" name="salinan_izin_industri" onchange="validateFileIndustri()"
                                                    id="salinanIzinIndustri" class="form-control">
                                                <input type="hidden" name="salinan_izin_industri_old" value="{{ count($klien) ? $klien[0]['salinan_izin_industri'] : '' }}">
                                                <div style="margin-top:10px; display: none;"
                                                    id="alertSalinanExtentionIndustri"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File Harus berupa PDF
                                                </div>

                                                <div style="margin-top:6px; display: none;" id="alertSalinanPDFIndustri"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 1
                                                    MB
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-5 col-form-label">Salinan Izin
                                                Industri Terjemahan Tersumpah</label>
                                            <div class="col-sm-7">
                                                <input type="file" name="salinan_izin_industri_tersumpah" onchange="validateFileIndustriTersumpah()"
                                                    id="salinanIzinIndustriTersumpah" class="form-control">
                                                <input type="hidden" name="salinan_izin_industri_tersumpah_old" value="{{ count($klien) ? $klien[0]['salinan_izin_industri_tersumpah'] : '' }}">
                                                <div style="margin-top:10px; display: none;"
                                                    id="alertSalinanExtentionIndustriTersumpah"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File Harus berupa PDF
                                                </div>

                                                <div style="margin-top:6px; display: none;"
                                                    id="alertSalinanPDFIndustriTersumpah"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 1
                                                    MB
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-5 col-form-label">Nomor Induk
                                                Berusaha</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="NIB" class="form-control"
                                                    placeholder="Nomor Induk Berusaha" value="{{ count($klien) ? $klien[0]['NIB'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-5 col-form-label">Instansi Penerbit
                                                NIB</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="instansi_penerbit" class="form-control"
                                                    placeholder="Instansi Penerbit NIB">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-5 col-form-label">Jenis Angka
                                                Pengenal Importir</label>
                                            <div class="col-sm-7">
                                                <select name="jenis_angka_pengenal_importir" class="form-control">
                                                    <option value="">--</option>
                                                    <option value="Angka Pengenal Importir-Produsen">Angka Pengenal
                                                        Importir-Produsen</option>
                                                    <option value="Angka Pengenal Importir-Umum">Angka Pengenal
                                                        Importir-Umum</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-5 col-form-label">Status Penanaman
                                                Modal</label>
                                            <div class="col-sm-7">
                                                <select name="status_penanaman_modal" class="form-control">
                                                    <option value="">--</option>
                                                    <option value="Penanaman Modal Asing">Penanaman Modal Asing</option>
                                                    <option value="Penanaman Dalam Negeri">Penanaman Dalam Negeri</option>
                                                </select>
                                            </div>
                                        </div>

                                        <h5>KBLI</h5>
                                        <hr style="border:1px solid #007bff">
                                        <table id="KBLI" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width: 9%;">Action</th>
                                                    <th>Kode KBLI</th>
                                                    <th>Nama KBLI</th>
                                                    <th>Lokasi Usaha</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td>

                                                        <a onclick="createKBLI()" class="btn btn-success"><i
                                                                class="fas fa-plus"></i></a>
                                                    </td>
                                                    <td colspan="3"></td>

                                                </tr>

                                            </tbody>
                                        </table>

                                        <br />
                                        <h5>Nomor Pokok Wajib Pajak</h5>
                                        <hr style="border:1px solid blue;">

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nomor
                                                NPWP</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nomor_npwp" class="form-control" placeholder="Nomor NPWP">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Salinan
                                                NPWP</label>
                                            <div class="col-sm-8">
                                                <input type="file" name="salinan_npwp" class="form-control" onchange="salinanNPWP()"
                                                    id="salinanNPWP">
                                                <div style="margin-top:10px; display: none;" id="salinanNPWPExtention"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File Harus berupa .JPG/
                                                    .JPEG/ .PNG
                                                </div>

                                                <div style="margin-top:6px; display: none;" id="salinanNPWPSize"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 1
                                                    MB
                                                </div>
                                            </div>
                                        </div>

                                        <br />
                                        <h5>Kantor</h5>
                                        <hr style="border:1px solid blue;">

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Alamat</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="alamat" class="form-control" placeholder="Alamat Kantor">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Provinsi</label>
                                            <div class="col-sm-8">
                                                <select name="provinsi" class="form-control select2" id="">
                                                    <option value=""></option>
                                                    @foreach ($provinsi as $p)
                                                        <option value="{{ $p['name'] }}">{{ $p['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Negara</label>
                                            <div class="col-sm-8">
                                                <select name="negara" class="form-control select2" id="">
                                                    <option value=""></option>
                                                    @foreach ($country as $p)
                                                        <option value="{{ $p['country_name'] }}">{{ $p['country_name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Website</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="website" class="form-control" placeholder="Website">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nomor
                                                Telepon</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nomor_telepon" class="form-control" placeholder="Nomor Telepon">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Email</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="email" class="form-control" placeholder="Email">
                                            </div>
                                        </div>

                                        <br />
                                        <h5>Lokasi Usaha/ Pabrik</h5>
                                        <hr style="border:1px solid blue;">
                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Alamat</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="alamat_pabrik" class="form-control" placeholder="Alamat Pabrik">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Provinsi</label>
                                            <div class="col-sm-8">
                                                <select name="provinsi_pabrik" class="form-control select2" id="">
                                                    <option value=""></option>
                                                    @foreach ($provinsi as $p)
                                                        <option value="{{ $p['name'] }}">{{ $p['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Negara</label>
                                            <div class="col-sm-8">
                                                <select name="negara_pabrik" class="form-control select2" id="">
                                                    <option value=""></option>
                                                    @foreach ($country as $p)
                                                        <option value="{{ $p['country_name'] }}">{{ $p['country_name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Website</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="website_pabrik" class="form-control" placeholder="Website">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nomor
                                                Telepon</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nomor_telepon_pabrik" class="form-control" placeholder="Nomor Telepon">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Email</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="email_pabrik" class="form-control" placeholder="Email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-profile-tab">
                                        <br />
                                        <h5>Direktur</h5>
                                        <hr style="border:1px solid blue;">
                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nama</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nama_direktur" class="form-control" placeholder="Nama">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nama_perusahaan"
                                                class="col-sm-4 col-form-label">Kewarganegaraan</label>
                                            <div class="col-sm-8">
                                                <select name="negara_direktur" class="form-control select2" id="">
                                                    <option value=""></option>
                                                    @foreach ($country as $p)
                                                        <option value="{{ $p['country_name'] }}">{{ $p['country_name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Alamat</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="alamat_direktur" class="form-control" placeholder="Alamat">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nomor
                                                Telepon</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nomor_telepon_direktur" class="form-control" placeholder="Nomor Telepon">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Email</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="email_direktur" class="form-control" placeholder="Email">
                                            </div>
                                        </div>
                                        <br />
                                        <h5>Wakil Manajemen</h5>
                                        <hr style="border:1px solid blue;">
                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nama</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nama_sm" class="form-control" placeholder="Nama">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nama_perusahaan"
                                                class="col-sm-4 col-form-label">Kewarganegaraan</label>
                                            <div class="col-sm-8">
                                                <select name="negara_sm" class="form-control select2" id="">
                                                    <option value=""></option>
                                                    @foreach ($country as $p)
                                                        <option value="{{ $p['country_name'] }}">{{ $p['country_name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Alamat</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="alamat_sm" class="form-control" placeholder="Alamat">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nomor
                                                Telepon</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nomor_telepon_sm" class="form-control" placeholder="Nomor Telepon">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Email</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="email_sm" class="form-control" placeholder="Email">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Jabatan</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="jabatan_sm" class="form-control" placeholder="Jabatan">
                                            </div>
                                        </div>


                                        <br />
                                        <h5>Penghubung</h5>
                                        <hr style="border:1px solid blue;">
                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nama</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nama_penghubung" class="form-control" placeholder="Nama">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nama_perusahaan"
                                                class="col-sm-4 col-form-label">Kewarganegaraan</label>
                                            <div class="col-sm-8">
                                                <select name="negara_penghubung" class="form-control select2" id="">
                                                    <option value=""></option>
                                                    @foreach ($country as $p)
                                                        <option value="{{ $p['country_name'] }}">{{ $p['country_name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Alamat</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="alamat_penghubung" class="form-control" placeholder="Alamat">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nomor
                                                Telepon</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nomor_telepon_penghubung" class="form-control" placeholder="Nomor Telepon">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Email</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="email_penghubung" class="form-control" placeholder="Email">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Jabatan</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="jabatan_penghubung" class="form-control" placeholder="Jabatan">
                                            </div>
                                        </div>

                                        <br />
                                        <h5>Alamat Koresponden</h5>
                                        <hr style="border:1px solid blue;">
                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nama</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nama_koresponden" class="form-control" placeholder="Nama">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Alamat</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="alamat_koresponden" class="form-control" placeholder="Alamat">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nomor
                                                Telepon</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nomor_telepon_koresponden" class="form-control" placeholder="Nomor Telepon">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Email</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="email_koresponden" class="form-control" placeholder="Email">
                                            </div>
                                        </div>



                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-messages-tab">
                                        <br />
                                        <h5>Teknis Produksi</h5>
                                        <hr style="border:1px solid blue;">
                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Alur Proses
                                                Produksi</label>
                                            <div class="col-sm-8">
                                                <input type="file" name="alur_proses_produksi" onchange="validateFileAlurProd()" id="alurProsesProd" class="form-control">
                                                <div style="margin-top:10px; display: none;" id="alertAlurProdExtention"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File Harus berupa PDF
                                                </div>

                                                <div style="margin-top:6px; display: none;" id="alertAlurProdSize"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 1
                                                    MB
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Peta Proses
                                                Bisnis</label>
                                            <div class="col-sm-8">
                                                <input type="file" name="peta_proses_bisnis" onchange="validFilePeta()" id="petaProses" class="form-control">
                                                <div style="margin-top:10px; display: none;" id="alertPetaProsesExtention"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File Harus berupa PDF
                                                </div>

                                                <div style="margin-top:6px; display: none;" id="alertPetaSize"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 1
                                                    MB
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Denah Lokasi
                                                Usaha</label>
                                            <div class="col-sm-8">
                                                <input type="file" name="denah_lokasi_usaha" onchange="validFileDenah()" id="denahLokasi" class="form-control">
                                                <div style="margin-top:10px; display: none;" id="alertPetaDenahExtention"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File Harus berupa PDF
                                                </div>

                                                <div style="margin-top:6px; display: none;" id="alertPetaDenahSize"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 1
                                                    MB
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Daftar Peralatan
                                                Produksi</label>
                                            <div class="col-sm-8">
                                                <input type="file" name="daftar_peralatan_produksi" onchange="validFileDaftarProd()" id="daftarPeralatanProd" class="form-control">
                                                <div style="margin-top:10px; display: none;" id="alertdaftarPeralatanProdExtention"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File Harus berupa PDF
                                                </div>

                                                <div style="margin-top:6px; display: none;" id="alertdaftarPeralatanProdSize"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 1
                                                    MB
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Daftar Peralatan
                                                Inspeksi</label>
                                            <div class="col-sm-8">
                                                <input type="file" name="daftar_peralatan_inspeksi" onchange="validDaftarPeralatan()" id="daftarPeralatanIns" class="form-control">
                                                <div style="margin-top:10px; display: none;" id="alertdaftarPeralatanInsExtention"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File Harus berupa PDF
                                                </div>

                                                <div style="margin-top:6px; display: none;" id="alertdaftarPeralatanInsSize"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 1
                                                    MB
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Jumlah Tahapan
                                                Proses</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="jumlah_tahapan_proses" class="form-control"
                                                    placeholder="Jumlah Tahapan Proses">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Jumlah Shift Per
                                                Hari</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="jumlah_shift_per_hari" class="form-control"
                                                    placeholder="Jumlah Shift Per Hari">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Kapasitas
                                                Produksi Per Hari</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="kapasitas_produksi_per_hari" class="form-control"
                                                    placeholder="Kapasitas Produksi Per Hari">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Line
                                                Produksi</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="line_produksi" class="form-control" placeholder="Line Produksi">
                                            </div>
                                        </div>

                                        <br />
                                        <h5>Sub Kontrak</h5>
                                        <hr style="border:1px solid blue;">
                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Total Proses
                                                Sub-Kontrak</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="total_proses_sub_kontrak" class="form-control"
                                                    placeholder="Total Proses Sub-Kontrak">
                                            </div>
                                        </div>


                                        <table id="subKontrak" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width: 9%;">Action</th>
                                                    <th>Proses Sub-Kontrak</th>
                                                    <th>Nama Perusahaan Sub-Kontrak</th>
                                                    <th>Alamat Perusahaan Sub-Kontrak</th>
                                                    <th>Persentase Proses Sub-Kontrak</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td>

                                                        <a onclick="createSubKontrak()" class="btn btn-success"><i
                                                                class="fas fa-plus"></i></a>
                                                    </td>
                                                    <td colspan="4"></td>

                                                </tr>

                                            </tbody>
                                        </table>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Sistem Produksi</label>
                                            <div class="col-sm-8">
                                                <select name="sistem_produksi" id="" class="form-control">
                                                    <option value="By Order">By Order</option>
                                                    <option value="By Continue">By Continue</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Bahasa yang
                                                Digunakan di Pabrik</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="bahasa" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Kesanggupan
                                                Menyediakan Penerjemah</label>
                                            <div class="col-sm-8">
                                                <select name="menyediakan_penerjemah" id="" class="form-control">
                                                    <option value="Ya">Ya</option>
                                                    <option value="Tidak">Tidak</option>
                                                </select>
                                                Note : Jika Tidak Menggunakan Bahasa Indonesia Maka Diperlukan Penerjemah
                                                untuk Setiap Auditor dan PPC
                                            </div>

                                        </div>
                                        <br />
                                        <h5>Transportasi</h5>
                                        <hr style="border:1px solid blue;">
                                        <table id="transportasi" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width: 9%;">Action</th>
                                                    <th>Asal</th>
                                                    <th>Tujuan</th>
                                                    <th>Rute</th>
                                                    <th>Moda</th>
                                                    <th>Jarak tempuh</th>
                                                    <th>Waktu</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td>

                                                        <a onclick="createTransportasi()" class="btn btn-success"><i
                                                                class="fas fa-plus"></i></a>
                                                    </td>
                                                    <td colspan="6"></td>

                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-settings-tab">
                                        <br/>
                                        <h5>Organisasi</h5>
                                        <hr style="border:1px solid blue;">
                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">SDM dan Struktur Organisasi</label>
                                            <div class="col-sm-8">
                                                <input type="file" name="sdm_dan_struktur_organisasi" onchange="validSdmStruktur()" id="sdmStrukturOrganisasi" class="form-control">
                                                <div style="margin-top:10px; display: none;" id="alertsdmStrukturOrganisasiExtention"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File Harus berupa PDF
                                                </div>

                                                <div style="margin-top:6px; display: none;" id="alertsdmStrukturOrganisasiSize"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 1
                                                    MB
                                                </div>

                                            </div>
                                        </div>
                                        <br/>
                                        <h5>Jumlah Tenaga Kerja</h5>
                                        <hr style="border:1px solid blue;">
                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Tenaga Kerja bagian Mutu/Quality</label>
                                            <div class="col-sm-8">
                                                <input type="number" name="jml_bag_mutu_quality" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Tenaga Kerja Bagian Produksi</label>
                                            <div class="col-sm-8">
                                                <input type="number" name="jml_bag_produksi" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Tenaga Kerja Selain Bagian Mutu dan Produksi</label>
                                            <div class="col-sm-8">
                                                <input type="number" name="jml_selain_bag_mutu_produksi" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Jumlah Karyawan terkait Produk Disertifikasi</label>
                                            <div class="col-sm-8">
                                                <input type="number" name="jml_kary_produksi" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Jam Kerja Per Hari</label>
                                            <div class="col-sm-8">
                                                <input type="number" name="jml_kerja_per_hari" class="form-control">
                                            </div>
                                        </div>
                                        <br/>
                                        <h5>Struktur Organisasi</h5>
                                        <hr style="border:1px solid blue;">
                                        <table id="strukturOrganisasi" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width: 9%;">Action</th>
                                                    <th>Nama Divisi</th>
                                                    <th>Tanggung Jawab dan Wewenang</th>
                                                    <th>Jumlah Personil</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td>

                                                        <a onclick="createStrukturOrganisasi()" class="btn btn-success"><i
                                                                class="fas fa-plus"></i></a>
                                                    </td>
                                                    <td colspan="3"></td>

                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-one-smm" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-smm-tab">
                                        <br/>
                                        <h5>Sistem Manajemen</h5>
                                        <hr style="border:1px solid blue;">
                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Pedoman Sistem Manajemen</label>
                                            <div class="col-sm-8">
                                                <input type="file" name="pedoman_sistem_manajemen" onchange="pedomanSm()" id="pedomanSistemManajemen" class="form-control">
                                                <div style="margin-top:10px; display: none;" id="alertSMExtention"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File Harus berupa PDF
                                                </div>

                                                <div style="margin-top:6px; display: none;" id="alertSMSize"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 1
                                                    MB
                                                </div>

                                            </div>
                                        </div>

                                        <br/>
                                        <h5>Pedoman Sistem Manajemen</h5>
                                        <hr style="border:1px solid blue;">
                                        <div style="margin-top:10px; display: none;" id="pedomanSistemExtention"
                                            class="alert alert-danger alert-dipenghubungissible" role="alert">
                                            <i class="fas fa-exclamation-circle"></i> File Harus berupa PDF
                                        </div>

                                        <div style="margin-top:6px; display: none;" id="pedomanSistemSize"
                                            class="alert alert-danger alert-dipenghubungissible" role="alert">
                                            <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 1
                                            MB
                                        </div>

                                        <table id="pedomanSistem" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width: 9%;">Action</th>
                                                    <th>Jenis Sistem Manajemen</th>
                                                    <th>Versi Standar Sistem Manajemen</th>
                                                    <th>Lembaga Sertifikasi</th>
                                                    <th>Nomor Sertifikat</th>
                                                    <th>Masa Berlaku Sertifikat Hingga</th>
                                                    <th>Logo Sertifikat</th>
                                                    <th>Ruang Lingkup</th>
                                                    <th>Penerapan</th>
                                                    <th>Nama Konsultan</th>
                                                    <th>Tahun Konsultan</th>
                                                    <th>Sertifikat</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td>

                                                        <a onclick="createPedomanSistem()" class="btn btn-success"><i
                                                                class="fas fa-plus"></i></a>
                                                    </td>
                                                    <td colspan="11"></td>

                                                </tr>

                                            </tbody>
                                        </table>
                                        <br/>
                                        <h5>Kepemilikan Sertifikasi dari Lembaga Lain</h5>
                                        <hr style="border:1px solid blue;">
                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Apakah pabrik pernah mendapatkan SPPT SNI dari Lembaga Sertifikasi Produk Lain di Indonesia?</label>
                                            <div class="col-sm-8">
                                                <select name="kepemilikan_sertifikasi_ll" onchange="kepemilikan(this.value)" class="form-control">
                                                    <option value="-">-</option>
                                                    <option value="Ya">Ya</option>
                                                    <option value="Tidak">Tidak</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div id="namaLembaga" style="display: none;">
                                            <div class="form-group row">
                                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nama Lembaga Sertifikasi</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="nama_lembaga" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <br/>
                                        <h5>Sertifikat SPPT SNI</h5>
                                        <hr style="border:1px solid blue;">
                                        <table id="SPPT" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width: 9%;">Action</th>
                                                    <th>Nomor Sertifikat</th>
                                                    <th>Masa Berlaku</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td>

                                                        <a onclick="createSPPT()" class="btn btn-success"><i
                                                                class="fas fa-plus"></i></a>
                                                    </td>
                                                    <td colspan="2"></td>

                                                </tr>

                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-one-ppj" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-ppj-tab">
                                        <br/>
                                        <h5>Akta Pendirian Perusahaan</h5>
                                        <hr style="border:1px solid blue;">
                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Akta Pendirian Perusahaan</label>
                                            <div class="col-sm-8">
                                                <input type="file" name="akta_pendiri_ppj" onchange="validAktaPendiri()" id="aktaPendirianPerusahaan" class="form-control">
                                                <div style="margin-top:10px; display: none;" id="alertAktaPendiriExtention"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File Harus berupa PDF
                                                </div>

                                                <div style="margin-top:6px; display: none;" id="alertAktaPendiriSize"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 1
                                                    MB
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Salinan Akta Pendirian Perusahaan Terjemahan Tersumpah</label>
                                            <div class="col-sm-8">
                                                <input type="file" name="salinan_akta_pendiri_ppj" onchange="validAktaPendiriSalinan()" id="aktaPendirianPerusahaanSalinan" class="form-control">
                                                <div style="margin-top:10px; display: none;" id="alertAktaPendiriSalinanExtention"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File Harus berupa PDF
                                                </div>

                                                <div style="margin-top:6px; display: none;" id="alertAktaPendiriSalinanSize"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 1
                                                    MB
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nama Notaris</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nama_notaris_pendiri_ppj" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Kedudukan Notaris</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="kedudukan_pendiri_notaris_ppj" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Tanggal Akta Pendirian Perusahaan</label>
                                            <div class="col-sm-8">
                                                <input type="date" name="tanggal_akta_pendiri_ppj" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nomor Akta Pendirian Perusahaan</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nomor_akta_pendiri_ppj" class="form-control">
                                            </div>
                                        </div>


                                        <br/>
                                        <h5>Akta Perubahan Pendirian Perusahaan</h5>
                                        <hr style="border:1px solid blue;">

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Akta Pendirian Perusahaan</label>
                                            <div class="col-sm-8">
                                                <input type="file" name="akta_pendiri_ppj_perubahan" onchange="validAktaPendiriPerubahan()" id="aktaPendirianPerusahaanPerubahan" class="form-control">
                                                <div style="margin-top:10px; display: none;" id="alertAktaPendiriPerubahanExtention"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File Harus berupa PDF
                                                </div>

                                                <div style="margin-top:6px; display: none;" id="alertAktaPendiriPerubahanSize"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 1
                                                    MB
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Salinan Akta Pendirian Perusahaan Terjemahan Tersumpah</label>
                                            <div class="col-sm-8">
                                                <input type="file" name="salinan_akta_pendiri_ppj_perubahan" onchange="validAktaPendiriSalinanPerubahan()" id="aktaPendirianPerusahaanSalinanPerubahan" class="form-control">
                                                <div style="margin-top:10px; display: none;" id="alertAktaPendiriSalinanPerubahanExtention"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File Harus berupa PDF
                                                </div>

                                                <div style="margin-top:6px; display: none;" id="alertAktaPendiriSalinanPerubahanSize"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 1
                                                    MB
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nama Notaris</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nama_notaris_pendiri_ppj_perubahan" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Kedudukan Notaris</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="kedudukan_pendiri_notaris_ppj_perubahan" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Tanggal Akta Pendirian Perusahaan</label>
                                            <div class="col-sm-8">
                                                <input type="date" name="tanggal_akta_pendiri_ppj_perubahan" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nomor Akta Pendirian Perusahaan</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nomor_akta_pendiri_ppj_perubahan" class="form-control">
                                            </div>
                                        </div>

                                        <br/>
                                        <h5>Izin Usaha Industri</h5>
                                        <hr style="border:1px solid blue;">

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Salinan Izin Industri</label>
                                            <div class="col-sm-8">
                                                <input type="file" name="salinan_izin_industri_ppj" onchange="validSalinanIzin()" id="salinanIzin" class="form-control">
                                                <div style="margin-top:10px; display: none;" id="alertSalinanIzinExtention"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File Harus berupa PDF
                                                </div>

                                                <div style="margin-top:6px; display: none;" id="alertSalinanIzinSize"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 1
                                                    MB
                                                </div>

                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Salinan Izin Industri Terjemahan Tersumpah</label>
                                            <div class="col-sm-8">
                                                <input type="file" name="salinan_izin_industri_tersumpah_ppj" onchange="validSalinanIzinTersumpah()" id="salinanIzinTersumpah" class="form-control">
                                                <div style="margin-top:10px; display: none;" id="alertSalinanIzinTersumpahExtention"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File Harus berupa PDF
                                                </div>

                                                <div style="margin-top:6px; display: none;" id="alertSalinanIzinTersumpahSize"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 1
                                                    MB
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nomor Induk Berusaha</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="NIB_ppj" class="form-control">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Instansi Penerbit NIB</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="instansi_penerbit_ppj" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Jenis Angka Pengenal Importir</label>
                                            <div class="col-sm-8">
                                                <select name="jenis_angka_pengenal_importir_ppj" class="form-control">
                                                    <option value="-">-</option>
                                                    <option value="Angka Pengenal Importir-Produsen">Angka Pengenal Importir-Produsen</option>
                                                    <option value="Angka Pengenal Importir-Umum">Angka Pengenal Importir-Umum</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Status Penanaman Modal</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="status_penanaman_modal_ppj" class="form-control">
                                            </div>
                                        </div>


                                        <br/>
                                        <h5>KBLI PPJ</h5>
                                        <hr style="border:1px solid blue;">
                                        
                                        <table id="KBLI_PPJ" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width: 9%;">Action</th>
                                                    <th>Kode KBLI</th>
                                                    <th>Nama KBLI</th>
                                                    <th>Lokasi Usaha</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td>

                                                        <a onclick="createKBLI_PPJ()" class="btn btn-success"><i
                                                                class="fas fa-plus"></i></a>
                                                    </td>
                                                    <td colspan="3"></td>

                                                </tr>

                                            </tbody>
                                        </table>


                                        <br/>
                                        <h5>Nomor Pokok Wajib Pajak</h5>
                                        <hr style="border:1px solid blue;">
                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nomor
                                                NPWP</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nomor_npwp_ppj" class="form-control" placeholder="Nomor NPWP">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Salinan
                                                NPWP</label>
                                            <div class="col-sm-8">
                                                <input type="file" name="salinan_npwp_ppj" class="form-control" onchange="salinanNPWPPPJ()"
                                                    id="salinanNPWP_id">
                                                <div style="margin-top:10px; display: none;" id="salinanNPWPPPJExtention"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File Harus berupa .JPG/
                                                    .JPEG/ .PNG
                                                </div>

                                                <div style="margin-top:6px; display: none;" id="salinanNPWPPPJSize"
                                                    class="alert alert-danger alert-dismissible" role="alert">
                                                    <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 1
                                                    MB
                                                </div>
                                            </div>
                                        </div>

                                        <br />
                                        <h5>Kantor</h5>
                                        <hr style="border:1px solid blue;">

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Alamat</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="alamat_ppj" class="form-control" placeholder="Alamat Kantor">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Provinsi</label>
                                            <div class="col-sm-8">
                                                <select name="provinsi_ppj" class="form-control select2" id="">
                                                    <option value=""></option>
                                                    @foreach ($provinsi as $p)
                                                        <option value="{{ $p['name'] }}">{{ $p['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Negara</label>
                                            <div class="col-sm-8">
                                                <select name="negara_ppj" class="form-control select2" id="">
                                                    <option value=""></option>
                                                    @foreach ($country as $p)
                                                        <option value="{{ $p['country_name'] }}">{{ $p['country_name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Website</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="website_ppj" class="form-control" placeholder="Website">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nomor
                                                Telepon</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nomor_telepon_ppj" class="form-control" placeholder="Nomor Telepon">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Email</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="email_ppj" class="form-control" placeholder="Email">
                                            </div>
                                        </div>


                                        <br />
                                        <h5>Korespondensi</h5>
                                        <hr style="border:1px solid blue;">
                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nama</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nama_ppj_kr" class="form-control" placeholder="Nama">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan"
                                                class="col-sm-4 col-form-label">Kewarganegaraan</label>
                                            <div class="col-sm-8">
                                                <select name="negara_ppj_kr" class="form-control select2" id="">
                                                    <option value=""></option>
                                                    @foreach ($country as $p)
                                                        <option value="{{ $p['country_name'] }}">{{ $p['country_name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Alamat</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="alamat_ppj_kr" class="form-control" placeholder="Alamat">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nomor Telepon</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nomor_telepon_ppj_kr" class="form-control" placeholder="Nomor Telepon">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Email</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="email_ppj_kr" class="form-control" placeholder="Email">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_perusahaan" class="col-sm-4 col-form-label">Jabatan</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="jabatan_ppj_kr" class="form-control" placeholder="Jabatan">
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary" style="float: right;">Simpan</button>
                            </form>

                        </div>
                        <!-- /.card -->
                    </div>
                </div>

            </div>
        </div><!-- /.container-fluid -->

    </section>
    <!-- /.content -->
    <!-- /.content-wrapper -->

@endsection
@section('js')

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
        })

        function kepemilikan(value) {
            if (value == 'Ya') {
                $('#namaLembaga').show();
            }else{
                $('#namaLembaga').hide(); 
            }
        }

        function validateFile() {
            const fileInput = document.getElementById('salinanAktaPendirianPerusahaan');
            const filePath = fileInput.value;
            const allowedExtensions = /(\.pdf)$/i;
            const maxSize = 1 * 1024 * 1024; // 1 MB

            if (!allowedExtensions.exec(filePath)) {

                $('#alertSalinanExtention').show();

                //alert('Please upload a file with a .pdf extension.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertSalinanExtention').hide();
            }

            if (fileInput.files[0].size >= maxSize) {
                $('#alertSalinanPDF').show();
                //alert('File size must be less than 1 MB.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertSalinanPDF').hide();
            }

            return true;
        }

        function validSalinanIzin() {
            const fileInput = document.getElementById('salinanIzin');
            const filePath = fileInput.value;
            const allowedExtensions = /(\.pdf)$/i;
            const maxSize = 1 * 1024 * 1024; // 1 MB

            if (!allowedExtensions.exec(filePath)) {

                $('#alertSalinanIzinExtention').show();

                //alert('Please upload a file with a .pdf extension.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertSalinanIzinExtention').hide();
            }

            if (fileInput.files[0].size >= maxSize) {
                $('#alertSalinanIzinSize').show();
                //alert('File size must be less than 1 MB.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertSalinanIzinSize').hide();
            }

            return true;
        }

        function validSalinanIzinTersumpah() {
            const fileInput = document.getElementById('salinanIzinTersumpah');
            const filePath = fileInput.value;
            const allowedExtensions = /(\.pdf)$/i;
            const maxSize = 1 * 1024 * 1024; // 1 MB

            if (!allowedExtensions.exec(filePath)) {

                $('#alertSalinanIzinTersumpahExtention').show();

                //alert('Please upload a file with a .pdf extension.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertSalinanIzinTersumpahExtention').hide();
            }

            if (fileInput.files[0].size >= maxSize) {
                $('#alertSalinanIzinTersumpahSize').show();
                //alert('File size must be less than 1 MB.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertSalinanIzinTersumpahSize').hide();
            }

            return true;
        }

        function validAktaPendiriSalinanPerubahan() {
            const fileInput = document.getElementById('aktaPendirianPerusahaanSalinanPerubahan');
            const filePath = fileInput.value;
            const allowedExtensions = /(\.pdf)$/i;
            const maxSize = 1 * 1024 * 1024; // 1 MB

            if (!allowedExtensions.exec(filePath)) {

                $('#alertAktaPendiriSalinanPerubahanExtention').show();

                //alert('Please upload a file with a .pdf extension.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertAktaPendiriSalinanPerubahanExtention').hide();
            }

            if (fileInput.files[0].size >= maxSize) {
                $('#alertAktaPendiriSalinanPerubahanSize').show();
                //alert('File size must be less than 1 MB.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertAktaPendiriSalinanPerubahanSize').hide();
            }

            return true;
        }

        function validateFileAlurProd() {
            const fileInput = document.getElementById('alurProsesProd');
            const filePath = fileInput.value;
            const allowedExtensions = /(\.pdf)$/i;
            const maxSize = 1 * 1024 * 1024; // 1 MB

            if (!allowedExtensions.exec(filePath)) {

                $('#alertAlurProdExtention').show();

                //alert('Please upload a file with a .pdf extension.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertAlurProdExtention').hide();
            }

            if (fileInput.files[0].size >= maxSize) {
                $('#alertAlurProdSize').show();
                //alert('File size must be less than 1 MB.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertAlurProdSize').hide();
            }

            return true;
        }

        function validAktaPendiriSalinan() {
            const fileInput = document.getElementById('aktaPendirianPerusahaanSalinan');
            const filePath = fileInput.value;
            const allowedExtensions = /(\.pdf)$/i;
            const maxSize = 1 * 1024 * 1024; // 1 MB

            if (!allowedExtensions.exec(filePath)) {

                $('#alertAktaPendiriSalinanExtention').show();

                //alert('Please upload a file with a .pdf extension.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertAktaPendiriSalinanExtention').hide();
            }

            if (fileInput.files[0].size >= maxSize) {
                $('#alertAktaPendiriSalinanSize').show();
                //alert('File size must be less than 1 MB.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertAktaPendiriSalinanSize').hide();
            }

            return true;
        }

        function validAktaPendiri() {
            const fileInput = document.getElementById('aktaPendirianPerusahaan');
            const filePath = fileInput.value;
            const allowedExtensions = /(\.pdf)$/i;
            const maxSize = 1 * 1024 * 1024; // 1 MB

            if (!allowedExtensions.exec(filePath)) {

                $('#alertAktaPendiriExtention').show();

                //alert('Please upload a file with a .pdf extension.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertAktaPendiriExtention').hide();
            }

            if (fileInput.files[0].size >= maxSize) {
                $('#alertAktaPendiriSize').show();
                //alert('File size must be less than 1 MB.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertAktaPendiriSize').hide();
            }

            return true;
        }


        function pedomanSm() {
            const fileInput = document.getElementById('pedomanSistemManajemen');
            const filePath = fileInput.value;
            const allowedExtensions = /(\.pdf)$/i;
            const maxSize = 1 * 1024 * 1024; // 1 MB

            if (!allowedExtensions.exec(filePath)) {

                $('#alertSMExtention').show();

                //alert('Please upload a file with a .pdf extension.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertSMExtention').hide();
            }

            if (fileInput.files[0].size >= maxSize) {
                $('#alertSMSize').show();
                //alert('File size must be less than 1 MB.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertSMSize').hide();
            }

            return true;
        }

        function validAktaPendiriPerubahan() {
            const fileInput = document.getElementById('aktaPendirianPerusahaanPerubahan');
            const filePath = fileInput.value;
            const allowedExtensions = /(\.pdf)$/i;
            const maxSize = 1 * 1024 * 1024; // 1 MB

            if (!allowedExtensions.exec(filePath)) {

                $('#alertAktaPendiriPerubahanExtention').show();

                //alert('Please upload a file with a .pdf extension.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertAktaPendiriPerubahanExtention').hide();
            }

            if (fileInput.files[0].size >= maxSize) {
                $('#alertAktaPendiriPerubahanSize').show();
                //alert('File size must be less than 1 MB.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertAktaPendiriPerubahanSize').hide();
            }

            return true;
        }

        function validDaftarPeralatan() {
            const fileInput = document.getElementById('daftarPeralatanIns');
            const filePath = fileInput.value;
            const allowedExtensions = /(\.pdf)$/i;
            const maxSize = 1 * 1024 * 1024; // 1 MB

            if (!allowedExtensions.exec(filePath)) {

                $('#alertdaftarPeralatanInsExtention').show();

                //alert('Please upload a file with a .pdf extension.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertdaftarPeralatanInsExtention').hide();
            }

            if (fileInput.files[0].size >= maxSize) {
                $('#alertdaftarPeralatanInsSize').show();
                //alert('File size must be less than 1 MB.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertdaftarPeralatanInsSize').hide();
            }

            return true;
        }

        function validSdmStruktur() {
            const fileInput = document.getElementById('sdmStrukturOrganisasi');
            const filePath = fileInput.value;
            const allowedExtensions = /(\.pdf)$/i;
            const maxSize = 1 * 1024 * 1024; // 1 MB

            if (!allowedExtensions.exec(filePath)) {

                $('#alertsdmStrukturOrganisasiExtention').show();

                //alert('Please upload a file with a .pdf extension.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertsdmStrukturOrganisasiExtention').hide();
            }

            if (fileInput.files[0].size >= maxSize) {
                $('#alertsdmStrukturOrganisasiSize').show();
                //alert('File size must be less than 1 MB.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertsdmStrukturOrganisasiSize').hide();
            }

            return true;
        }

        function validFilePeta() {
            const fileInput = document.getElementById('petaProses');
            const filePath = fileInput.value;
            const allowedExtensions = /(\.pdf)$/i;
            const maxSize = 1 * 1024 * 1024; // 1 MB

            if (!allowedExtensions.exec(filePath)) {

                $('#alertPetaProsesExtention').show();

                //alert('Please upload a file with a .pdf extension.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertPetaProsesExtention').hide();
            }

            if (fileInput.files[0].size >= maxSize) {
                $('#alertPetaSize').show();
                //alert('File size must be less than 1 MB.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertPetaSize').hide();
            }

            return true;
        }

        function validFileDenah() {
            const fileInput = document.getElementById('denahLokasi');
            const filePath = fileInput.value;
            const allowedExtensions = /(\.pdf)$/i;
            const maxSize = 1 * 1024 * 1024; // 1 MB

            if (!allowedExtensions.exec(filePath)) {

                $('#alertPetaDenahExtention').show();

                //alert('Please upload a file with a .pdf extension.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertPetaDenahExtention').hide();
            }

            if (fileInput.files[0].size >= maxSize) {
                $('#alertPetaDenahSize').show();
                //alert('File size must be less than 1 MB.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertPetaDenahSize').hide();
            }

            return true;
        }

        function validFileDaftarProd() {
            const fileInput = document.getElementById('daftarPeralatanProd');
            const filePath = fileInput.value;
            const allowedExtensions = /(\.pdf)$/i;
            const maxSize = 1 * 1024 * 1024; // 1 MB

            if (!allowedExtensions.exec(filePath)) {

                $('#alertdaftarPeralatanProdExtention').show();

                //alert('Please upload a file with a .pdf extension.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertdaftarPeralatanProdExtention').hide();
            }

            if (fileInput.files[0].size >= maxSize) {
                $('#alertdaftarPeralatanProdSize').show();
                //alert('File size must be less than 1 MB.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertdaftarPeralatanProdSize').hide();
            }

            return true;
        }

        function validateFileTersumpah() {
            const fileInput = document.getElementById('salinanAktaPendirianPerusahaanTersumpah');
            const filePath = fileInput.value;
            const allowedExtensions = /(\.pdf)$/i;
            const maxSize = 1 * 1024 * 1024; // 1 MB

            if (!allowedExtensions.exec(filePath)) {

                $('#alertSalinanExtentionTersumpah').show();

                //alert('Please upload a file with a .pdf extension.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertSalinanExtentionTersumpah').hide();
            }

            if (fileInput.files[0].size >= maxSize) {
                $('#alertSalinanPDFTersumpah').show();
                //alert('File size must be less than 1 MB.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertSalinanPDFTersumpah').hide();
            }

            return true;
        }

        function validateFilePerubahan() {
            const fileInput = document.getElementById('salinanAktaPerubahanPendirianPerusahaan');
            const filePath = fileInput.value;
            const allowedExtensions = /(\.pdf)$/i;
            const maxSize = 1 * 1024 * 1024; // 1 MB

            if (!allowedExtensions.exec(filePath)) {

                $('#alertSalinanExtentionPerubahan').show();

                //alert('Please upload a file with a .pdf extension.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertSalinanExtentionPerubahan').hide();
            }

            if (fileInput.files[0].size >= maxSize) {
                $('#alertSalinanPDFPerubahan').show();
                //alert('File size must be less than 1 MB.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertSalinanPDFPerubahan').hide();
            }

            return true;
        }

        function validateFilePerubahanTersumpah() {
            const fileInput = document.getElementById('salinanAktaPerubahanPendirianPerusahaanTersumpah');
            const filePath = fileInput.value;
            const allowedExtensions = /(\.pdf)$/i;
            const maxSize = 1 * 1024 * 1024; // 1 MB

            if (!allowedExtensions.exec(filePath)) {

                $('#alertSalinanExtentionTersumpahPerubahan').show();

                //alert('Please upload a file with a .pdf extension.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertSalinanExtentionTersumpahPerubahan').hide();
            }

            if (fileInput.files[0].size >= maxSize) {
                $('#alertSalinanPDFTersumpahPerubahan').show();
                //alert('File size must be less than 1 MB.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertSalinanPDFTersumpahPerubahan').hide();
            }

            return true;
        }

        function validateFileIndustri() {
            const fileInput = document.getElementById('salinanIzinIndustri');
            const filePath = fileInput.value;
            const allowedExtensions = /(\.pdf)$/i;
            const maxSize = 1 * 1024 * 1024; // 1 MB

            if (!allowedExtensions.exec(filePath)) {

                $('#alertSalinanExtentionIndustri').show();

                //alert('Please upload a file with a .pdf extension.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertSalinanExtentionIndustri').hide();
            }

            if (fileInput.files[0].size >= maxSize) {
                $('#alertSalinanPDFIndustri').show();
                //alert('File size must be less than 1 MB.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertSalinanPDFIndustri').hide();
            }

            return true;
        }

        function validateFileIndustriTersumpah() {
            const fileInput = document.getElementById('salinanIzinIndustriTersumpah');
            const filePath = fileInput.value;
            const allowedExtensions = /(\.pdf)$/i;
            const maxSize = 1 * 1024 * 1024; // 1 MB

            if (!allowedExtensions.exec(filePath)) {

                $('#alertSalinanExtentionIndustriTersumpah').show();

                //alert('Please upload a file with a .pdf extension.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertSalinanExtentionIndustriTersumpah').hide();
            }

            if (fileInput.files[0].size >= maxSize) {
                $('#alertSalinanPDFIndustriTersumpah').show();
                //alert('File size must be less than 1 MB.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertSalinanPDFIndustriTersumpah').hide();
            }

            return true;
        }

        function createKBLI() {
            var table = document.getElementById("KBLI");
            var tbodyRowCount = table.tBodies[0].rows.length;
            var row = table.insertRow(tbodyRowCount);

            var cell1L = row.insertCell(0);
            var cell2L = row.insertCell(1);
            var cell3L = row.insertCell(2);
            var cell4L = row.insertCell(3);


            cell1L.innerHTML = "<button type='button' value='Delete' onclick='deleteKBLI(this)' class='btn btn-danger'><i class='fas fa-times'></i></button>";
            cell2L.innerHTML = '<input type="text" name="data_post[kode_kbli][]" class="form-control">';
            cell3L.innerHTML = '<input type="text" name="data_post[nama_kbli][]" class="form-control">';
            cell4L.innerHTML = '<input type="text" name="data_post[lokasi_usaha][]" class="form-control"><input type="hidden" name="data_post[tipe][]" value="1" class="form-control">';


        }

        function deleteKBLI(btn) {
            var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }


        function createKBLI_PPJ() {
            var table = document.getElementById("KBLI_PPJ");
            var tbodyRowCount = table.tBodies[0].rows.length;
            var row = table.insertRow(tbodyRowCount);

            var cell1L = row.insertCell(0);
            var cell2L = row.insertCell(1);
            var cell3L = row.insertCell(2);
            var cell4L = row.insertCell(3);


            cell1L.innerHTML = "<button type='button' value='Delete' onclick='deleteKBLI(this)' class='btn btn-danger'><i class='fas fa-times'></i></button>";
            cell2L.innerHTML = '<input type="text" name="data_post[kode_kbli][]" class="form-control">';
            cell3L.innerHTML = '<input type="text" name="data_post[nama_kbli][]" class="form-control">';
            cell4L.innerHTML = '<input type="text" name="data_post[lokasi_usaha][]" class="form-control"><input type="hidden" name="data_post[tipe][]" value="2" class="form-control">';


        }

        function deleteKBLI_PPJ(btn) {
            var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }


        function createSPPT() {
            var table = document.getElementById("SPPT");
            var tbodyRowCount = table.tBodies[0].rows.length;
            var row = table.insertRow(tbodyRowCount);

            var cell1L = row.insertCell(0);
            var cell2L = row.insertCell(1);
            var cell3L = row.insertCell(2);
            


            cell1L.innerHTML = "<button type='button' value='Delete' onclick='deleteSPPT(this)' class='btn btn-danger'><i class='fas fa-times'></i></button>";
            cell2L.innerHTML = '<input type="text" name="data_post[nomor_sertifikat][]" class="form-control">';
            cell3L.innerHTML = '<input type="date" name="data_post[masa_berlaku][]" class="form-control">';
            


        }

        function deleteSPPT(btn) {
            var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }


        function createSubKontrak() {
            var table = document.getElementById("subKontrak");
            var tbodyRowCount = table.tBodies[0].rows.length;
            var row = table.insertRow(tbodyRowCount);

            var cell1L = row.insertCell(0);
            var cell2L = row.insertCell(1);
            var cell3L = row.insertCell(2);
            var cell4L = row.insertCell(3);
            var cell5L = row.insertCell(4);


            cell1L.innerHTML =
                "<button type='button' value='Delete' onclick='deleteSubKontrak(this)' class='btn btn-danger'><i class='fas fa-times'></i></button>";
            cell2L.innerHTML = '<input type="text" name="data_post[proses_sub_kontrak][]" class="form-control">';
            cell3L.innerHTML = '<input type="text" name="data_post[nama_perusahaan][]" class="form-control">';
            cell4L.innerHTML = '<input type="text" name="data_post[alamat_perusahaan][]" class="form-control">';
            cell5L.innerHTML = '<input type="text" name="data_post[persentase][]" class="form-control">';

        }

        function deleteSubKontrak(btn) {
            var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }

        

        function createTransportasi() {
            var table = document.getElementById("transportasi");
            var tbodyRowCount = table.tBodies[0].rows.length;
            var row = table.insertRow(tbodyRowCount);

            var cell1L = row.insertCell(0);
            var cell2L = row.insertCell(1);
            var cell3L = row.insertCell(2);
            var cell4L = row.insertCell(3);
            var cell5L = row.insertCell(4);
            var cell6L = row.insertCell(5);
            var cell7L = row.insertCell(6);

            cell1L.innerHTML = "<button type='button' value='Delete' onclick='deleteRowTransportasi(this)' class='btn btn-danger'><i class='fas fa-times'></i></button>";
            cell2L.innerHTML = '<input type="text" name="data_post[asal][]" class="form-control">';
            cell3L.innerHTML = '<input type="text" name="data_post[tujuan][]" class="form-control">';
            cell4L.innerHTML = '<input type="text" name="data_post[rute][]" class="form-control">';
            cell5L.innerHTML = '<input type="text" name="data_post[moda][]" class="form-control">';
            cell6L.innerHTML = '<input type="text" name="data_post[jarak_tempuh][]" class="form-control">';
            cell7L.innerHTML = '<input type="text" name="data_post[waktu][]" class="form-control">';
        }

        function deleteRowTransportasi(btn) {
            var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }

        function createPedomanSistem() {
            var table = document.getElementById("pedomanSistem");
            var tbodyRowCount = table.tBodies[0].rows.length;
            var row = table.insertRow(tbodyRowCount);

            var cell1L = row.insertCell(0);
            var cell2L = row.insertCell(1);
            var cell3L = row.insertCell(2);
            var cell4L = row.insertCell(3);
            var cell5L = row.insertCell(4);
            var cell6L = row.insertCell(5);
            var cell7L = row.insertCell(6);
            var cell8L = row.insertCell(7);
            var cell9L = row.insertCell(8);
            var cell10L = row.insertCell(9);
            var cell11L = row.insertCell(10);
            var cell12L = row.insertCell(11);
            //var cell13L = row.insertCell(12);

            cell1L.innerHTML = "<button type='button' value='Delete' onclick='deletePedomanSistem(this)' class='btn btn-danger'><i class='fas fa-times'></i></button>";
            cell2L.innerHTML = '<input type="text" name="data_post[jenis_sistem_manajemen][]" class="form-control">';
            cell3L.innerHTML = '<input type="text" name="data_post[versi_standar_sistem][]" class="form-control">';
            cell4L.innerHTML = '<input type="text" name="data_post[lembaga_sertifikasi][]" class="form-control">';
            cell5L.innerHTML = '<input type="text" name="data_post[nomor_sertifikat][]" class="form-control">';
            cell6L.innerHTML = '<input type="text" name="data_post[masa_berlaku][]" class="form-control">';
            cell7L.innerHTML = '<select class="form-control" name="data_post[logo_sertifikat][]"><option="KAN">KAN</option><option="IAF">IAF</option><option="Bukan Keduanya">Bukan Keduanya</option></select>';
            cell8L.innerHTML = '<input type="text" name="data_post[ruang_lingkup][]" class="form-control">';
            cell9L.innerHTML = '<select class="form-control" name="data_post[penerapan][]"><option="-">-</option><option="Secara Mandiri">Secara Mandiri</option><option="Dengan Konsultan">Dengan Konsultan</option></select>';
            cell10L.innerHTML = '<input type="text" name="data_post[nama_konsultan][]" class="form-control">';
            cell11L.innerHTML = '<input type="text" name="data_post[tahun_konsultan][]" class="form-control">';
            cell12L.innerHTML = '<input type="file" onchange="sertifikatPSM('+tbodyRowCount+')" id="sertifikatPSMid'+tbodyRowCount+'" name="data_post[sertifikat][]" class="form-control">';
            //cell13L.innerHTML = '<input type="text" name="data_post[Presentase][]" class="form-control">';
        }

        function sertifikatPSM(value) {
            //console.log(value);
            const fileInput = document.getElementById('sertifikatPSMid'+value);
            const filePath = fileInput.value;
            const allowedExtensions = /(\.pdf)$/i;
            const maxSize = 1 * 1024 * 1024; // 1 MB

            if (!allowedExtensions.exec(filePath)) {

                $('#pedomanSistemExtention').show();

                //alert('Please upload a file with a .pdf extension.');
                fileInput.value = '';
                return false;
            } else {
                $('#pedomanSistemExtention').hide();
            }

            if (fileInput.files[0].size >= maxSize) {
                $('#pedomanSistemSize').show();
                //alert('File size must be less than 1 MB.');
                fileInput.value = '';
                return false;
            } else {
                $('#pedomanSistemSize').hide();
            }

            return true;
        }

        function deletePedomanSistem(btn) {
            var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }

        

        function createStrukturOrganisasi() {
            var table = document.getElementById("strukturOrganisasi");
            var tbodyRowCount = table.tBodies[0].rows.length;
            var row = table.insertRow(tbodyRowCount);

            var cell1L = row.insertCell(0);
            var cell2L = row.insertCell(1);
            var cell3L = row.insertCell(2);
            var cell4L = row.insertCell(3);
            

            cell1L.innerHTML =
                "<button type='button' value='Delete' onclick='deleteRowstrukturOrganisasi(this)' class='btn btn-danger'><i class='fas fa-times'></i></button>";
            cell2L.innerHTML = '<input type="text" name="data_post[nama_divisi][]" class="form-control">';
            cell3L.innerHTML = '<input type="text" name="data_post[tanggung_jawab][]" class="form-control">';
            cell4L.innerHTML = '<input type="text" name="data_post[jumlah_personil][]" class="form-control">';
           
        }

       

        function deleteRowstrukturOrganisasi(btn) {
            var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }

        function salinanNPWP() {
            const fileInput = document.getElementById('salinanNPWP');
            const filePath = fileInput.value;
            const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
            const maxSize = 1 * 1024 * 1024; // 1 MB

            if (!allowedExtensions.exec(filePath)) {

                $('#salinanNPWPExtention').show();

                //alert('Please upload a file with a .pdf extension.');
                fileInput.value = '';
                return false;
            } else {
                $('#salinanNPWPExtention').hide();
            }

            if (fileInput.files[0].size >= maxSize) {
                $('#salinanNPWPSize').show();
                //alert('File size must be less than 1 MB.');
                fileInput.value = '';
                return false;
            } else {
                $('#salinanNPWPSize').hide();
            }

            return true;
        }


        function salinanNPWPPPJ() {
            const fileInput = document.getElementById('salinanNPWP_id');
            const filePath = fileInput.value;
            const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
            const maxSize = 1 * 1024 * 1024; // 1 MB

            if (!allowedExtensions.exec(filePath)) {

                $('#salinanNPWPPPJExtention').show();

                //alert('Please upload a file with a .pdf extension.');
                fileInput.value = '';
                return false;
            } else {
                $('#salinanNPWPPPJExtention').hide();
            }

            if (fileInput.files[0].size >= maxSize) {
                $('#salinanNPWPPPJSize').show();
                //alert('File size must be less than 1 MB.');
                fileInput.value = '';
                return false;
            } else {
                $('#salinanNPWPPPJSize').hide();
            }

            return true;
        }
    </script>
@endsection
