// Copyright [2025] [Wendy]

// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at

//     http://www.apache.org/licenses/LICENSE-2.0

// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.

const BASE_URL = "http://localhost/weidminton/public/";

/*
// ANGGOTA
*/

// Tambah Nominal Transaksi Anggota
$(document).on('submit', '#formTambahNTA', function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    formData.append("tambah_nominal_ta", true)
    $.ajax({
        type: "POST",
        url: BASE_URL + "admin/transaksi_anggota/tambah_nominal",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                document.getElementById('errorTambahNTA').style.display='block';
                $('#errorTambahNTA').text(res.pesan);
            } else if(res.status == 200) {
                document.getElementById('errorTambahNTA').style.display='none';
                $('#modalTambahNTA').modal('hide');
                $('#formTambahNTA')[0].reset();
                var delay = alertify.get('notifier','delay');
                alertify.set('notifier','position', 'top-center');
                alertify.notify(res.pesan, 'success', 5, function(){console.log('dismissed');});
                $('#formTambahTA').load(location.href + " #formTambahTA");
                $('#tabelNTA').load(location.href + " #tabelNTA");
            }
        }
    });
});

// Tombol Ubah Nominal Transaksi Anggota
$(document).on('click', '.tombolUbahNTA', function () {
    const id_nta = $(this).data('id-nta');

    $.ajax({
        url: BASE_URL + "admin/transaksi_anggota/detail_nominal",
        data: {id_nta : id_nta},
        method: "POST",
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                alert(res.pesan);
            } else if(res.status == 200) {
                $('#id_nta').val(res.data.id_nta);
                $('#jenis').val(res.data.jenis);
                $('#jumlah_main').val(res.data.jumlah_main);
                $('#nominal').val(res.data.nominal);
            }
        }
    });
});

// Ubah Transaksi Anggota
$(document).on('submit', '#formUbahNTA', function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    formData.append("ubah_nominal_transaksi_anggota", true)
    $.ajax({
        type: "POST",
        url: BASE_URL + "admin/transaksi_anggota/ubah_nominal",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                document.getElementById('errorUbahNTA').style.display='block';
                $('#errorUbahNTA').text(res.pesan);
            } else if(res.status == 200) {
                document.getElementById('errorUbahNTA').style.display='none';
                $('#modalUbahNTA').modal('hide');
                var delay = alertify.get('notifier','delay');
                alertify.set('notifier','position', 'top-center');
                alertify.notify(res.pesan, 'success', 5, function(){console.log('dismissed');});
                $('#formUbahNTA')[0].reset();
                $('#formTambahTA').load(location.href + " #formTambahTA");
                $('#tabelNTA').load(location.href + " #tabelNTA");
            }
        }
    });
});

// Hapus Nominal Transaksi Anggota
$(document).on('click', '.tombolHapusNTA', function (e) {
    e.preventDefault();
    if(confirm('Konfirmasi penghapusan nominal transaksi anggota?')){
        const id_nta = $(this).data('id-nta');
        $.ajax({
            type: "POST",
            url: BASE_URL + "admin/transaksi_anggota/hapus_nominal",
            data: {
                'hapus_nominal_transaksi_anggota': true,
                'id_nta': id_nta
            },
            success: function (response) {
                var res = jQuery.parseJSON(response);
                if(res.status == 500) {
                    alert(res.pesan);
                } else {
                    alertify.set('notifier','position', 'top-center');
                    var delay = alertify.get('notifier','delay');
                    alertify.set('notifier','position', 'top-center');
                    alertify.notify(res.pesan, 'success', 5, function(){console.log('dismissed');});
                    $('#formTambahTA').load(location.href + " #formTambahTA");
                    $('#tabelNTA').load(location.href + " #tabelNTA");
                }
            }
        });
    }
});


/*
// ANGGOTA
*/

