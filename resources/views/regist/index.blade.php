@extends('layouts.regist')

@section('title','Registration')

@section('content')  
  
    {{-- <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-6" style="margin-left:auto; margin-right:auto;">
            <h1>{{ strtoupper(request()->segment(1)) }}</h1>
          </div>
          
        </div>
      </div>
    </section> --}}

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row" style="margin-top: 50px">
          <div class="col-10" style="margin-left:auto; margin-right:auto;">
            <div class="card">
                
              {{-- <div class="card-header">
                <h4>{{ strtoupper(request()->segment(1)) }}</h4>
              </div> --}}
              
              <div class="card-body">
                <div id="alertSuccess" style="display: none;" class="alert alert-success">
                    Perusahaan sudah terdaftar, silahkan login <a href="{{ route('login') }}">Klik disini</a>
                </div>
                @include('include.admin.alert')
                @if ($errors->has('captcha'))
                    <div class="alert alert-danger">
                        Captcha Salah !
                    </div>
                @endif
                <form class="form-horizontal" action="{{ route('regist') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        
                        <h5>Akun Pelanggan</h5>
                        <hr style="border:1px solid blue;">
                        <div class="form-group row">
                            <label for="id_perusahaan" class="col-sm-3 col-form-label">ID Perusahaan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" onclick="checkID()" onkeyup="checkListKlien(this.value)" name="id_perusahaan" id="id_perusahaan" placeholder="ID Perusahaan" value="{{ old('id_perusahaan') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Jenis Badan Usaha</label>
                            <div class="col-sm-9">
                                <select name="jenis_badan_usaha" id="jenis_badan_usaha" class="form-control" required>
                                    <option value="-">--</option>
                                    <option {{ old('jenis_badan_usaha') == 'UD' ? 'selected' : '' }} value="UD">UD</option>
                                    <option {{ old('jenis_badan_usaha') == 'Fa' ? 'selected' : '' }} value="Fa">Fa</option>
                                    <option {{ old('jenis_badan_usaha') == 'CV' ? 'selected' : '' }} value="CV">CV</option>
                                    <option {{ old('jenis_badan_usaha') == 'Koperasi' ? 'selected' : '' }} value="Koperasi">Koperasi</option>
                                    <option {{ old('jenis_badan_usaha') == 'PJ' ? 'selected' : '' }} value="PJ">PJ</option>
                                    <option {{ old('jenis_badan_usaha') == 'Perum' ? 'selected' : '' }} value="Perum">Perum</option>
                                    <option {{ old('jenis_badan_usaha') == 'PT' ? 'selected' : '' }} value="PT">PT</option>
                                    <option {{ old('jenis_badan_usaha') == 'Yayasan' ? 'selected' : '' }} value="Yayasan">Yayasan</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama_perusahaan" class="col-sm-3 col-form-label">Nama Perusahaan Produsen</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan" placeholder="Nama Perusahaan Produsen" value="{{ old('nama_perusahaan') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ln_dn" class="col-sm-3 col-form-label">Jenis Produsen</label>
                            <div class="col-sm-9">
                                <select name="ln_dn" id="ln_dn" class="form-control" required>
                                    <option value="-">--</option>
                                    <option {{ old('ln_dn') == 'LN' ? 'selected' : '' }} value="LN">Luar Negeri</option>
                                    <option {{ old('ln_dn') == 'DN' ? 'selected' : '' }} value="DN">Dalam Negeri</option>
                                    <option {{ old('ln_dn') == 'DK' ? 'selected' : '' }} value="DK">Dalam Kota</option>
                                </select>
                            </div>
                        </div>
                        <br/>
                        <h5>Identitas Admin</h5>
                        <hr style="border:1px solid blue;">
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="{{ old('nama') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Posisi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="posisi" id="posisi" placeholder="Posisi" value="{{ old('posisi') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Perusahaan</label>
                            <div class="col-sm-4">
                                <select name="perusahaan" id="perusahaan" class="form-control" required>
                                    <option value="">--</option>
                                    <option {{ old('perusahaan') == 'Produsen' ? 'selected' : '' }} value="Produsen">Produsen</option>
                                    <option {{ old('perusahaan') == 'Penanggung Jawab' ? 'selected' : '' }} value="Penanggung Jawab">Penanggung Jawab</option>
                                    
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Email Admin</label>
                            <div class="col-sm-4">
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ old('email') }}" required>
                            </div>
                        </div>
                        <br/>
                        <h5>Registrasi User</h5>
                        <hr style="border:1px solid blue;">

                        <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-4">
                                <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="{{ old('username') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input id="inputPassword" type="password" name="password" autocomplete="on" class="form-control" placeholder="Password" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i onclick="myFunction()" id="iconPassword" class="fas fa-eye"></i>
                                            <!-- <span class="fas fa-lock"></span> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        <div class="form-group row">
                            <div class="col-2">
                                 <img src="{{ captcha_src() }}" alt="captcha" class="captcha-img" data-refresh-config="default">
                                 <i style="margin-left: 10px;" id="refresh-captcha" class="fas fa-sync-alt"></i>
                                 
                            </div>
                            
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="captcha" name="captcha" placeholder="Captcha" required>
                            </div>
                        </div>

                        {{-- <br/>
                        <h5>Status Registrasi</h5>
                        <hr style="border:1px solid blue;">
                        <table id="statusRegistrasi" class="table stripted-table">
                            <tr>
                                <th>Tanggal Pengajuan</th>
                                <th>Tanggal Selesai</th>
                                <th>Status</th>
                                <th>Catatan</th>
                            </tr>
                            
                        </table> --}}

                       
                    
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button id="btnSave" type="submit" class="btn btn-info">Simpan</button>
                        
                    </div>
                    <!-- /.card-footer -->
                </form>

                 <div class="modal fade" id="modal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"></h4>
                                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button> --}}
                            </div>
                            <div class="modal-body">
                               Silahkan menghubungi customer service kami via WhatsApp Halo BSPJI Jakarta 
                               <a href="https://api.whatsapp.com/send?phone=+6289517300975&text=Saya%20Ingin%20Mengetahui%20ID%20Pelanggan%20Saya" target="_blank">0895-1730-0975</a> 
                               untuk mengetahui ID Pelanggan Anda
                            </div>
                            <div class="modal-footer justify-content-between">
                                
                                <button type="button" data-dismiss="modal" onclick="confirmWA()" class="btn btn-primary">Sudah Whatsapp</button>
                            </div>
                        </div>
                    <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
              

              </div>
            </div>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  @endsection
  @section('js')
  
    <script>
        function formatDateTimeStringIndonesia(dateString) {
            // Konversi string ke objek Date
            const date = new Date(dateString);
            
            // Pastikan konversi ke objek Date berhasil
            if (isNaN(date)) {
                throw new Error("Invalid date string format");
            }

            // Opsi format tanggal
            const optionsDate = { year: 'numeric', month: 'long', day: 'numeric' };
            // Opsi format waktu
            const optionsTime = { hour: '2-digit', minute: '2-digit', second: '2-digit' };

            // Format tanggal dan waktu
            const formattedDate = new Intl.DateTimeFormat('id-ID', optionsDate).format(date);
            const formattedTime = new Intl.DateTimeFormat('id-ID', optionsTime).format(date);

            // Gabungkan format tanggal dan waktu
            return `${formattedDate} ${formattedTime}`;
        }

        window.addEventListener('load', () => {
            // Kosongkan local storage
            localStorage.clear();
        });
        function checkID() {
           //localStorage.setItem('modalShown', 'false');
           if (!localStorage.getItem('confirmWA')) {
                // Show the modal
                //var myModal = new bootstrap.Modal(document.getElementById('modal'));
                var myModal = new bootstrap.Modal(document.getElementById('modal'), {
                    backdrop: 'static',
                    keyboard: false
                });
                myModal.show();

                // Set the modalShown flag in local storage
                //localStorage.setItem('modalShown', 'false');
            }
        }
        function confirmWA() {
            localStorage.setItem('confirmWA', 'true');
        }

        function myFunction() {
            var x = document.getElementById("inputPassword");
            var z = document.getElementById("iconPassword");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }

            if (z.className === "fas fa-eye") {
                z.className = "fas fa-eye-slash";
            } else {
                z.className = "fas fa-eye";
            }
        }

        document.getElementById('refresh-captcha').onclick = function(e) {
            e.preventDefault();
            var captchaImage = document.querySelector('.captcha-img');
            captchaImage.src = '{{ url("/captcha?rnd='+Math.random()+'") }}'
        };

        function checkListKlien(value) {
            $.ajax({
                method: 'GET',
                url: '{{url("get-klien")}}',
                data:{
                        
                    id_perusahaan: value,
                },
                success: function(data) {
                    //console.log(data);
                    var dataKlien = data.data;
                    var fromData = data.from_data;
                    var registData = data.data_regist;
                    $("#btnSave").show();
                    $("#alertSuccess").hide();
                    if (dataKlien.length > 0) {
                        if (fromData == 'klien') {
                            $("#ln_dn").val(dataKlien[0].jenis_produsen).change();
                        }else{
                            $("#btnSave").hide();
                            $("#alertSuccess").show();
                            
                            $("#ln_dn").val(dataKlien[0].ln_dn).change();
                            document.getElementsByName("nama")[0].value = dataKlien[0].nama;
                            document.getElementsByName("posisi")[0].value = dataKlien[0].posisi;
                            $("#perusahaan").val(dataKlien[0].perusahaan).change();
                            document.getElementsByName("email")[0].value = dataKlien[0].email;
                            document.getElementsByName("username")[0].value = dataKlien[0].username;
                            if (
                                false
                                //registData.length > 0
                            ) {
                                var table;
                                table = '';
                                table += '<table id="statusRegistrasi" class="table stripted-table">';
                                table += '<th>Tanggal Pengajuan</th>';
                                table += '<th>Tanggal Selesai</th>';
                                table += '<th>Status</th>';
                                table += '<th>Catatan</th>';
                                for (let index = 0; index < registData.length; index++) {
                                    //const element = array[index];
                                    var tanggalSelesai = '';
                                    var tanggalPengajuan = '';
                                    if (registData[index].tanggal_selesai) {
                                        tanggalSelesai = formatDateTimeStringIndonesia(registData[index].tanggal_selesai)
                                    }

                                    if (registData[index].tanggal_pengajuan) {
                                        tanggalPengajuan = formatDateTimeStringIndonesia(registData[index].tanggal_pengajuan)
                                    }
                                    var catatan = '';
                                    if (registData[index].catatan != null) {
                                        catatan = registData[index].catatan;
                                    }
                                    var status = '';
                                    if (registData[index].status == 0) {
                                        status = 'Menunggu Verifikasi';
                                    }
                                    //console.log(catatan);
                                    table += '<tr>';
                                    table += '<td>'+tanggalPengajuan+'</td>';
                                    table += '<td>'+tanggalSelesai+'</td>';
                                    table += '<td>'+status+'</td>';
                                    table += '<td>'+catatan+'</td>';
                                    table += '</tr>';
                                }
                                table += '</table>'
                                document.getElementById("statusRegistrasi").innerHTML = table;
                            }
                            
                        }
                        document.getElementsByName("nama_perusahaan")[0].value = dataKlien[0].nama_perusahaan;
                        $("#jenis_badan_usaha").val(dataKlien[0].jenis_badan_usaha).change();

                    }else{
                            $("#ln_dn").val('-').change();
                            document.getElementsByName("nama")[0].value = '';
                            document.getElementsByName("posisi")[0].value = '';
                            $("#perusahaan").val('-').change();
                            document.getElementsByName("email")[0].value = '';
                            document.getElementsByName("nama_perusahaan")[0].value = '';
                            document.getElementsByName("username")[0].value = '';
                            $("#jenis_badan_usaha").val('-').change();
                    }
                    //$("#id_kabupaten_kota").html(data);
                }

            });
        }
    </script>
  @endsection