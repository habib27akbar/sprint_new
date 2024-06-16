@extends('layouts.master')

@section('title','Profil Pelanggan')
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
                {{-- <h4>Left Sided</h4> --}}
                <form action="{{ route('profil-pelanggan.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="col-5 col-sm-3">
                      <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">Legalitas Produsen</a>
                        <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Korespondensi</a>
                        <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages" aria-selected="false">Teknis Produksi</a>
                        <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill" href="#vert-tabs-settings" role="tab" aria-controls="vert-tabs-settings" aria-selected="false">Organisasi</a>
                        <a class="nav-link" id="vert-tabs-organisasi-tab" data-toggle="pill" href="#vert-tabs-organisasi" role="tab" aria-controls="vert-tabs-organisasi" aria-selected="false">Sistem Manajemen</a>
                        <a class="nav-link" id="vert-tabs-sm-tab" data-toggle="pill" href="#vert-tabs-sm" role="tab" aria-controls="vert-tabs-sm" aria-selected="false">Perusahaan Penanggungjawab</a>
                      </div>
                    </div>
                    <div class="col-7 col-sm-9">
                      <div class="tab-content" id="vert-tabs-tabContent">
                        <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                          <h5>Akun Pelanggan</h5>
                          <hr style="border:1px solid blue;">
                          <div class="form-group row">
                              <label for="id_perusahaan" class="col-sm-4 col-form-label">ID Perusahaan</label>
                              <div class="col-sm-8">
                                  <input type="text" class="form-control" id="id_perusahaan" placeholder="ID Perusahaan">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="inputPassword3" class="col-sm-4 col-form-label">Jenis Badan Usaha</label>
                              <div class="col-sm-8">
                                  <select name="jenis_badan_usaha" class="form-control">
                                      <option value="">--</option>
                                      <option value="UD">UD</option>
                                      <option value="Fa">Fa</option>
                                      <option value="CV">CV</option>
                                      <option value="Koperasi">Koperasi</option>
                                      <option value="PJ">PJ</option>
                                      <option value="Perum">Perum</option>
                                      <option value="PT">PT</option>
                                      <option value="Yayasan">Yayasan</option>
                                  </select>
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nama Perusahaan Produsen</label>
                              <div class="col-sm-8">
                                  <input type="text" class="form-control" id="nama_perusahaan" placeholder="Nama Perusahaan Produsen">
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="ln_dn" class="col-sm-4 col-form-label">Jenis Produsen</label>
                              <div class="col-sm-8">
                                  <select name="ln_dn" class="form-control">
                                      <option value="">--</option>
                                      <option value="LN">Luar Negeri</option>
                                      <option value="DN">Dalam Negeri</option>
                                  </select>
                              </div>
                          </div>
                          <br/>
                          <h5>Akta Pendirian Perusahaan</h5>
                          <hr style="border:1px solid blue;">
                          <div class="form-group row">
                              <label for="nama_perusahaan" class="col-sm-5 col-form-label">Salinan Akta Pendirian Perusahaan</label>
                              <div class="col-sm-7">
                                  <input type="file" onchange="validateFile()" id="salinanAktaPendirianPerusahaan" class="form-control">
                                  <div style="margin-top:10px; display: none;" id="alertSalinanExtention" class="alert alert-danger alert-dismissible" role="alert">
                                    <i class="fas fa-exclamation-circle"></i> File Harus berupa PDF
                                  </div>

                                  <div style="margin-top:6px; display: none;" id="alertSalinanPDF" class="alert alert-danger alert-dismissible" role="alert">
                                    <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 1 MB
                                  </div>
                              </div>
                              
                          </div>

                          <div class="form-group row">
                              <label for="nama_perusahaan" class="col-sm-5 col-form-label">Salinan Akta Pendirian Perusahaan Terjemahan Tersumpah</label>
                              <div class="col-sm-7">
                                  <input type="file" onchange="validateFileTersumpah()" id="salinanAktaPendirianPerusahaanTersumpah" class="form-control">
                                  <div style="margin-top:10px; display: none;" id="alertSalinanExtentionTersumpah" class="alert alert-danger alert-dismissible" role="alert">
                                    <i class="fas fa-exclamation-circle"></i> File Harus berupa PDF
                                  </div>

                                  <div style="margin-top:6px; display: none;" id="alertSalinanPDFTersumpah" class="alert alert-danger alert-dismissible" role="alert">
                                    <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 1 MB
                                  </div>
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="nama_perusahaan" class="col-sm-5 col-form-label">Nama Notaris</label>
                              <div class="col-sm-7">
                                  <input type="text" class="form-control" placeholder="Nama Notaris">
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="nama_perusahaan" class="col-sm-5 col-form-label">Kedudukan Notaris</label>
                              <div class="col-sm-7">
                                  <input type="text" class="form-control" placeholder="Kedudukan Notaris">
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="nama_perusahaan" class="col-sm-5 col-form-label">Tanggal Akta Pendirian Perusahaan</label>
                              <div class="col-sm-7">
                                  <input type="date" class="form-control">
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="nama_perusahaan" class="col-sm-5 col-form-label">Nomor Akta Pendirian Perusahaan</label>
                              <div class="col-sm-7">
                                  <input type="text" class="form-control" placeholder="Nomor Akta Pendirian Perusahaan">
                              </div>
                          </div>

                          <br/>
                          <h5>Akta Perubahan Pendirian Perusahaan</h5>
                          <hr style="border:1px solid blue;">
                          <div class="form-group row">
                              <label for="nama_perusahaan" class="col-sm-5 col-form-label">Salinan Akta Pendirian Perusahaan</label>
                              <div class="col-sm-7">
                                  <input type="file" onchange="validateFilePerubahan()" id="salinanAktaPerubahanPendirianPerusahaan" class="form-control">
                                  <div style="margin-top:10px; display: none;" id="alertSalinanExtentionPerubahan" class="alert alert-danger alert-dismissible" role="alert">
                                    <i class="fas fa-exclamation-circle"></i> File Harus berupa PDF
                                  </div>

                                  <div style="margin-top:6px; display: none;" id="alertSalinanPDFPerubahan" class="alert alert-danger alert-dismissible" role="alert">
                                    <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 1 MB
                                  </div>
                              </div>
                              
                          </div>

                          <div class="form-group row">
                              <label for="nama_perusahaan" class="col-sm-5 col-form-label">Salinan Akta Pendirian Perusahaan Terjemahan Tersumpah</label>
                              <div class="col-sm-7">
                                  <input type="file" onchange="validateFilePerubahanTersumpah()" id="salinanAktaPerubahanPendirianPerusahaanTersumpah" class="form-control">
                                  <div style="margin-top:10px; display: none;" id="alertSalinanExtentionTersumpahPerubahan" class="alert alert-danger alert-dismissible" role="alert">
                                    <i class="fas fa-exclamation-circle"></i> File Harus berupa PDF
                                  </div>

                                  <div style="margin-top:6px; display: none;" id="alertSalinanPDFTersumpahPerubahan" class="alert alert-danger alert-dismissible" role="alert">
                                    <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 1 MB
                                  </div>
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="nama_perusahaan" class="col-sm-5 col-form-label">Nama Notaris</label>
                              <div class="col-sm-7">
                                  <input type="text" class="form-control" placeholder="Nama Notaris">
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="nama_perusahaan" class="col-sm-5 col-form-label">Kedudukan Notaris</label>
                              <div class="col-sm-7">
                                  <input type="text" class="form-control" placeholder="Kedudukan Notaris">
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="nama_perusahaan" class="col-sm-5 col-form-label">Tanggal Akta Pendirian Perusahaan</label>
                              <div class="col-sm-7">
                                  <input type="date" class="form-control">
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="nama_perusahaan" class="col-sm-5 col-form-label">Nomor Akta Pendirian Perusahaan</label>
                              <div class="col-sm-7">
                                  <input type="text" class="form-control" placeholder="Nomor Akta Pendirian Perusahaan">
                              </div>
                          </div>

                          <br/>
                          <h5>Izin Usaha Industri</h5>
                          <hr style="border:1px solid blue;">

                          <div class="form-group row">
                              <label for="nama_perusahaan" class="col-sm-5 col-form-label">Salinan Izin Industri</label>
                              <div class="col-sm-7">
                                  <input type="file" onchange="validateFileIndustri()" id="salinanIzinIndustri" class="form-control">
                                  <div style="margin-top:10px; display: none;" id="alertSalinanExtentionIndustri" class="alert alert-danger alert-dismissible" role="alert">
                                    <i class="fas fa-exclamation-circle"></i> File Harus berupa PDF
                                  </div>

                                  <div style="margin-top:6px; display: none;" id="alertSalinanPDFIndustri" class="alert alert-danger alert-dismissible" role="alert">
                                    <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 1 MB
                                  </div>
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="nama_perusahaan" class="col-sm-5 col-form-label">Salinan Izin Industri Terjemahan Tersumpah</label>
                              <div class="col-sm-7">
                                  <input type="file" onchange="validateFileIndustriTersumpah()" id="salinanIzinIndustriTersumpah" class="form-control">
                                  <div style="margin-top:10px; display: none;" id="alertSalinanExtentionIndustriTersumpah" class="alert alert-danger alert-dismissible" role="alert">
                                    <i class="fas fa-exclamation-circle"></i> File Harus berupa PDF
                                  </div>

                                  <div style="margin-top:6px; display: none;" id="alertSalinanPDFIndustriTersumpah" class="alert alert-danger alert-dismissible" role="alert">
                                    <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 1 MB
                                  </div>
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="nama_perusahaan" class="col-sm-5 col-form-label">Nomor Induk Berusaha</label>
                              <div class="col-sm-7">
                                  <input type="text" class="form-control" placeholder="Nomor Induk Berusaha">
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="nama_perusahaan" class="col-sm-5 col-form-label">Instansi Penerbit NIB</label>
                              <div class="col-sm-7">
                                  <input type="text" class="form-control" placeholder="Instansi Penerbit NIB">
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="nama_perusahaan" class="col-sm-5 col-form-label">Jenis Angka Pengenal Importir</label>
                              <div class="col-sm-7">
                                  <select name="" class="form-control">
                                    <option value="">--</option>
                                    <option value="Angka Pengenal Importir-Produsen">Angka Pengenal Importir-Produsen</option>
                                    <option value="Angka Pengenal Importir-Umum">Angka Pengenal Importir-Umum</option>
                                  </select>
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="nama_perusahaan" class="col-sm-5 col-form-label">Status Penanaman Modal</label>
                              <div class="col-sm-7">
                                  <select name="" class="form-control">
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

                                            <a onclick="createKBLI()" class="btn btn-success"><i class="fas fa-plus"></i></a>
                                        </td>
                                        <td colspan="3"></td>

                                    </tr>
                                    
                                </tbody>
                            </table>

                            <br/>
                            <h5>Nomor Pokok Wajib Pajak</h5>
                            <hr style="border:1px solid blue;">

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nomor NPWP</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Nomor NPWP">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Salinan NPWP</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" onchange="salinanNPWP()" id="salinanNPWP">
                                    <div style="margin-top:10px; display: none;" id="salinanNPWPExtention" class="alert alert-danger alert-dismissible" role="alert">
                                      <i class="fas fa-exclamation-circle"></i> File Harus berupa .JPG/ .JPEG/ .PNG
                                    </div>

                                    <div style="margin-top:6px; display: none;" id="salinanNPWPSize" class="alert alert-danger alert-dismissible" role="alert">
                                      <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 1 MB
                                    </div>
                                </div>
                            </div>

                            <br/>
                            <h5>Kantor</h5>
                            <hr style="border:1px solid blue;">

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Alamat</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Alamat Kantor">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Provinsi</label>
                                <div class="col-sm-8">
                                    <select name="" class="form-control select2" id="">
                                      <option value=""></option>
                                        @foreach ($provinsi as $p)
                                          <option value="{{ $p['id'] }}">{{ $p['name'] }}</option>                                          
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Negara</label>
                                <div class="col-sm-8">
                                    <select name="" class="form-control select2" id="">
                                      <option value=""></option>
                                        @foreach ($country as $p)
                                          <option value="{{ $p['id_country'] }}">{{ $p['country_name'] }}</option>                                          
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Website</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Website">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nomor Telepon</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Nomor Telepon">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Email">
                                </div>
                            </div>

                            <br/>
                            <h5>Lokasi Usaha/ Pabrik</h5>
                            <hr style="border:1px solid blue;">
                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Alamat</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Alamat Pabrik">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Provinsi</label>
                                <div class="col-sm-8">
                                    <select name="" class="form-control select2" id="">
                                      <option value=""></option>
                                        @foreach ($provinsi as $p)
                                          <option value="{{ $p['id'] }}">{{ $p['name'] }}</option>                                          
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Negara</label>
                                <div class="col-sm-8">
                                    <select name="" class="form-control select2" id="">
                                      <option value=""></option>
                                        @foreach ($country as $p)
                                          <option value="{{ $p['id_country'] }}">{{ $p['country_name'] }}</option>                                          
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Website</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Website">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nomor Telepon</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Nomor Telepon">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Email">
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                            <h5>Direktur</h5>
                            <hr style="border:1px solid blue;">
                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nama</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Nama">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Kewarganegaraan</label>
                                <div class="col-sm-8">
                                    <select name="" class="form-control select2" id="">
                                      <option value=""></option>
                                        @foreach ($country as $p)
                                          <option value="{{ $p['id_country'] }}">{{ $p['country_name'] }}</option>                                          
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Alamat</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Alamat">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nomor Telepon</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Nomor Telepon">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <br/>
                            <h5>Wakil Manajemen</h5>
                            <hr style="border:1px solid blue;">
                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nama</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Nama">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Kewarganegaraan</label>
                                <div class="col-sm-8">
                                    <select name="" class="form-control select2" id="">
                                      <option value=""></option>
                                        @foreach ($country as $p)
                                          <option value="{{ $p['id_country'] }}">{{ $p['country_name'] }}</option>                                          
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Alamat</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Alamat">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nomor Telepon</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Nomor Telepon">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Email">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Jabatan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Jabatan">
                                </div>
                            </div>


                            <br/>
                            <h5>Penghubung</h5>
                            <hr style="border:1px solid blue;">
                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nama</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Nama">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Kewarganegaraan</label>
                                <div class="col-sm-8">
                                    <select name="" class="form-control select2" id="">
                                      <option value=""></option>
                                        @foreach ($country as $p)
                                          <option value="{{ $p['id_country'] }}">{{ $p['country_name'] }}</option>                                          
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Alamat</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Alamat">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nomor Telepon</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Nomor Telepon">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Email">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Jabatan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Jabatan">
                                </div>
                            </div>

                            <br/>
                            <h5>Alamat Koresponden</h5>
                            <hr style="border:1px solid blue;">
                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nama</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Nama">
                                </div>
                            </div>
                            

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Alamat</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Alamat">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Nomor Telepon</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Nomor Telepon">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Email">
                                </div>
                            </div>


                            <br/>
                            <h5>Teknis Produksi</h5>
                            <hr style="border:1px solid blue;">
                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Alur Proses Produksi</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Peta Proses Bisnis</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Denah Lokasi Usaha</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Daftar Peralatan Produksi</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Daftar Peralatan Inspeksi</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Jumlah Tahapan Proses</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Jumlah Tahapan Proses">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Jumlah Shift Per Hari</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Jumlah Shift Per Hari">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Kapasitas Produksi Per Hari</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Kapasitas Produksi Per Hari">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Line Produksi</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Line Produksi">
                                </div>
                            </div>
                            
                            <br/>
                            <h5>Sub Kontrak</h5>
                            <hr style="border:1px solid blue;">
                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label">Total Proses Sub-Kontrak</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Total Proses Sub-Kontrak">
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

                                            <a onclick="createSubKontrak()" class="btn btn-success"><i class="fas fa-plus"></i></a>
                                        </td>
                                        <td colspan="4"></td>

                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">
                          Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                        </div>
                        <div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel" aria-labelledby="vert-tabs-settings-tab">
                          Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                        </div>
                        <div class="tab-pane fade" id="vert-tabs-organisasi" role="tabpanel" aria-labelledby="vert-tabs-organisasi-tab">
                          Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                        </div>
                        <div class="tab-pane fade" id="vert-tabs-sm" role="tabpanel" aria-labelledby="vert-tabs-sm-tab">
                          Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
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
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
    })
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
        }else{
          $('#alertSalinanExtention').hide();
        }

        if (fileInput.files[0].size >= maxSize) {
            $('#alertSalinanPDF').show();
            //alert('File size must be less than 1 MB.');
            fileInput.value = '';
            return false;
        }else{
          $('#alertSalinanPDF').hide();
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
        }else{
          $('#alertSalinanExtentionTersumpah').hide();
        }

        if (fileInput.files[0].size >= maxSize) {
            $('#alertSalinanPDFTersumpah').show();
            //alert('File size must be less than 1 MB.');
            fileInput.value = '';
            return false;
        }else{
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
        }else{
          $('#alertSalinanExtentionPerubahan').hide();
        }

        if (fileInput.files[0].size >= maxSize) {
            $('#alertSalinanPDFPerubahan').show();
            //alert('File size must be less than 1 MB.');
            fileInput.value = '';
            return false;
        }else{
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
        }else{
          $('#alertSalinanExtentionTersumpahPerubahan').hide();
        }

        if (fileInput.files[0].size >= maxSize) {
            $('#alertSalinanPDFTersumpahPerubahan').show();
            //alert('File size must be less than 1 MB.');
            fileInput.value = '';
            return false;
        }else{
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
        }else{
          $('#alertSalinanExtentionIndustri').hide();
        }

        if (fileInput.files[0].size >= maxSize) {
            $('#alertSalinanPDFIndustri').show();
            //alert('File size must be less than 1 MB.');
            fileInput.value = '';
            return false;
        }else{
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
        }else{
          $('#alertSalinanExtentionIndustriTersumpah').hide();
        }

        if (fileInput.files[0].size >= maxSize) {
            $('#alertSalinanPDFIndustriTersumpah').show();
            //alert('File size must be less than 1 MB.');
            fileInput.value = '';
            return false;
        }else{
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
       

        cell1L.innerHTML = "<button type='button' value='Delete' onclick='deleteRowKBLI(this)' class='btn btn-danger'><i class='fas fa-times'></i></button>";
        cell2L.innerHTML = '<input type="text" name="data_post[KodeKBLI][]" class="form-control">';
        cell3L.innerHTML = '<input type="text" name="data_post[NamaKBLI][]" class="form-control">';
        cell4L.innerHTML = '<input type="text" name="data_post[LokasiUsaha][]" class="form-control">';
        
            
    }

    function deleteRowKBLI(btn) {
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
       

        cell1L.innerHTML = "<button type='button' value='Delete' onclick='deleteRowSubKontrak(this)' class='btn btn-danger'><i class='fas fa-times'></i></button>";
        cell2L.innerHTML = '<input type="text" name="data_post[KodeKBLI][]" class="form-control">';
        cell3L.innerHTML = '<input type="text" name="data_post[NamaKBLI][]" class="form-control">';
        cell4L.innerHTML = '<input type="text" name="data_post[LokasiUsaha][]" class="form-control">';
        cell5L.innerHTML = '<input type="text" name="data_post[Presentase][]" class="form-control">';
            
    }

    function deleteRowSubKontrak(btn) {
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
        }else{
          $('#salinanNPWPExtention').hide();
        }

        if (fileInput.files[0].size >= maxSize) {
            $('#salinanNPWPSize').show();
            //alert('File size must be less than 1 MB.');
            fileInput.value = '';
            return false;
        }else{
          $('#salinanNPWPSize').hide();
        }

        return true;
    }
  </script>
  @endsection