// Tambah Anggota
$(document).on('submit', '#formTambahAnggota', function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    formData.append("tambah_anggota", true)
    $.ajax({
        type: "POST",
        url: BASE_URL + "admin/anggota/tambah",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                document.getElementById('errorTambahAnggota').style.display='block';
                $('#errorTambahAnggota').text(res.pesan);
            } else if(res.status == 409) {
                document.getElementById('errorTambahAnggota').style.display='block';
                $('#errorTambahAnggota').text(res.pesan);
            } else if(res.status == 200) {
                document.getElementById('errorTambahAnggota').style.display='none';
                $('#modalTambahAnggota').modal('hide');
                $('#formTambahAnggota')[0].reset();
                var delay = alertify.get('notifier','delay');
                alertify.set('notifier','position', 'top-center');
                alertify.notify(res.pesan, 'success', 5, function(){console.log('dismissed');});
                $('.dataAnggota').load(location.href + " .dataAnggota");
                $('#tabelAnggota').load(location.href + " #tabelAnggota");
            }
        }
    });
});

// Tombol Ubah Anggota
$(document).on('click', '.tombolUbahAnggota', function () {
    const id_anggota = $(this).data('id-anggota');

    $.ajax({
        url: BASE_URL + "admin/anggota/detail",
        data: {id_anggota : id_anggota},
        method: "POST",
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                alert(res.pesan);
            } else if(res.status == 200) {
                $('#id_anggota').val(res.data.id_anggota);
                $('#nama').val(res.data.nama);
                $('#jenis_kelamin').val(res.data.jenis_kelamin);
                $('#domisili').val(res.data.domisili);
            }
        }
    });
});

// Ubah Anggota
$(document).on('submit', '#formUbahAnggota', function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    formData.append("ubah_anggota", true)
    $.ajax({
        type: "POST",
        url: BASE_URL + "admin/anggota/ubah",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                document.getElementById('errorUbahAnggota').style.display='block';
                $('#errorUbahAnggota').text(res.pesan);
            } else if(res.status == 409) {
                document.getElementById('errorUbahAnggota').style.display='block';
                $('#errorUbahAnggota').text(res.pesan);
            } else if(res.status == 200) {
                document.getElementById('errorUbahAnggota').style.display='none';
                $('#modalUbahAnggota').modal('hide');
                var delay = alertify.get('notifier','delay');
                alertify.set('notifier','position', 'top-center');
                alertify.notify(res.pesan, 'success', 5, function(){console.log('dismissed');});
                $('#formUbahAnggota')[0].reset();
                $('.dataAnggota').load(location.href + " .dataAnggota");
                $('#tabelAnggota').load(location.href + " #tabelAnggota");
            }
        }
    });
});

// Hapus Anggota
$(document).on('click', '.tombolHapusAnggota', function (e) {
    e.preventDefault();
    if(confirm('Konfirmasi penghapusan anggota?')){
        const id_anggota = $(this).data('id-anggota');
        $.ajax({
            type: "POST",
            url: BASE_URL + "admin/anggota/hapus",
            data: {
                'hapus_anggota': true,
                'id_anggota': id_anggota
            },
            success: function (response) {
                var res = jQuery.parseJSON(response);
                if(res.status == 500) {
                    alert(res.pesan);
                } else {
                    alertify.set('notifier','position', 'top-center');
                    var delay = alertify.get('notifier','delay');
                    alertify.set('notifier','position', 'top-center');
                    alertify.notify(res.pesan, 'success', 5, function(){console.log('dismissed');});
                    $('.dataAnggota').load(location.href + " .dataAnggota");
                    $('#tabelAnggota').load(location.href + " #tabelAnggota");
                }
            }
        });
    }
});

/*
// TRANSAKSI ANGGOTA
*/

// Tambah Transaksi Anggota
$(document).on('submit', '#formTambahTA', function (e) {
    e.preventDefault();

    var nominalSelect = $('#nominal_ta');
    var selectedOption = nominalSelect.find('option:selected');
    
    var jumlahMain = selectedOption.data('jumlah');

    var formData = new FormData(this);
    formData.append("jumlah_main", jumlahMain);
    formData.append("tambah_ta", true);

    $.ajax({
        type: "POST",
        url: BASE_URL + "admin/transaksi_anggota/tambah",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                document.getElementById('errorTambahTA').style.display='block';
                $('#errorTambahTA').text(res.pesan);
            } else if(res.status == 200) {
                document.getElementById('errorTambahTA').style.display='none';
                $('#modalTambahTA').modal('hide');
                $('#formTambahTA')[0].reset();
                var delay = alertify.get('notifier','delay');
                alertify.set('notifier','position', 'top-center');
                alertify.notify(res.pesan, 'success', 5, function(){console.log('dismissed');});
                $('.dataTransaksiAnggota').load(location.href + " .dataTransaksiAnggota");
                $('#tabelTA').load(location.href + " #tabelTA");
            }
        }
    });
});

