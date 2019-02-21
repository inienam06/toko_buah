var base_url = 'http://localhost/project/lestari_buah/web/';
var base_url_api = base_url+'api/';
var base_url_dashboard = base_url+'dasboard/';

var apikey = '3NbeKqHdqRCsxL+i+HlsKA==:YWJkdWxyb2htYW4wMDAwMA==';

$(document).ready(function(){
    try {
        if (typeof $('.jam').timepicker === "function") { 
            $('.jam').timepicker({
                autoclose: true,
                todayHighlight: true,
            });
        }

        if (typeof $('.tanggal').datepicker === "function") { 
            $('.tanggal').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            });
        }

        if (typeof tinymce === "function") { 
            tinymce.init({
                selector: "textarea.editor",
                theme: "modern",
                height: 300,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker", "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking", "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
            });
        }

        if (typeof $('.tanggal').datepicker === "function") { 
            $('.tanggal').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            });
        }
        
        if(typeof $('.custom-select').select2 === "function")
        {
            $('.custom-select').select2();
        }

        if(typeof $('.money').number === "function")
        {
            $('.money').number(true, 2);
        }

        if(typeof $('.number').number === "function")
        {
            $('.number').number(true, 0);
        }

        if(typeof $('.dropify').dropify === "function")
        {
            $('.dropify').dropify();
        }    
    
        $('.cust-alert').delay(3000).slideUp(500);
    } catch (error) {
        console.log(error);
    }
});

function is_nohp(element)
{
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

function refresh_money(element)
{
    $(element).number(true, 2);
}

function refresh_number(element)
{
    $(element).number(true, 0);
}

function alert_custom(judul, pesan, tipe)
{
    swal(judul, pesan, tipe);
}

function alertToUrl(judul, pesan, tipe, url)
{
    swal({   
        title: judul,   
        text: pesan,   
        type: tipe,
        closeOnConfirm: false
    }, function(isConfirm){   
        if (isConfirm) {     
            document.location = url;
        }
    });
}

function confirm_custom(pesan, kode, data)
{
    swal({
        title: "Apa Anda Yakin ?",   
        text: pesan,   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "YA",   
        cancelButtonText: "TIDAK",   
        closeOnConfirm: true,   
        closeOnCancel: true
    }, function(isConfirm){   
        if (isConfirm) {     
            if(kode != null)
            {
                switch (kode)
                {
                    case 1:
                        antar_pesanan(data);
                        break;

                    case 2:
                        pesanan_telah_sampai(data);
                        break;
                
                    default:
                        alert_custom('Peringatan !', 'Aksi tidak diketahui', 'error');
                        break;
                }
            }
            else
            {
                alert_custom('Peringatan !', 'Aksi tidak diketahui', 'error');
            }
        } 
    });
}

function serverSideTable(element, url, json = [])
{
    $(element).DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url : url,
          dataType : 'json',
        },
        columns: json
    });
}

function getApiKey()
{
    return apikey;
}

function getUrlApi()
{
    return base_url_api;
}

function getUrlDashbord()
{
    return base_url_dashboard;
}

function getUrl()
{
    return base_url;
}