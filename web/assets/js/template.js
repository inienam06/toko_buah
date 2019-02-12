$(document).ready(function(){
    is_nohp('.is_nohp');
});

function regisLogin(obj) {
    var obj = $(obj);
    var tipe = obj.attr('data-tipe');

    switch (tipe) {
        case 'masuk':

        break;
        
        case 'daftar':
            daftar(obj.parent().parent().parent());
            break;
    
        default:
            break;
    }
}

function daftar(el) {
    var nama = el.find('input[name="nama"]').val().trim();
    var email = el.find('input[name="email"]').val().trim();
    var no_handphone = el.find('input[name="no_handphone"]').val().trim();
    var password = el.find('input[name="password"]').val().trim();

    if(nama == '')
    {
        alert_custom('Peringatan', 'Nama tidak boleh kosong !', 'error');
        return false;
    }

    if(email == '')
    {
        alert_custom('Peringatan', 'E-mail tidak boleh kosong !', 'error');
        return false;
    }

    if(no_handphone == '')
    {
        alert_custom('Peringatan', 'No. Handphone tidak boleh kosong !', 'error');
        return false;
    }

    if(password == '')
    {
        alert_custom('Peringatan', 'Password tidak boleh kosong !', 'error');
        return false;
    }

    $.ajax({
        headers:{
            apikey: apikey
        },
        method: 'POST',
        url: getUrlApi()+'user/daftar',
        data: {
            nama_lengkap: nama,
            email: email,
            no_handphone: no_handphone,
            password: password
        }
    }).done(function(response){
        console.log(response);

        if(response.code != 200) {
            alert_custom('Peringatan', response.message, 'error');
        } else {
            alert_custom('Sukses', response.message, 'success');
            parent.modal('hide');
            location.reload();
        }
    });
}

function is_nohp(element) {
    var el = $(element);

    if(!el.attr('onkeypress')) {
        el.attr('onkeypress', 'return event.charCode >= 48 && event.charCode <= 57');
    }

    el.keyup(function(){
        if(el.val().length >= 5) {
            if(el.val().substr(0, 2) != 62) {
                if(el.val().substr(0, 1) == 0) {
                    el.val('62'+el.val().substr(1));
                } else if(el.val().substr(0, 1) == 2 || el.val().substr(0, 1) == 8) {
                    el.val('62'+el.val());
                }
            }
        }
    });
}

$(window).load(function(){
    $.ajax({
        method: 'GET',
        url: getUrlApi()+'kategori',
        beforeSend: function(request){
            request.setRequestHeader('apikey', apikey);
        }
    }).done(function(response){
        var kategori = $('ul.uk-navbar-dropdown-nav');
        var dropdown = '';

        if(response.data == null)
        {
            dropdown += '<li><a href="javascript:void(0)">Tidak ada kategori !</a></li>';
        }
        else
        {
            $.each(response.data, function(i, data){
                dropdown += '<li><a href="'+base_url+'kategori/'+data.slug+'">'+data.nama_kategori+'</a></li>';
            });
        }
        kategori.html(dropdown);

        $('#preloader').fadeOut('slow',function(){
            $(this).hide();
        });
    });
});

function startLoading()
{
    $('#preloader').fadeIn('slow',function(){
        $(this).show();
    });
}

function stopLoading()
{
    $('#preloader').fadeOut('slow',function(){
        $(this).hide();
    });
}