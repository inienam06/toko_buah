function pesan(isLogin, data, auth)
{
    if(isLogin == 1)
    {
        startLoading();

        if(data.kilo < 1)
        {
            stopLoading();

            alert_custom('Peringatan !', 'Silahkan menambahkan total buah perkilo terlebih dahulu', 'error');
        }
        else
        {
            $.ajax({
                headers:{
                    apikey: getApiKey(),
                    Authorization: 'Bearer '+auth
                },
                method: 'POST',
                url: getUrlApi()+"pesanan/pesan",
                data: {
                    id_user: data.id_user,
                    id_produk: data.id_produk,
                    kilo: data.kilo,
                    total_harga: data.total_harga,
                    nama_user: data.nama
                }
            }).done(function(response) {
                console.log(response);

                if(response.code == 200) {
                    stopLoading();

                    alert_custom('Sukses', response.message, 'success');
                }
            });
        }
    }
    else
    {
        alert_custom('Peringatan !', 'Anda harus login terlebih dahulu', 'error');
    }
}