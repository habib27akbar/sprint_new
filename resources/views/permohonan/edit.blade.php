@extends('layouts.master')

@section('title','Permohonan')
@section('css')
    <style>
        #tableSNI thead th {
            top: 0;
            position: sticky;
            background-color: #666;
            color: #fff;
        }

        .col-id-no {
            left: 0;
            position: sticky;
            width: 3%
        }

        .col-second {
            left: 60px;
            position: sticky;
            width: 10%;

        }

        .col-third {
            left: 185px;
            position: sticky;
            width: 6%;

        }

        .col-fourth {
            left: 314px;
            position: sticky;

        }

        .col-fifth {
            left: 390px;
            position: sticky;

        }

        .fixed-header {
            z-index: 50;
        }

        .bg-abu {
            background-color: #f2f2f2;
        }
    </style>
@endsection
@section('content')  
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Permohonan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Permohonan</a></li>
              <li class="breadcrumb-item active">Update</li>
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
            <div class="card card-primary"> 
                <form action="{{ route('permohonan.update', ['permohonan' => $data['id']]) }}" id="formPOST" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        @php
                            $readonly = false;
                        @endphp
                         
                        
                        @if ($data['sts'] >= 2)
                            @if ($data['sts'] == 3)
                                
                            @else
                                @php
                                    $readonly = true;
                                @endphp
                            @endif
                        @endif
                        <h4 style="text-align: center">{{ $klien[0]['id_perusahaan'].' '.$klien[0]['nama_perusahaan'] }}</h4>
                        <input type="hidden" name="id_perusahaan" value="{{ $klien[0]['id_perusahaan'] }}">
                        <br/>
                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Surat Permohonan</label>
                            <div class="col-sm-4">
                               <input type="file" name="surat_permohonan"  onchange="validateFile()" id="surat_permohonan" {{ $readonly ? 'disabled':'' }} class="form-control">
                               <input type="hidden" name="surat_permohonan_old" value="{{ $data['surat_permohonan'] }}">
                                <div style="margin-top:10px; display: none;" id="alertSp"
                                    class="alert alert-danger alert-dismissible" role="alert">
                                    <i class="fas fa-exclamation-circle"></i> File Harus berupa PDF
                                </div>

                                <div style="margin-top:6px; display: none;" id="alertSpPDF"
                                    class="alert alert-danger alert-dismissible" role="alert">
                                    <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 3 MB
                                </div>
                            </div>

                            <label for="file" class="col-sm-2 col-form-label">Formulir Pendaftaran</label>
                            <div class="col-sm-4">
                               <input type="file" name="formulir_pendaftaran" id="formulir_pendaftaran" {{ $readonly ? 'disabled':'' }} onchange="validFormFile()" class="form-control">
                               <input type="hidden" name="formulir_pendaftaran_old" value="{{ $data['formulir_pendaftaran'] }}">
                               <div style="margin-top:10px; display: none;" id="alertPendaftaran"
                                    class="alert alert-danger alert-dismissible" role="alert">
                                    <i class="fas fa-exclamation-circle"></i> File Harus berupa PDF
                                </div>

                                <div style="margin-top:6px; display: none;" id="alertPendaftaranPDF"
                                    class="alert alert-danger alert-dismissible" role="alert">
                                    <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 3 MB
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Nomor Surat Permohonan</label>
                            <div class="col-sm-4">
                               <input type="text" name="no_surat_permohonan" class="form-control" {{ $readonly ? 'readonly':'' }} placeholder="Nomor Surat Permohonan" value="{{ $data['no_surat_permohonan'] }}" required>
                            </div>

                            <label for="file" class="col-sm-2 col-form-label">Tanggal Surat Permohonan</label>
                            <div class="col-sm-4">
                               <input type="date" name="tgl_surat_permohonan" class="form-control" {{ $readonly ? 'readonly':'' }} value="{{ $data['tgl_surat_permohonan'] }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Menu</label>
                            <div class="col-sm-4">
                               <select name="menu" onchange="selectMenu(this.value)" class="form-control" {{ $readonly ? 'disabled':'' }} required>
                                <option value="">-</option>
                                @foreach ($skema as $item)
                                    <option {{ $data['menu'] == $item->kode_skema_sertifikasi?'selected':'' }} value="{{ $item->kode_skema_sertifikasi }}">{{ $item->nama_skema_sertifikasi }}</option>
                                @endforeach
                               </select>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Tujuan Audit</label>
                            <div class="col-sm-4">
                               <select name="tujuan_audit" class="form-control" {{ $readonly ? 'disabled':'' }} required>
                                
                                @foreach ($tujuan_audit as $item)
                                    <option {{ $data['tujuan_audit'] == $item->id?'selected':'' }} value="{{ $item->id }}">{{ $item->nama_tujuan_audit }}</option>
                                @endforeach
                               </select>
                            </div>

                            <label for="file" class="col-sm-2 col-form-label">Proses Lain</label>
                            <div class="col-sm-4">
                               <select name="proses_lain" class="form-control select2" {{ $readonly ? 'disabled':'' }} required>
                                <option value="-">-</option>
                                @foreach ($proses_lain as $item)
                                    <option {{ $data['proses_lain'] == $item->id?'selected':'' }} value="{{ $item->id }}">{{ $item->nama_proses }}</option>
                                @endforeach
                               </select>
                            </div>

                        </div>


                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Nomor Sertifikat Referensi</label>
                            <div class="col-sm-10">
                               <select name="no_sertifikat_referensi" id="no_sertifikat_referensi" onchange="noSertifikat()" {{ $readonly ? 'disabled':'' }} class="form-control" required>
                                <option value="">-</option>
                                @foreach ($mst_sertifikat as $item)
                                    <option {{ $data['no_sertifikat_referensi'] == $item->id ? 'selected':'' }} value="{{ $item->id }}">{{  $item->no_sertifikat.' '.$item->nama_skema_sertifikasi.' '.$item->no_standar.' '.$item->judul_standar }}</option>
                                @endforeach
                               </select>
                            </div>


                        </div>


                        
                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Masa Berlaku</label>
                            <div class="col-sm-4">
                            <input type="date" name="masa_berlaku" id="tanggal_terbit" value="{{ $data['masa_berlaku'] }}" {{ $readonly ? 'disabled':'' }} class="form-control">
                            </div>

                            <label for="file" class="col-sm-2 col-form-label">Sampai</label>
                            <div class="col-sm-4">
                            <input type="date" name="masa_berlaku_akhir" id="tanggal_berakhir" value="{{ $data['masa_berlaku_akhir'] }}" {{ $readonly ? 'disabled':'' }} class="form-control">
                            </div>

                        </div>
                        

                         <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Nomor Standar</label>
                            <div class="col-sm-10">
                               <select name="id_standar" onchange="checkSNI()" id="id_standar" class="form-control select2" {{ $readonly ? 'disabled':'' }} required>
                                <option value="">-</option>
                                @foreach ($ruang_lingkup as $item)
                                    <option {{ $data['id_standar'] == $item->id ? 'selected':'' }} value="{{ $item->id }}">{{ $item->nomor_standar.' - '.$item->judul_standar }}</option>
                                @endforeach
                               </select>
                            </div>


                        </div>


                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Status Komoditi</label>
                            <div class="col-sm-4">
                               <select name="status_komoditi" class="form-control" {{ $readonly ? 'disabled':'' }} required>
                                <option value="">-</option>
                                <option {{ $data['id_standar'] == 'Wajib Kemenperin'? 'selected':'' }} value="Wajib Kemenperin">Wajib Kemenperin</option>
                                <option {{ $data['id_standar'] == 'Wajib ESDM'? 'selected':'' }} value="Wajib ESDM">Wajib ESDM</option>
                                <option {{ $data['id_standar'] == 'Wajib Kemendag'? 'selected':'' }} value="Wajib Kemendag">Wajib Kemendag</option>
                                <option {{ $data['id_standar'] == 'Sukarela'? 'selected':'' }} value="Sukarela">Sukarela</option>
                               </select>
                            </div>

                            <label for="file" class="col-sm-2 col-form-label">Ilustrasi Penandaan Standar</label>
                            <div class="col-sm-4">
                               <input type="file" class="form-control" name="illustrasi_penandaan_standar" {{ $readonly ? 'disabled':'' }} id="illustrasi_penandaan_standar" onchange="validIllustrasi()">
                               <input type="hidden" name="illustrasi_penandaan_standar_old" value="{{ $data['illustrasi_penandaan_standar'] }}">
                               <div style="margin-top:10px; display: none;" id="alertIllustrasi"
                                    class="alert alert-danger alert-dismissible" role="alert">
                                    <i class="fas fa-exclamation-circle"></i> File Harus berupa PDF
                                </div>

                                <div style="margin-top:6px; display: none;" id="alertIllustrasiPDF"
                                    class="alert alert-danger alert-dismissible" role="alert">
                                    <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 3 MB
                                </div>
                            </div>

                        </div>


                        <div class="form-group row">
                            <label for="text" class="col-sm-2 col-form-label">Status Penerapan Sistem Manajemen Mutu</label>
                            <div class="col-sm-4">
                               <input type="text" class="form-control" name="status_penerapan_smm" {{ $readonly ? 'disabled':'' }} value="{{ $data['status_penerapan_smm'] }}" placeholder="Status Penerapan Sistem Manajemen Mutu">
                            </div>

                            <label for="text" class="col-sm-2 col-form-label">Akreditasi LSSM</label>
                            <div class="col-sm-4">
                               <input type="text" class="form-control" name="akreditasi_lssm" {{ $readonly ? 'disabled':'' }} value="{{ $data['akreditasi_lssm'] }}" placeholder="Akreditasi LSSM">
                            </div>

                        </div>

                        <div id="detailStandar">

                        </div>


                        <div class="form-group row">
                            <label for="text" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                               <input type="text" class="form-control" name="status_penerapan_smm" {{ $readonly ? 'disabled':'' }} value="{{ $data['status_penerapan_smm'] }}" placeholder="Keterangan">
                            </div>

                        </div>

                        <div id="SPRO" style="{{ $data['menu'] == 'SPRO' ? '':'display: none;' }}">
                            <div style="margin-top:10px; display: none;" id="alertEx"
                                class="alert alert-danger alert-dipenghubungissible" role="alert">
                                <i class="fas fa-exclamation-circle"></i> File Harus berupa PDF
                            </div>

                            <div style="margin-top:6px; display: none;" id="alertSize"
                                class="alert alert-danger alert-dipenghubungissible" role="alert">
                                <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 3 MB
                            </div>
                            <div class="table-responsive">
                                <select style="display: none;" name="" id="selectMerek">
                                    @foreach ($data_merek as $item)
                                        @if ($item['merek'])
                                            <option value="{{ $item['merek'] }}">{{ $item['merek'] }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <table id="tableSNI" style="width:200%;" class="table table-bordered table-striped freeze-table">
                                    <thead>
                                        <tr>
                                            <th class="col-id-no fixed-header" style="width:3%">Aksi</th>
                                            <th style="width: 10%" class="col-second fixed-header">Merek</th>
                                            <th class="col-third fixed-header">Illustrasi Merek</th>
                                            <th class="col-fourth fixed-header">No.&nbsp;Pendaftaran</th>
                                            <th>Tgl Pendaftaran</th>
                                            <th>Dokumen Pendaftaran Merek</th>
                                            <th>No. Permohonan Merek</th>
                                            <th>Tgl. Penerimaan</th>
                                            <th>Tgl. Dimulai Perlindungan</th>
                                            <th>Tgl. Berakhir Perlindungan</th>
                                            <th>Sertifikat Merek</th>
                                            <th>Status Pemilik Merek</th>
                                            <th>Alamat</th>
                                            <th>Pelimpahan Merek</th>
                                            <th>Tgl. Berakhir Pelimpahan merek</th>
                                            <th>Dokumen Pelimpahan merek</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                         $i = 0;   
                                        @endphp
                                        @foreach ($data_merek as $item)
                                        @php
                                         $i++;   
                                        @endphp
                                            <tr>
                                                <td class="col-id-no bg-abu">
                                                    @if ($readonly == false)
                                                        <button type="button" value="Delete" onclick="deleteSNI(this)" class="btn btn-danger"><i class="fas fa-times"></i></button>
                                                    @endif
                                                </td>
                                                <td class="col-second bg-abu">
                                                    <input type="text" name="data_post[merek][]" {{ $readonly ? 'disabled':'' }} id="merek{{ $i }}" value="{{ $item['merek'] }}" class="form-control">
                                                </td>
                                                <td class="col-third bg-abu">
                                                    <input type="text" name="data_post[illustrasi_merek][]" {{ $readonly ? 'disabled':'' }} class="form-control" value="{{ $item['illustrasi_merek'] }}">
                                                </td>
                                                <td class="col-fourth bg-abu">
                                                    <input type="text" name="data_post[no_pendaftaran][]" {{ $readonly ? 'disabled':'' }} class="form-control" value="{{ $item['no_pendaftaran'] }}">
                                                </td>
                                                <td>
                                                    <input type="date" name="data_post[tgl_pendaftaran][]" {{ $readonly ? 'disabled':'' }} class="form-control" value="{{ $item['tgl_pendaftaran'] }}">
                                                </td>
                                                <td>
                                                    <input type="file" name="data_post[dokumen_pendaftaran_merek][]" {{ $readonly ? 'disabled':'' }} onchange="validDocPendaftaran({{ $i }})" id="dokumen_pendaftaran_merek{{ $i }}" class="form-control">
                                                    <input type="hidden" name="data_post[dokumen_pendaftaran_merek_old][]" value="{{ $item['dokumen_pendaftaran_merek'] }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="data_post[no_permohonan_merek][]" {{ $readonly ? 'disabled':'' }} class="form-control" value="{{ $item['no_permohonan_merek'] }}">
                                                </td>
                                                <td>
                                                    <input type="date" name="data_post[tgl_penerimaan][]" {{ $readonly ? 'disabled':'' }} class="form-control" value="{{ $item['tgl_penerimaan'] }}">
                                                </td>
                                                <td>
                                                    <input type="date" name="data_post[tgl_dimulai_perlindungan][]" {{ $readonly ? 'disabled':'' }} class="form-control" value="{{ $item['tgl_dimulai_perlindungan'] }}">
                                                </td>
                                                <td>
                                                    <input type="date" name="data_post[tgl_berakhir_perlindungan][]" {{ $readonly ? 'disabled':'' }} class="form-control" value="{{ $item['tgl_berakhir_perlindungan'] }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="data_post[sertifikat_merek][]" {{ $readonly ? 'disabled':'' }} class="form-control" value="{{ $item['sertifikat_merek'] }}">
                                                </td>
                                                <td>
                                                    <select name="data_post[status_pemilik_merek][]" {{ $readonly ? 'disabled':'' }} class="form-control">
                                                        <option value="-">-</option>
                                                        <option value="Milik Sendiri">Milik Sendiri</option>
                                                        <option value="Pelimpahan Merek">Pelimpahan Merek</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" name="data_post[alamat][]" {{ $readonly ? 'disabled':'' }} class="form-control" value="{{ $item['alamat'] }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="data_post[pelimpahan_merek][]" {{ $readonly ? 'disabled':'' }} class="form-control" value="{{ $item['pelimpahan_merek'] }}">
                                                </td>
                                                <td>
                                                    <input type="date" name="data_post[tgl_berakhir_pelimpahan_merek][]" {{ $readonly ? 'disabled':'' }} class="form-control" value="{{ $item['tgl_berakhir_pelimpahan_merek'] }}">
                                                </td>
                                                <td>
                                                    <input type="file" name="data_post[dokumen_pelimpahan_merek][]" {{ $readonly ? 'disabled':'' }} onchange="validDocPelimpahan({{ $i }})" id="dokumen_pelimpahan_merek{{ $i }}" class="form-control" value="{{ $item['dokumen_pelimpahan_merek'] }}">
                                                    <input type="hidden" name="data_post[dokumen_pelimpahan_merek_old][]" value="{{ $item['dokumen_pelimpahan_merek'] }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if ($readonly == false)
                                        <tr>
                                            <td>
                                                <a onclick="createSNI()" class="btn btn-success"><i class="fas fa-plus"></i></a>
                                            </td>
                                            <td colspan="15"></td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>

                            </div>

                            <div style="margin-top: 20px" class="table-responsive">
                                <table id="tipeMerek" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>Merek</th>
                                            <th>Tipe</th>
                                            <th>Foto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                         $i = 0;   
                                        @endphp
                                        @foreach ($data_tipe as $item)
                                        @php
                                         $i++;   
                                        @endphp
                                            <tr>
                                                <td>
                                                    @if ($readonly == false)
                                                     <button type="button" value="Delete" onclick="deleteTipe(this)" class="btn btn-danger"><i class="fas fa-times"></i></button>
                                                    @endif
                                                </td>
                                                <td>
                                                    <select name="post_merek[merek][]" {{ $readonly ? 'disabled':'' }} id="m{{ $i }}" class="form-control select2">
                                                        @foreach ($data_merek as $items)
                                                            @if ($items['merek'])
                                                                <option value="{{ $items['merek'] }}">{{ $items['merek'] }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" name="post_merek[tipe][]" {{ $readonly ? 'disabled':'' }} value="{{ $item['tipe'] }}" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="file" name="post_merek[foto][]" {{ $readonly ? 'disabled':'' }} class="form-control">
                                                    <input type="hidden" name="post_merek[foto_old][]" value="{{ $item['foto'] }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if ($readonly == false)
                                        <tr>
                                            <td>
                                                <a onclick="createTipe()" class="btn btn-success"><i class="fas fa-plus"></i></a>
                                            </td>
                                            <td colspan="3"></td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        


                        <div style="margin-top: 20px" class="table-responsive">
                            <table id="fileUpload" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Nama File</th>
                                        <th>File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;   
                                    @endphp
                                    @foreach ($data_file as $item)
                                    @php
                                        $i++;   
                                    @endphp
                                        <tr>
                                            
                                            <td>
                                                @if ($readonly == false)
                                                    <button type="button" value="Delete" onclick="deleteSNI(this)" class="btn btn-danger"><i class="fas fa-times"></i></button>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="text" name="post_file[nama_file][]" {{ $readonly ? 'disabled':'' }} class="form-control" value="{{ $item['nama_file'] }}">
                                            </td>
                                            <td>
                                                <input type="file" name="post_file[file][]" {{ $readonly ? 'disabled':'' }} class="form-control"><input type="hidden" name="tipe" value="1">
                                                <input type="hidden" name="post_file[file_old][]" {{ $readonly ? 'disabled':'' }} value="{{ $item['file'] }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if ($readonly == false)
                                    <tr>
                                        <td>
                                            <a onclick="createFile()" class="btn btn-success"><i class="fas fa-plus"></i></a>
                                        </td>
                                        <td colspan="2"></td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        

                      <input type="hidden" name="status" id="status" value="{{ $data['sts_permohonan'] }}">
                      <input type="hidden" name="sts" id="sts" value="{{ $data['sts'] }}">
                        
                    </div>
                    <div class="card-footer">
                        <div id="btnSimpan">
                            @if ($readonly == false)
                                <button id="btnSave" type="submit" value="simpan" class="btn btn-primary">Simpan</button>
                                @if ($data['sts'] == 1)
                                    <button id="ajukanPermohonan" type="submit" value="ajukan_permohonan" class="btn btn-success">Ajukan Permohonan</button>
                                @endif
                            @endif
                            <a href="{{ route('permohonan.index') }}" class="btn btn-default">Kembali</a>
                        </div>

                        <div id="btnAjuan" style="display: none;">
                            <div class="alert alert-warning alert-dismissible" role="alert">
                                PERMOHONAN YANG SUDAH DIAJUKAN TIDAK DAPAT DI UBAH <i class="fas fa-exclamation-triangle"></i> 
	                        </div>
                            <button type="submit" value="simpan" id="simpan" class="btn btn-success">Simpan</button>
                            <button type="submit" value="batalAjuan" id="batalAjuan" class="btn btn-default">Batal</a>
                        </div>
                        
                    </div>
                </form>
            </div>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <!-- /.content -->
  @endsection
  @section('js')
    <script>
        $('.select2').select2();

        document.getElementById("formPOST").addEventListener("submit", function(event) {
            
            const submitButton = event.submitter;
            if (submitButton.value == 'ajukan_permohonan') {
                event.preventDefault();
                $('#btnAjuan').show();
                $('#btnSimpan').hide();
                document.getElementById("status").value = "Pengajuan";
                document.getElementById("status").value = "2";
                
            }else if(submitButton.value == 'batalAjuan'){
                event.preventDefault();
                $('#btnAjuan').hide();
                $('#btnSimpan').show();
                document.getElementById("status").value = "Draft";
                document.getElementById("status").value = "1";
            }else{
                $('#btnAjuan').hide();
                //document.getElementById("status").value = "Draft";
            }
            //console.log(submitButton.value);
        });

        function checkSNI() {
            $.ajax({
                method: 'POST',
                url: '{{url("get-no-standar")}}',
                data:{
                        _token: '{{csrf_token()}}', 
                        id_standar: $('#id_standar').find(":selected").val(),
                },
                success: function(data) {
                    //console.log(data);
                    $("#detailStandar").html(data);
                }

            });
        }

        function noSertifikat() {
            $.ajax({
                method: 'POST',
                url: '{{url("get-no-sertifikat")}}',
                data:{
                        _token: '{{csrf_token()}}', 
                        no_sertifikat_referensi: $('#no_sertifikat_referensi').find(":selected").val(),
                },
                success: function(data) {
                    var dataSertifikat = data.data;
                    document.getElementById("tanggal_terbit").value = dataSertifikat.tanggal_terbit;
                    document.getElementById("tanggal_berakhir").value = dataSertifikat.tanggal_berakhir;
                    //console.log(data);
                    //$("#no_sertifikat_masa_berlaku").html(data);
                }

            });
        }

        function validateFile() {
            const fileInput = document.getElementById('surat_permohonan');
            const filePath = fileInput.value;
            const allowedExtensions = /(\.pdf)$/i;
            const maxSize = 3 * 1024 * 1024; // 3 MB

            if (!allowedExtensions.exec(filePath)) {

                $('#alertSp').show();

                //alert('Please upload a file with a .pdf extension.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertSp').hide();
            }

            if (fileInput.files[0].size >= maxSize) {
                $('#alertSpPDF').show();
                //alert('File size must be less than 1 MB.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertSpPDF').hide();
            }

            return true;
        }

        function validFormFile() {
            const fileInput = document.getElementById('formulir_pendaftaran');
            const filePath = fileInput.value;
            const allowedExtensions = /(\.pdf)$/i;
            const maxSize = 3 * 1024 * 1024; // 3 MB

            if (!allowedExtensions.exec(filePath)) {

                $('#alertPendaftaran').show();

                //alert('Please upload a file with a .pdf extension.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertPendaftaran').hide();
            }

            if (fileInput.files[0].size >= maxSize) {
                $('#alertPendaftaranPDF').show();
                //alert('File size must be less than 1 MB.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertPendaftaranPDF').hide();
            }

            return true;
        }


        function validIllustrasi() {
            const fileInput = document.getElementById('illustrasi_penandaan_standar');
            const filePath = fileInput.value;
            const allowedExtensions = /(\.pdf)$/i;
            const maxSize = 3 * 1024 * 1024; // 3 MB

            if (!allowedExtensions.exec(filePath)) {

                $('#alertIllustrasi').show();

                //alert('Please upload a file with a .pdf extension.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertIllustrasi').hide();
            }

            if (fileInput.files[0].size >= maxSize) {
                $('#alertIllustrasiPDF').show();
                //alert('File size must be less than 1 MB.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertIllustrasiPDF').hide();
            }

            return true;
        }

        function selectMenu(value) {
            if (value == 'SPRO') {
                $('#SPRO').show();
            }else{
                $('#SPRO').hide();
            }
            
        }

        function merek(value) {
            var t = document.getElementById("tableSNI");
            var tbody = t.tBodies[0].rows.length;
           
            var select = document.getElementById("selectMerek");
                
                for (var i = 0; i < select.length; i++) {
                    //console.log(select.options[i]);
                    select.removeChild(select.options[i]);
                    i--; // options have now less element, then decrease i
                }
                
            for (let index = 1; index < tbody; index++) {
                var nameMerek = 'merek'+index;
                
                var m = document.getElementById(nameMerek).value;
                
                var opt = document.createElement('option');
                opt.value = m;
                opt.text = m;

                console.log(opt);
                
                select.add(opt);
                
                
            }
            sTipe();
        }

        function sTipe() {
            var select = document.getElementById("selectMerek");
            var t_ = document.getElementById("tipeMerek");
            var r_ = t_.tBodies[0].rows.length;

            //var t_2 = document.getElementById("tSertifikat");
            //var r_2 = t_2.tBodies[0].rows.length;
            
            //console.log(r_);
            for (let index = 1; index < r_; index++) {
                //console.log(index);
                var nameSelect = 'm'+index;
                
                var s = document.getElementById(nameSelect);
                
                var vSelect = document.getElementById(nameSelect).value;
                
                for (var i = 0; i < s.length; i++) {
                
                    s.removeChild(s.options[i]);
                    
                    i--; // options have now less element, then decrease i
                }
                

                for (var i = 0; i < select.length; i++) {

                    var opt = document.createElement('option');
                    opt.value = select.options[i].value;
                    opt.text = select.options[i].value;
                    s.add(opt);
                    //m2.add(opt); 
                }
                $(s).val(vSelect).change();

                
                
            }

            
        }
    

        function createSNI() {
            var table = document.getElementById("tableSNI");
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
            var cell13L = row.insertCell(12);
            var cell14L = row.insertCell(13);
            var cell15L = row.insertCell(14);
            var cell16L = row.insertCell(15);

            cell1L.className = 'col-id-no bg-abu';
            cell1L.innerHTML = "<button type='button' value='Delete' onclick='deleteSNI(this)' class='btn btn-danger'><i class='fas fa-times'></i></button>";
            cell2L.className = 'col-second bg-abu';
            cell2L.innerHTML = '<input type="text" name="data_post[merek][]" id="merek'+tbodyRowCount+'" class="form-control">';
            cell3L.className = 'col-third bg-abu';
            cell3L.innerHTML = '<input type="text" name="data_post[illustrasi_merek][]" class="form-control">';
            cell4L.className = 'col-fourth bg-abu';
            cell4L.innerHTML = '<input type="text" name="data_post[no_pendaftaran][]" class="form-control">';
            cell5L.innerHTML = '<input type="date" name="data_post[tgl_pendaftaran][]" class="form-control">';
            cell6L.innerHTML = '<input type="file" name="data_post[dokumen_pendaftaran_merek][]" onchange="validDocPendaftaran('+tbodyRowCount+')" id="dokumen_pendaftaran_merek'+tbodyRowCount+'" class="form-control">';
            cell7L.innerHTML = '<input type="text" name="data_post[no_permohonan_merek][]" class="form-control">';
            cell8L.innerHTML = '<input type="date" name="data_post[tgl_penerimaan][]" class="form-control">';
            cell9L.innerHTML = '<input type="date" name="data_post[tgl_dimulai_perlindungan][]" class="form-control">';
            cell10L.innerHTML = '<input type="date" name="data_post[tgl_berakhir_perlindungan][]" class="form-control">';
            cell11L.innerHTML = '<input type="text" name="data_post[sertifikat_merek][]" class="form-control">';
            cell12L.innerHTML = '<select name="data_post[status_pemilik_merek][]" class="form-control"><option value="-">-</option><option value="Milik Sendiri">Milik Sendiri</option><option value="Pelimpahan Merek">Pelimpahan Merek</option></select>';
            cell13L.innerHTML = '<input type="text" name="data_post[alamat][]" class="form-control">';
            cell14L.innerHTML = '<input type="text" name="data_post[pelimpahan_merek][]" class="form-control">';
            cell15L.innerHTML = '<input type="date" name="data_post[tgl_berakhir_pelimpahan_merek][]" class="form-control">';
            cell16L.innerHTML = '<input type="file" name="data_post[dokumen_pelimpahan_merek][]" onchange="validDocPelimpahan('+tbodyRowCount+')" id="dokumen_pelimpahan_merek'+tbodyRowCount+'" class="form-control">';
            sTipe();
        }

        function validDocPendaftaran(value) {
            //console.log(value);
            const fileInput = document.getElementById('dokumen_pendaftaran_merek'+value);
            const filePath = fileInput.value;
            const allowedExtensions = /(\.pdf)$/i;
            const maxSize = 1 * 1024 * 1024; // 1 MB

            if (!allowedExtensions.exec(filePath)) {

                $('#alertEx').show();

                //alert('Please upload a file with a .pdf extension.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertEx').hide();
            }

            if (fileInput.files[0].size >= maxSize) {
                $('#alertSize').show();
                //alert('File size must be less than 1 MB.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertSize').hide();
            }

            return true;
        }

        function validDocPelimpahan(value) {
            //console.log(value);
            const fileInput = document.getElementById('dokumen_pelimpahan_merek'+value);
            const filePath = fileInput.value;
            const allowedExtensions = /(\.pdf)$/i;
            const maxSize = 1 * 1024 * 1024; // 1 MB

            if (!allowedExtensions.exec(filePath)) {

                $('#alertEx').show();

                //alert('Please upload a file with a .pdf extension.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertEx').hide();
            }

            if (fileInput.files[0].size >= maxSize) {
                $('#alertSize').show();
                //alert('File size must be less than 1 MB.');
                fileInput.value = '';
                return false;
            } else {
                $('#alertSize').hide();
            }

            return true;
        }

        function deleteSNI(btn) {
            var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
            merek();
            sTipe();
        }

        function createTipe() {
            var table = document.getElementById("tipeMerek");
            var tbodyRowCount = table.tBodies[0].rows.length;
            var row = table.insertRow(tbodyRowCount);

            var cell1L = row.insertCell(0);
            var cell2L = row.insertCell(1);
            var cell3L = row.insertCell(2);
            var cell4L = row.insertCell(3);


            cell1L.innerHTML = "<button type='button' value='Delete' onclick='deleteTipe(this)' class='btn btn-danger'><i class='fas fa-times'></i></button>";
            cell2L.innerHTML = '<select name="post_merek[merek][]" id="m'+tbodyRowCount+'" class="form-control select2"></select>';
            merek();
            cell3L.innerHTML = '<input type="text" name="post_merek[tipe][]" class="form-control">';
            cell4L.innerHTML = '<input type="file" name="post_merek[foto][]" class="form-control">';


        }

        function deleteTipe(btn) {
            var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
            //merek();
        }


        function createFile() {
            var table = document.getElementById("fileUpload");
            var tbodyRowCount = table.tBodies[0].rows.length;
            var row = table.insertRow(tbodyRowCount);

            var cell1L = row.insertCell(0);
            var cell2L = row.insertCell(1);
            var cell3L = row.insertCell(2);
           


            cell1L.innerHTML = "<button type='button' value='Delete' onclick='deleteFile(this)' class='btn btn-danger'><i class='fas fa-times'></i></button>";
            cell2L.innerHTML = '<input type="text" name="post_file[nama_file][]" class="form-control">';
            cell3L.innerHTML = '<input type="file" name="post_file[file][]" class="form-control"><input type="hidden" name="tipe" value="1">';


        }

        function deleteFile(btn) {
            var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
            //merek();
        }

        
    </script>
  @endsection