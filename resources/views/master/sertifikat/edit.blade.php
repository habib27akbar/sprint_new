@extends('layouts.master')

@section('title','Master Sertifikat')
@section('css')

@endsection
@section('content')  
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Master Sertifikat</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Master Sertifikat</a></li>
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
                <form action="{{ route('sertifikat.update', ['sertifikat' => $data['id']]) }}" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Nomor Sertifikat</label>
                            <div class="col-sm-4">
                               <input type="text" class="form-control" name="no_sertifikat" value="{{ $data['no_sertifikat'] }}">
                            </div>
                        </div>

                     
                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Perusahaan</label>
                            <div class="col-sm-4">
                               <select name="id_perusahaan" id="id_perusahaan" class="form-control select2" required>
                                    <option value="">-</option>
                               </select>
                            </div>
                        </div>
                        <input type="hidden" name="perusahaan_selected" id="perusahaan_selected" value="{{ $data['id_perusahaan'] }}">
                     

                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Menu</label>
                            <div class="col-sm-4">
                               <select name="menu" onchange="selectMenu(this.value)" class="form-control" required>
                                <option value="">-</option>
                                @foreach ($skema as $item)
                                    <option {{ $data['menu'] == $item->id ? 'selected':'' }} value="{{ $item->id }}">{{ $item->nama_skema_sertifikasi }}</option>
                                @endforeach
                               </select>
                            </div>

                        </div>
                        

                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Ruang Lingkup</label>
                            <div class="col-sm-10">
                               <select name="id_ruang_lingkup" id="id_ruang_lingkup" class="form-control select2" required>
                                    <option value="">-</option>
                               </select>
                            </div>
                        </div>
                        <input type="hidden" name="ruang_lingkup_selected" id="ruang_lingkup_selected" value="{{ $data['id_ruang_lingkup'] }}">

                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Dua Digit</label>
                            <div class="col-sm-4">
                               <input type="text" name="dua_digit" class="form-control" value="{{ $data['dua_digit'] }}">
                            </div>
                            <label for="file" class="col-sm-2 col-form-label">Sub Kelompok</label>
                            <div class="col-sm-4">
                               <input type="text" name="sub_kelompok" class="form-control"  value="{{ $data['sub_kelompok'] }}">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Nace</label>
                            <div class="col-sm-4">
                               <input type="text" name="nace" class="form-control"  value="{{ $data['nace'] }}">
                            </div>
                            <label for="file" class="col-sm-2 col-form-label">Lingkup</label>
                            <div class="col-sm-4">
                               <input type="text" name="lingkup" class="form-control"  value="{{ $data['lingkup'] }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Penerapan SNI</label>
                            <div class="col-sm-4">
                               <input type="text" name="penerapan_sni" class="form-control"  value="{{ $data['penerapan_sni'] }}">
                            </div>
                            <label for="file" class="col-sm-2 col-form-label">Tersertifikasi Sejak</label>
                            <div class="col-sm-4">
                               <input type="date" name="tersertifikasi_sejak" class="form-control"  value="{{ $data['tersertifikasi_sejak'] }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Tanggal Terbit</label>
                            <div class="col-sm-4">
                               <input type="date" name="tanggal_terbit" class="form-control"  value="{{ $data['tanggal_terbit'] }}">
                            </div>
                            <label for="file" class="col-sm-2 col-form-label">Tanggal Berakhir</label>
                            <div class="col-sm-4">
                               <input type="date" name="tanggal_berakhir" class="form-control"  value="{{ $data['tanggal_berakhir'] }}">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Merek</label>
                            <div class="col-sm-4">
                               <input type="text" name="merek" class="form-control" value="{{ $data['merek'] }}">
                            </div>
                            <label for="file" class="col-sm-2 col-form-label">Tipe</label>
                            <div class="col-sm-4">
                               <input type="text" name="tipe" class="form-control" value="{{ $data['tipe'] }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Status Sertifikat</label>
                            <div class="col-sm-4">
                               <select name="status_sertifikat" class="form-control" required>
                                    <option value="-">-</option>
                                    <option {{ $data['status_sertifikat'] == 'AKTIF' ? 'selected':'' }} value="AKTIF">AKTIF</option>
                                    <option {{ $data['status_sertifikat'] == 'DICABUT' ? 'selected':'' }} value="DICABUT">DICABUT</option>
                                    <option {{ $data['status_sertifikat'] == 'DITANGGUHKAN' ? 'selected':'' }} value="DITANGGUHKAN">DITANGGUHKAN</option>
                                    <option {{ $data['status_sertifikat'] == 'LEWAT TANGGAL BERAKHIR' ? 'selected':'' }} value="LEWAT TANGGAL BERAKHIR">LEWAT TANGGAL BERAKHIR</option>
                               </select>
                            </div>
                            
                        </div>

                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                               <input type="text" name="keterangan" class="form-control" value="{{ $data['keterangan'] }}">
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-footer">
                        <button id="btnSave" type="submit" class="btn btn-info">Simpan</button>
                        <a href="{{ route('sertifikat.index') }}" class="btn btn-default">Batal</a>
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
      $(document).ready(function() {
        // Fetch data and populate select dropdown
          var selectedValue = document.getElementById('perusahaan_selected').value;
       
          $.ajax({
              url: '{{url("get-klien-list")}}',
              method: 'GET',
              success: function(data) {
                  $('#id_perusahaan').empty().append('<option value="">-</option>');
                  $.each(data, function(key, value) {
                     $('#id_perusahaan').append('<option value="'+ value.id_perusahaan +'">'+value.id_perusahaan+' '+value.jenis_badan_usaha+' '+ value.nama_perusahaan +'</option>');
                  });
                  $('#id_perusahaan').val(selectedValue).trigger('change');
                  $('#id_perusahaan').select2();
              }
          });
          var selectedLingkup = document.getElementById('ruang_lingkup_selected').value;
          $.ajax({
              url: '{{url("get-ruang-lingkup")}}',
              method: 'GET',
              success: function(data) {
                  $('#id_ruang_lingkup').empty().append('<option value="">-</option>');
                  $.each(data, function(key, value) {
                      $('#id_ruang_lingkup').append('<option value="'+ value.id +'">'+ value.nomor_standar +' '+value.judul_standar+'</option>');
                  });
                  $('#id_ruang_lingkup').val(selectedLingkup).trigger('change');
                  $('#id_ruang_lingkup').select2();
              }
          });
      });


        function validateFile() {
            const fileInput = document.getElementById('file');
            const filePath = fileInput.value;
            const allowedExtensions = /(\.pdf|\.docx|\.doc)$/i;
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
    </script>
  @endsection