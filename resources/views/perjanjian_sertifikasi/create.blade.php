@extends('layouts.master')

@section('title','Perjanjian Sertifikasi')
@section('css')

@endsection
@section('content')  
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Perjanjian Sertifikasi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Perjanjian Sertifikasi</a></li>
              <li class="breadcrumb-item active">Create</li>
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
                <form action="{{ route('perjanjian_sertifikasi.store') }}" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        
                        
                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Sertifikasi</label>
                            <div class="col-sm-10">
                               <select name="jenis_sertifikasi" class="form-control" required>
                                    <option value="">-</option>
                                    <option value="Sertifikasi Produk">Sertifikasi Produk</option>
                                    <option value="Sertifikasi Sistem Manajemen">Sertifikasi Sistem Manajemen</option>
                               </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Perjanjian Sertifikasi</label>
                            <div class="col-sm-4">
                                <input type="file" name="file" onchange="validateFile()" id="file" class="form-control" required>
                                <div style="margin-top:10px; display: none;" id="alertSalinanExtention"
                                    class="alert alert-danger alert-dismissible" role="alert">
                                    <i class="fas fa-exclamation-circle"></i> File Harus berupa PDF/ Ms.Word
                                </div>

                                <div style="margin-top:6px; display: none;" id="alertSalinanPDF"
                                    class="alert alert-danger alert-dismissible" role="alert">
                                    <i class="fas fa-exclamation-circle"></i> File tidak boleh lebih dari 1
                                    MB
                                </div>
                            </div>
                        </div>
                        

                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Nomor</label>
                            <div class="col-sm-10">
                                <input type="text" name="nomor" class="form-control" required>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-footer">
                        <button id="btnSave" type="submit" class="btn btn-info">Simpan</button>
                        <a href="{{ route('perjanjian_sertifikasi.index') }}" class="btn btn-default">Batal</a>
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