$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

function buttonLoading(btn){
  if(btn.prop('disabled')){
    return;
  }
  btn.data('original-text', btn.html());
  btn.html('<span class="loading open-circle"></span> ' + btn.data('loading-text'));
  btn.prop('disabled', true);
}

function buttonIdle(btn){
  if(!btn.prop('disabled')){
    return;
  }
  btn.html(btn.data('original-text'));
  btn.prop('disabled', false);
}

function arrayToAssociative(arr, key){
  ret = [];

  if(data == null || !Array.isArray(data) || data.length == 0){
    console.log('EMPTY ARRAY');
    return ret;
  }

  if(data[0][key] === undefined){
    console.log('KEY NOT EXIST');
    return ret;
  }

  arr.forEach((e) => {
    ret[e[key]] = e;
  });

  return ret;
}

function capFirstLetter(str){
  return str.split(' ').map((str) => str[0].toUpperCase() + str.slice(1).toLowerCase()).reduce((acc, curr) => acc + curr + ' ', '').slice(0, -1);
}

function intToDay(val){
  switch(val){
    case 0: return 'Minggu';
    case 1: return 'Senin';
    case 2: return 'Selasa';
    case 3: return 'Rabu';
    case 4: return 'Kamis';
    case 5: return "Jum'at";
    case 6: return 'Sabtu';
  }
}

function empty(str){
  if(str == null || str.trim() == ""){
    return true;
  } else {
    return false;
  }
}

MONTHS = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

function renderDate(date){
  return `${date.getDate()} ${MONTHS[date.getMonth()]} ${date.getFullYear()}`;
}

function findAssociative(arr, field, value){
  for(var key in arr){
    var v = arr[key];
    if(v[field] && v[field] == value){
      return v;
    }
  }
  return null;
}

function filterAssociative(arr, field, value){
  var ret = [];
  for(var key in arr){
    var v = arr[key];
    if(v[field] && v[field] == value){
      ret.push(v);
    }
  }
  return ret;
}

function convertToRupiah(angka){
  var rupiah = '';
  if(angka == null) return '0';
	var angkarev = angka.toString().split('').reverse().join('');
  for(var i = 0; i < angkarev.length; i++){
    if(i % 3 == 0) rupiah += angkarev.substr(i,3) + ',';
  }
  rupiah = rupiah.split('',rupiah.length-1).reverse().join('');
  return (rupiah.length < 1 ? '0' : rupiah);
}



function convertToRupiahV2(value, fixed){
	return 'Rp' + parseFloat(value).toFixed(fixed).replace(".", ",").replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
}

SWALSAVE = {
  title: "Konfirmasi simpan",
  text: "Yakin akan menyimpan data ini?",
  type: "info",
  showCancelButton: true,
  confirmButtonColor: "#18a689",
  confirmButtonText: "Ya, Simpan!",
};

SWALDELETE = {
  title: "Konfirmasi hapus",
  text: "Yakin akan menghapus data ini?",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Ya, Hapus!",
};

function coloriseRealisasi(realisasi, na = false){
  var realisasi = parseFloat(realisasi);
  if(realisasi <= 25)
    if(na) return 'n/a';
    else return `<span class="label label-danger">${realisasi}%</span>`;
  else if (realisasi > 25 && realisasi <= 50)
    return `<span class="label label-warning">${realisasi}%</span>`;
  else if (realisasi > 50 && realisasi <= 75)
    return `<span class="label label-info">${realisasi}%</span>`;
  return `<span class="label label-success">${realisasi}%</span>`;
}


function colorBantuan(realisasi, na = false){
  // var realisasi = parseFloat(realisasi);
  if(realisasi == '0')
     return `<span class="label label-danger"> Belum Ada Bantuan </span>`;
  else if (realisasi == '1')
    return `<span class="label label-info"> Jenis Bantuan 1 (PKH dan BPNT) </span>`;
  else if (realisasi == '2')
    return `<span class="label label-info"> Jenis Bantuan 2 (BPNT) </span>`;
  else if (realisasi == '3')
    return `<span class="label label-info"> Jenis Bantuan 3 (Non PKH - Non BPNT) </span>`;
  return `<span class="label label-success">${realisasi}%</span>`;
}