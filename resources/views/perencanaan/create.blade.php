@extends('layouts.master')

@section('title','Perencanaan')
@section('css')

@endsection
@section('content')  
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Perencanaan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Perencanaan</a></li>
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
                <form action="{{ route('perencanaan.store') }}" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        
                        
                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Nama Perusahaan</label>
                            <div class="col-sm-6">
                               <select name="id_perusahaan" id="id_perusahaan" onchange="permohonanNoProses()" class="form-control select2">
                                <option value="">-</option>
                                @foreach ($klien as $item)
                                    <option value="{{ $item->id_perusahaan }}">{{ $item->jenis_badan_usaha.' '.$item->nama_perusahaan }}</option>
                                @endforeach
                               </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Nomor Proses</label>
                            <div class="col-sm-4">
                               <select name="no_proses" id="no_proses" onchange="nomorProsesPerusahaan()" class="form-control select2">
                                    <option value="">-</option>
                               </select>
                            </div>
                            <div class="col-sm-2">
                               <a onclick="tambahNoProses()" class="btn btn-primary">Tambah Nomor Proses</a>
                            </div>
                        </div>

                        <div id="noProsesBaru" style="display: none">
                            <div class="form-group row">
                                <label for="file" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-4">
                                    <input type="text" name="no_proses_baru" placeholder="Nomor Proses Baru" class="form-control">
                                </div>
                            </div>
                        </div>

                        

                        
                            <a class="btn btn-success" data-toggle="modal" data-target="#modal">
                               Tambah Nomor Order
                            </a>
                            <br/><br/>
                            <table id="tablePermohonan" class="table stripted-table">
                                <tr>
                                    <th>Action</th>
                                    <th>Nomor Proses</th>
                                    <th>Nomor Order</th>
                                    <th>Menu</th>
                                    <th>Tujuan</th>
                                    <th>Nomor Standar</th>
                                    <th>Sertifikat Referensi</th>
                                </tr>
                            </table>
                        
                        
                        <br/><br/>
                        <h5>Auditor Kepala</h5>
                        <hr style="border:1px solid blue;">
                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Jumlah Auditor Kepala</label>
                            <div class="col-sm-4">
                               <input type="number" name="jml_auditor_kepala" class="form-control">
                            </div>
                            <label for="file" class="col-sm-2 col-form-label">Hari Kerja Auditor Kepala</label>
                            <div class="col-sm-4">
                               <input type="number" name="hari_kerja_auditor_kepala" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Hari Perdiem Auditor Kepala</label>
                            <div class="col-sm-4">
                               <input type="number" name="jumlah_perdiem_auditor_kepala" class="form-control">
                            </div>
                            
                        </div>
                        <br/>
                        <h5>Auditor</h5>
                        <hr style="border:1px solid blue;">
                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Jumlah Auditor</label>
                            <div class="col-sm-4">
                               <input type="number" name="jumlah_auditor" class="form-control">
                            </div>
                            <label for="file" class="col-sm-2 col-form-label">Hari Kerja Auditor</label>
                            <div class="col-sm-4">
                               <input type="number" name="hari_kerja_auditor" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Hari Perdiem Auditor</label>
                            <div class="col-sm-4">
                               <input type="number" name="hari_perdiem_auditor" class="form-control">
                            </div>

                            <label for="file" class="col-sm-2 col-form-label">Jumlah Mandays Auditor</label>
                            <div class="col-sm-4">
                               <input type="number" name="jumlah_mandays_auditor" class="form-control">
                            </div>
                            
                        </div>

                        <br/>
                        <h5>Tenaga Ahli</h5>
                        <hr style="border:1px solid blue;">


                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Jumlah Tenaga Ahli</label>
                            <div class="col-sm-4">
                               <input type="number" name="jumlah_tenaga_ahli" class="form-control">
                            </div>

                            <label for="file" class="col-sm-2 col-form-label">Jumlah Mandays Tenaga Ahli</label>
                            <div class="col-sm-4">
                               <input type="number" name="jumlah_mandays_tenaga_ahli" class="form-control">
                            </div>
                            
                        </div>

                        <br/>
                        <h5>Observer</h5>
                        <hr style="border:1px solid blue;">


                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Jumlah Observer</label>
                            <div class="col-sm-4">
                               <input type="number" name="jumlah_observer" class="form-control">
                            </div>

                            <label for="file" class="col-sm-2 col-form-label">Jumlah Mandays Observer</label>
                            <div class="col-sm-4">
                               <input type="number" name="jumlah_mandays_observer" class="form-control">
                            </div>
                            
                        </div>

                        <br/>
                        <h5>Petugas Pengambil Contoh</h5>
                        <hr style="border:1px solid blue;">


                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Jumlah PPC</label>
                            <div class="col-sm-4">
                               <input type="number" name="jumlah_ppc" class="form-control">
                            </div>

                            <label for="file" class="col-sm-2 col-form-label">Jumlah Mandays PPC</label>
                            <div class="col-sm-4">
                               <input type="number" name="jumlah_mandays_ppc" class="form-control">
                            </div>
                            
                        </div>


                        <br/>
                        <h5>Per Diem</h5>
                        <hr style="border:1px solid blue;">


                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Jumlah Orang per Diem</label>
                            <div class="col-sm-4">
                               <input type="number" name="jumlah_perdiem" class="form-control">
                            </div>

                            <label for="file" class="col-sm-2 col-form-label">Jumlah per Diem per personel</label>
                            <div class="col-sm-4">
                               <input type="number" name="jumlah_perdiem_personel" class="form-control">
                            </div>
                            
                        </div>
                        <br/>
                        <hr style="border:1px solid blue;">

                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Jumlah SNI</label>
                            <div class="col-sm-4">
                               <input type="number" name="jumlah_sni" class="form-control">
                            </div>

                            <label for="file" class="col-sm-2 col-form-label">Jumlah Sertifikat</label>
                            <div class="col-sm-4">
                               <input type="number" name="jumlah_sertifikat" class="form-control">
                            </div>
                            
                        </div>
                        <br/>
                        <table class="table stripted-table">
                            <tr>
                                <th style="width: 26%">Asal Produk/ Lokasi Pabrik</th>
                                <th style="width: 3%">:</th>
                                <th id="asalProduk"></th>
                            </tr>
                            <tr>
                                <th>Jumlah Tahapan Proses</th>
                                <th>:</th>
                                <th id="jumlahTahapanProses"></th>
                            </tr>
                            <tr>
                                <th>Jumlah Line Produksi</th>
                                <th>:</th>
                                <th id="jumlahLineProduksi"></th>
                            </tr>
                            <tr>
                                <th>Jumlah Shift Per Hari</th>
                                <th>:</th>
                                <th id="jumlahShiftPerHari"></th>
                            </tr>
                            <tr>
                                <th>Jumlah Jam Kerja Per Hari</th>
                                <th>:</th>
                                <th id="jumlahJamKerja"></th>
                            </tr>
                            <tr>
                                <th>Kapasitas Produksi Per Hari</th>
                                <th>:</th>
                                <th id="kapasitasProduksi"></th>
                            </tr>
                            <tr>
                                <th>Jumlah Karyawan Terkait Produk Disertifikasi</th>
                                <th>:</th>
                                <th id="jumlahKaryawan"></th>
                            </tr>
                            
                        </table>
                       
                        
                        
                        
                    </div>
                    <div class="card-footer">
                        <button id="btnSave" type="submit" class="btn btn-info">Simpan</button>
                        <a href="{{ route('perencanaan.index') }}" class="btn btn-default">Batal</a>
                    </div>
                </form>
            </div>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <div class="modal fade" id="modal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    
                </div>
                <div class="modal-body">
                    <table id="tablePermohonanPerusahaan" class="table stripted-table">
                        <tr>
                            <th>Action</th>
                            <th>Nomor Proses</th>
                            <th>Nomor Order</th>
                            <th>Menu</th>
                            <th>Tujuan</th>
                            <th>Nomor Standar</th>
                            <th>Sertifikat Referensi</th>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" id="pilihButton" class="btn btn-primary">Pilih</button>
                    <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
                </div>
            </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
  @endsection
  @section('js')
    <script>
      $('.select2').select2();
      function permohonanNoProses() {
        // Fetch data and populate select dropdown
        
          $.ajax({
                method: 'POST',
                url: '{{url("get-permohonan-client")}}',
                data:{
                        _token: '{{csrf_token()}}', 
                        id_perusahaan: $('#id_perusahaan').find(":selected").val(),
                },
                success: function(data) {
                    var $select = $("#no_proses");
                    var $table = $("#tablePermohonan");
                    $select.empty(); // Clear the previous options
                    $select.append('<option value="">Pilih No Proses</option>'); // Add a default option
                    $.each(data, function(key, value) {
                        $select.append('<option value="' + value.no_proses + '">' + value.no_proses + '</option>');
                    });
                    $table.find("tr:gt(0)").remove(); // Clear previous rows, except the header
                }
          });

          $.ajax({
                method: 'POST',
                url: '{{url("no-proses-client-null")}}',
                data:{
                        _token: '{{csrf_token()}}', 
                        id_perusahaan: $('#id_perusahaan').find(":selected").val(),
                },
                success: function(data) {
                    var $tablePerusahaan = $("#tablePermohonanPerusahaan");
                    var $table = $("#tablePermohonan");
                    $tablePerusahaan.find("tr:gt(0)").remove(); // Clear previous rows, except the header
                    $table.find("tr:gt(0)").remove(); // Clear previous rows, except the header
                    
                    $.each(data, function(index, value) {
                        var no_proses = '';
                        if (value.no_proses) {
                            no_proses = value.no_proses;
                        }
                        var row = '<tr>' +
                            "<td><input type='checkbox' name='pilihNoProses[]' class='form-control' value='"+value.id+"'></td>" +
                            '<td>' + no_proses + '</td>' +
                            '<td>' + value.no_order + '</td>' +
                            '<td>' + value.nama_skema_sertifikasi + '</td>' +
                            '<td>' + value.nama_tujuan_audit + '</td>' +
                            '<td>' + value.nomor_standar + '</td>' +
                            '<td>' + value.no_sertifikat + '</td>' +
                            '</tr>';
                        $tablePerusahaan.append(row);
                    });
                }
          });


          $.ajax({
                method: 'POST',
                url: '{{url("get-klien-where")}}',
                data:{
                        _token: '{{csrf_token()}}', 
                        id_perusahaan: $('#id_perusahaan').find(":selected").val(),
                },
                success: function(data) {
                    document.getElementById("asalProduk").innerHTML = data[0].provinsi_pabrik?data[0].provinsi_pabrik:'';
                    document.getElementById("jumlahTahapanProses").innerHTML = data[0].jumlah_tahapan_proses?data[0].jumlah_tahapan_proses:'';
                    document.getElementById("jumlahLineProduksi").innerHTML = data[0].line_produksi?data[0].line_produksi:'';                    
                    document.getElementById("jumlahShiftPerHari").innerHTML = data[0].jumlah_shift_per_hari?data[0].jumlah_shift_per_hari:'';
                    document.getElementById("jumlahJamKerja").innerHTML = data[0].jml_kerja_per_hari?data[0].jml_kerja_per_hari:'';
                    document.getElementById("kapasitasProduksi").innerHTML = data[0].kapasitas_produksi_per_hari?data[0].kapasitas_produksi_per_hari:'';
                    document.getElementById("jumlahKaryawan").innerHTML = data[0].jml_kary_produksi?data[0].jml_kary_produksi:'';
                    
                }
          });
      }


    $('#pilihButton').click(function() {
        var $tableModal = $("#tablePermohonanPerusahaan");
        var $tableMain = $("#tablePermohonan");

        // Loop through checked rows in modal table
        $tableModal.find("input[name='pilihNoProses[]']:checked").each(function() {
            var $row = $(this).closest('tr').clone(); // Clone the selected row
            //console.log($row.html());
            // Get the value ID from the original row in the modal table
            var valueId = $row.find("input[name='pilihNoProses[]']").val();
            console.log(valueId); // Check if valueId is correctly fetched

            // Update the cloned row's checkbox value attribute
            $row.find('td:first').html("<input type='checkbox' name='pilihNoProses[]' checked class='form-control' value='" + valueId + "'>");

            // Append the modified row to the main table
            $tableMain.append($row);

            // Optionally, remove the original row from the modal table
            // $(this).closest('tr').remove(); // Commented out for debugging purposes
        });

        // Remove the checked rows from the modal table
        $tableModal.find("input[name='pilihNoProses[]']:checked").closest('tr').remove();

        // Optionally, close the modal after processing
        $('#modal').modal('hide');
    });
      
      function tambahNoProses() {
        $('#noProsesBaru').show();
      }

      function nomorProsesPerusahaan() {
            
            $.ajax({
                method: 'POST',
                url: '{{url("get-permohonan-no-proses")}}',
                data:{
                        _token: '{{csrf_token()}}', 
                        id_perusahaan: $('#id_perusahaan').find(":selected").val(),
                        no_proses: $('#no_proses').find(":selected").val(),
                },
                success: function(data) {
                    //console.log(data);
                    var $table = $("#tablePermohonan");
                    var $tablePerusahaan = $("#tablePermohonanPerusahaan");

                    var existingIds = []; // Array to store IDs of existing rows
        
                    // Collect existing IDs from $tablePerusahaan
                    $tablePerusahaan.find("input[name='pilihNoProses[]']").each(function() {
                        existingIds.push($(this).val());
                    });
                    
                    var removedRows = []; // Array to store removed rows
                     $table.find("tr").each(function(index, row) {
                        var $row = $(row);
                        var rowData = {
                            id: $row.find("input[name='pilihNoProses[]']").val(),
                            no_proses: $row.find("td:eq(1)").text(),
                            no_order: $row.find("td:eq(2)").text(),
                            nama_skema_sertifikasi: $row.find("td:eq(3)").text(),
                            nama_tujuan_audit: $row.find("td:eq(4)").text(),
                            nomor_standar: $row.find("td:eq(5)").text(),
                            no_sertifikat: $row.find("td:eq(6)").text()
                        };

                        $tablePerusahaan.find("tr").each(function(indexPerusahaan, rowPerusahaan) {
                            var $rowPerusahaan = $(rowPerusahaan);
                            var rowDataPerusahaan = {
                                id: $rowPerusahaan.find("input[name='pilihNoProses[]']").val(),
                                no_proses: $rowPerusahaan.find("td:eq(1)").text(),
                                no_order: $rowPerusahaan.find("td:eq(2)").text(),
                                nama_skema_sertifikasi: $rowPerusahaan.find("td:eq(3)").text(),
                                nama_tujuan_audit: $rowPerusahaan.find("td:eq(4)").text(),
                                nomor_standar: $rowPerusahaan.find("td:eq(5)").text(),
                                no_sertifikat: $rowPerusahaan.find("td:eq(6)").text()
                            };
                            //console.log(rowData.no_proses);
                            // Check condition to determine if row should be removed
                            if (!rowData.no_proses) {
                            // console.log(rowDataPerusahaan.id);
                            // console.log(rowData.id);
                                if (rowDataPerusahaan.id != rowData.id) {
                                    var no_proses = '';
                                    if (rowData.no_proses) {
                                        no_proses = rowData.no_proses;
                                    }
                                     if (rowData.id && existingIds.indexOf(rowData.id) === -1) {
                                        // Construct HTML for row and push to removedRows array
                                        var rowHTML = '<tr>' +
                                            '<td><input type="checkbox" name="pilihNoProses[]" class="form-control" checked value="'+ rowData.id +'"></td>' +
                                            '<td>' + no_proses + '</td>' +
                                            '<td>' + rowData.no_order + '</td>' +
                                            '<td>' + rowData.nama_skema_sertifikasi + '</td>' +
                                            '<td>' + rowData.nama_tujuan_audit + '</td>' +
                                            '<td>' + rowData.nomor_standar + '</td>' +
                                            '<td>' + rowData.no_sertifikat + '</td>' +
                                            '</tr>';
                                        
                                        removedRows.push(rowHTML);
                                    }
                                }  
                            }
                        });
                        
                        
                    });

                    // Append removed rows to $tablePerusahaan
                    $tablePerusahaan.append(removedRows);

                    $table.find("tr:gt(0)").remove(); // Clear previous rows, except the header
                    
                    $.each(data, function(index, value) {
                        var no_proses = '';
                        if (value.no_proses) {
                            no_proses = value.no_proses;
                        }
                        var row = '<tr>' +
                            "<td><input type='checkbox' name='pilihNoProses[]' checked class='form-control' value='"+value.id+"'></td>" +
                            '<td>' + no_proses + '</td>' +
                            '<td>' + value.no_order + '</td>' +
                            '<td>' + value.nama_skema_sertifikasi + '</td>' +
                            '<td>' + value.nama_tujuan_audit + '</td>' +
                            '<td>' + value.nomor_standar + '</td>' +
                            '<td>' + value.no_sertifikat + '</td>' +
                            '</tr>';
                        
                        // Append row to main table
                        $table.append(row);
                        
                        
                    });
                     
                }
            });

            
      }

      function deleteRow(btn) {
            var rowData = btn.parentNode.parentNode;
            rowData.parentNode.removeChild(rowData);
      }
     
    </script>
  @endsection