// Tombol Ubah Transaksi Anggota
$(document).on('click', '.tombolUbahTA', function () {
    const id_ta = $(this).data('id-transaksi-anggota');

    $.ajax({
        url: BASE_URL + "admin/transaksi_anggota/detail",
        data: {id_ta : id_ta},
        method: "POST",
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                alert(res.pesan);
            } else if(res.status == 200) {
                $('#id_ta').val(res.data.id_ta);
                $('#nama_ta').val(res.data.nama_ta);
                $('#nominal_ta').val(res.data.nominal_ta);
                $('#tanggal_ta').val(res.data.tanggal_ta);
            }
        }
    });
});

// Ubah Transaksi Anggota
$(document).on('submit', '#formUbahTA', function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    formData.append("ubah_anggota", true)
    $.ajax({
        type: "POST",
        url: BASE_URL + "admin/transaksi_anggota/ubah",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                document.getElementById('errorUbahTA').style.display='block';
                $('#errorUbahTA').text(res.pesan);
            } else if(res.status == 200) {
                document.getElementById('errorUbahTA').style.display='none';
                $('#modalUbahTA').modal('hide');
                var delay = alertify.get('notifier','delay');
                alertify.set('notifier','position', 'top-center');
                alertify.notify(res.pesan, 'success', 5, function(){console.log('dismissed');});
                $('#formUbahTA')[0].reset();
                $('.dataTransaksiAnggota').load(location.href + " .dataTransaksiAnggota");
                $('#tabelTA').load(location.href + " #tabelTA");
            }
        }
    });
});

// Hapus Transaksi Anggota
$(document).on('click', '.tombolHapusTA', function (e) {
    e.preventDefault();
    if(confirm('Konfirmasi penghapusan transaksi anggota?')){
        const id_ta = $(this).data('id-transaksi-anggota');
        $.ajax({
            type: "POST",
            url: BASE_URL + "admin/transaksi_anggota/hapus",
            data: {
                'hapus_ta': true,
                'id_ta': id_ta
            },
            success: function (response) {
                var res = jQuery.parseJSON(response);
                if(res.status == 500) {
                    alert(res.pesan);
                } else {
                    alertify.set('notifier','position', 'top-center');
                    var delay = alertify.get('notifier','delay');
                    alertify.set('notifier','position', 'top-center');
                    alertify.notify(res.pesan, 'success', 5, function(){console.log('dismissed');});
                    $('.dataTransaksiAnggota').load(location.href + " .dataTransaksiAnggota");
                    $('#tabelTA').load(location.href + " #tabelTA");
                }
            }
        });
    }
});

/*
// TRANSAKSI BOLA
*/

// Tambah Transaksi Bola
$(document).on('submit', '#formTambahTB', function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    formData.append("tambah_tb", true)
    $.ajax({
        type: "POST",
        url: BASE_URL + "admin/transaksi_bola/tambah",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                document.getElementById('errorTambahTB').style.display='block';
                $('#errorTambahTB').text(res.pesan);
            } else if(res.status == 200) {
                document.getElementById('errorTambahTB').style.display='none';
                $('#modalTambahTB').modal('hide');
                $('#formTambahTB')[0].reset();
                var delay = alertify.get('notifier','delay');
                alertify.set('notifier','position', 'top-center');
                alertify.notify(res.pesan, 'success', 5, function(){console.log('dismissed');});
                $('.dataTransaksiBola').load(location.href + " .dataTransaksiBola");
                $('#tabelTB').load(location.href + " #tabelTB");
            }
        }
    });
});

// Tombol Ubah Transaksi Bola
$(document).on('click', '.tombolUbahTB', function () {
    const id_tb = $(this).data('id-transaksi-bola');

    $.ajax({
        url: BASE_URL + "admin/transaksi_bola/detail",
        data: {id_tb : id_tb},
        method: "POST",
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                alert(res.pesan);
            } else if(res.status == 200) {
                $('#id_tb').val(res.data.id_tb);
                $('#keterangan_tb').val(res.data.keterangan_tb);
                $('#jumlah_tb').val(res.data.jumlah_tb);
                $('#harga_tb').val(res.data.harga_tb);
                $('#tanggal_tb').val(res.data.tanggal_tb);
            }
        }
    });
});

// Ubah Transaksi Bola
$(document).on('submit', '#formUbahTB', function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    formData.append("ubah_tb", true)
    $.ajax({
        type: "POST",
        url: BASE_URL + "admin/transaksi_bola/ubah",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                document.getElementById('errorUbahTB').style.display='block';
                $('#errorUbahTB').text(res.pesan);
            } else if(res.status == 200) {
                document.getElementById('errorUbahTB').style.display='none';
                $('#modalUbahTB').modal('hide');
                var delay = alertify.get('notifier','delay');
                alertify.set('notifier','position', 'top-center');
                alertify.notify(res.pesan, 'success', 5, function(){console.log('dismissed');});
                $('#formUbahTB')[0].reset();
                $('.dataTransaksiBola').load(location.href + " .dataTransaksiBola");
                $('#tabelTB').load(location.href + " #tabelTB");
            }
        }
    });
});

// Hapus Transaksi Bola
$(document).on('click', '.tombolHapusTB', function (e) {
    e.preventDefault();
    if(confirm('Konfirmasi penghapusan transaksi bola?')){
        const id_tb = $(this).data('id-transaksi-bola');
        $.ajax({
            type: "POST",
            url: BASE_URL + "admin/transaksi_bola/hapus",
            data: {
                'hapus_tb': true,
                'id_tb': id_tb
            },
            success: function (response) {
                var res = jQuery.parseJSON(response);
                if(res.status == 500) {
                    alert(res.pesan);
                } else {
                    alertify.set('notifier','position', 'top-center');
                    var delay = alertify.get('notifier','delay');
                    alertify.set('notifier','position', 'top-center');
                    alertify.notify(res.pesan, 'success', 5, function(){console.log('dismissed');});
                    $('.dataTransaksiBola').load(location.href + " .dataTransaksiBola");
                    $('#tabelTB').load(location.href + " #tabelTB");
                }
            }
        });
    }
});

/*
// TRANSAKSI LAPANGAN
*/

// Tambah Transaksi Lapangan
$(document).on('submit', '#formTambahTL', function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    formData.append("tambah_tl", true)
    $.ajax({
        type: "POST",
        url: BASE_URL + "admin/transaksi_lapangan/tambah",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                document.getElementById('errorTambahTL').style.display='block';
                $('#errorTambahTL').text(res.pesan);
            } else if(res.status == 200) {
                document.getElementById('errorTambahTL').style.display='none';
                $('#modalTambahTL').modal('hide');
                $('#formTambahTL')[0].reset();
                var delay = alertify.get('notifier','delay');
                alertify.set('notifier','position', 'top-center');
                alertify.notify(res.pesan, 'success', 5, function(){console.log('dismissed');});
                $('.dataTransaksiLapangan').load(location.href + " .dataTransaksiLapangan");
                $('#tabelTL').load(location.href + " #tabelTL");
            }
        }
    });
});

// Tombol Ubah Transaksi Lapangan
$(document).on('click', '.tombolUbahTL', function () {
    const id_tl = $(this).data('id-transaksi-lapangan');

    $.ajax({
        url: BASE_URL + "admin/transaksi_lapangan/detail",
        data: {id_tl : id_tl},
        method: "POST",
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                alert(res.pesan);
            } else if(res.status == 200) {
                $('#id_tl').val(res.data.id_tl);
                $('#keterangan_tl').val(res.data.keterangan_tl);
                $('#harga_tl').val(res.data.harga_tl);
                $('#tanggal_tl').val(res.data.tanggal_tl);
            }
        }
    });
});

// Ubah Transaksi Lapangan
$(document).on('submit', '#formUbahTL', function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    formData.append("ubah_tl", true)
    $.ajax({
        type: "POST",
        url: BASE_URL + "admin/transaksi_lapangan/ubah",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                document.getElementById('errorUbahTL').style.display='block';
                $('#errorUbahTL').text(res.pesan);
            } else if(res.status == 200) {
                document.getElementById('errorUbahTL').style.display='none';
                $('#modalUbahTL').modal('hide');
                var delay = alertify.get('notifier','delay');
                alertify.set('notifier','position', 'top-center');
                alertify.notify(res.pesan, 'success', 5, function(){console.log('dismissed');});
                $('#formUbahTL')[0].reset();
                $('.dataTransaksiLapangan').load(location.href + " .dataTransaksiLapangan");
                $('#tabelTL').load(location.href + " #tabelTL");
            }
        }
    });
});

// Hapus Transaksi Lapangan
$(document).on('click', '.tombolHapusTL', function (e) {
    e.preventDefault();
    if(confirm('Konfirmasi penghapusan transaksi lapangan?')){
        const id_tl = $(this).data('id-transaksi-lapangan');
        $.ajax({
            type: "POST",
            url: BASE_URL + "admin/transaksi_lapangan/hapus",
            data: {
                'hapus_tl': true,
                'id_tl': id_tl
            },
            success: function (response) {
                var res = jQuery.parseJSON(response);
                if(res.status == 500) {
                    alert(res.pesan);
                } else {
                    alertify.set('notifier','position', 'top-center');
                    var delay = alertify.get('notifier','delay');
                    alertify.set('notifier','position', 'top-center');
                    alertify.notify(res.pesan, 'success', 5, function(){console.log('dismissed');});
                    $('.dataTransaksiLapangan').load(location.href + " .dataTransaksiLapangan");
                    $('#tabelTL').load(location.href + " #tabelTL");
                }
            }
        });
    }
});

/*
// TRANSAKSI LAINNYA
*/

// Tambah Transaksi Lainnya
$(document).on('submit', '#formTambahTLL', function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    formData.append("tambah_tll", true)
    $.ajax({
        type: "POST",
        url: BASE_URL + "admin/transaksi_lainnya/tambah",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                document.getElementById('errorTambahTLL').style.display='block';
                $('#errorTambahTLL').text(res.pesan);
            } else if(res.status == 200) {
                document.getElementById('errorTambahTLL').style.display='none';
                $('#modalTambahTLL').modal('hide');
                $('#formTambahTLL')[0].reset();
                var delay = alertify.get('notifier','delay');
                alertify.set('notifier','position', 'top-center');
                alertify.notify(res.pesan, 'success', 5, function(){console.log('dismissed');});
                $('.dataTransaksiLainnya').load(location.href + " .dataTransaksiLainnya");
                $('#tabelTLL').load(location.href + " #tabelTLL");
            }
        }
    });
});

// Tombol Ubah Transaksi Lainnya
$(document).on('click', '.tombolUbahTLL', function () {
    const id_tll = $(this).data('id-transaksi-lainnya');

    $.ajax({
        url: BASE_URL + "admin/transaksi_lainnya/detail",
        data: {id_tll : id_tll},
        method: "POST",
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                alert(res.pesan);
            } else if(res.status == 200) {
                $('#id_tll').val(res.data.id_tll);
                $('#keterangan_tll').val(res.data.keterangan_tll);
                $('#nominal_tll').val(res.data.nominal_tll);
                $('#tanggal_tll').val(res.data.tanggal_tll);
            }
        }
    });
});

// Ubah Transaksi Lainnya
$(document).on('submit', '#formUbahTLL', function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    formData.append("ubah_tll", true)
    $.ajax({
        type: "POST",
        url: BASE_URL + "admin/transaksi_lainnya/ubah",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                document.getElementById('errorUbahTLL').style.display='block';
                $('#errorUbahTLL').text(res.pesan);
            } else if(res.status == 200) {
                document.getElementById('errorUbahTLL').style.display='none';
                $('#modalUbahTLL').modal('hide');
                var delay = alertify.get('notifier','delay');
                alertify.set('notifier','position', 'top-center');
                alertify.notify(res.pesan, 'success', 5, function(){console.log('dismissed');});
                $('#formUbahTLL')[0].reset();
                $('.dataTransaksiLainnya').load(location.href + " .dataTransaksiLainnya");
                $('#tabelTLL').load(location.href + " #tabelTLL");
            }
        }
    });
});

// Hapus Transaksi Lainnya
$(document).on('click', '.tombolHapusTLL', function (e) {
    e.preventDefault();
    if(confirm('Konfirmasi penghapusan transaksi lainnya?')){
        const id_tll = $(this).data('id-transaksi-lainnya');
        $.ajax({
            type: "POST",
            url: BASE_URL + "admin/transaksi_lainnya/hapus",
            data: {
                'hapus_tll': true,
                'id_tll': id_tll
            },
            success: function (response) {
                var res = jQuery.parseJSON(response);
                if(res.status == 500) {
                    alert(res.pesan);
                } else {
                    alertify.set('notifier','position', 'top-center');
                    var delay = alertify.get('notifier','delay');
                    alertify.set('notifier','position', 'top-center');
                    alertify.notify(res.pesan, 'success', 5, function(){console.log('dismissed');});
                    $('.dataTransaksiLainnya').load(location.href + " .dataTransaksiLainnya");
                    $('#tabelTLL').load(location.href + " #tabelTLL");
                }
            }
        });
    }
});

/*
// ABSENSI
*/

// Tambah Absensi Anggota
$(document).on('submit', '#formAbsensi', function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    formData.append("tambah_absensi", true)
    $.ajax({
        type: "POST",
        url: BASE_URL + "admin/absensi/tambah",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                document.getElementById('errorAbsensi').style.display='block';
                $('#errorAbsensi').text(res.pesan);
            } else if(res.status == 200) {
                document.getElementById('errorAbsensi').style.display='none';
                $('#modalAbsensi').modal('hide');
                $('#formAbsensi')[0].reset();
                var delay = alertify.get('notifier','delay');
                alertify.set('notifier','position', 'top-center');
                alertify.notify(res.pesan, 'success', 5, function(){console.log('dismissed');});
                $('#tabelAbsensi').load(location.href + " #tabelAbsensi");
                $('#tabelAbsensiAnggota').load(location.href + " #tabelAbsensiAnggota");
                $('.dataBola').load(location.href + " .dataBola");
                $('.dataLapangan').load(location.href + " .dataLapangan");
            }
        }
    });
});

// Tombol Detail Absensi
$(document).on('click', '.tombolDetailAbsensi', function () {
    const tanggal_absensi = $(this).data('tanggal-absensi');

    $.ajax({
        url: BASE_URL + "admin/absensi/detail",
        data: {tanggal_absensi: tanggal_absensi},
        method: "POST",
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if(res.status == 404) {
                alert(res.pesan);
            } else if(res.status == 200) {
                $('#detailAbsensi').empty();
                res.data.forEach(function(absensi) {
                    $('#detailAbsensi').append(`
                        <li class="list-group-item bg-white">${absensi.nama}</li>
                    `);
                });
                $('#modalDetailAbsensi').modal('show');
            }
        }
    });
});

/*
// CHART PIE
*/

document.addEventListener("DOMContentLoaded", function() {
    // Pie chart
    new Chart(document.getElementById("chartjs-dashboard-pie"), {
        type: "pie",
        data: {
            labels: ["Pemasukan", "Pengeluaran"],
            datasets: [{
                data: [625000, 208000],
                backgroundColor: [
                    window.theme.success,
                    window.theme.danger
                ],
                borderWidth: 5
            }]
        },
        options: {
            responsive: !window.MSInputMethodContext,
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            cutoutPercentage: 75
        }
    });
});

/*
// CROPPIE
*/

// Croppie Avatar
const fileAvatar = document.getElementById('file_avatar');
const modalCrop = new bootstrap.Modal(document.getElementById('modalCrop'));
const croppieContainer = document.getElementById('croppie-container');
let croppieInstance;

fileAvatar.addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            modalCrop.show();

            document.getElementById('modalCrop').addEventListener('shown.bs.modal', function() {
                if (croppieInstance) {
                    croppieInstance.destroy();
                }

                croppieInstance = new Croppie(croppieContainer, {
                    viewport: {
                        width: 200,
                        height: 200,
                        type: 'circle'
                    },
                    boundary: {
                        width: 300,
                        height: 300,
                    },
                    showZoomer: true,
                    enableOrientation: true
                });

                croppieInstance.bind({
                    url: e.target.result
                });
            });
        }
        reader.readAsDataURL(file);
    }
})

const tombolCrop = document.getElementById('tombolCrop');
const pratinjauAvatar = document.getElementById('pratinjau_avatar');

tombolCrop.addEventListener('click', function() {
    if (croppieInstance) {
        croppieInstance.result({
            type: 'base64',
            format: 'png',
            size: {width: 200, height: 200}
        }).then(function(avatar_base64) {
            document.getElementById('avatar_base64').value = avatar_base64;
            pratinjauAvatar.src = avatar_base64;
            modalCrop.hide();
        });
    }
});