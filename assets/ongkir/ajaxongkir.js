    var ajaxku;

function toRp(angka){
    var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
    var rev2    = '';
    for(var i = 0; i < rev.length; i++){
        rev2  += rev[i];
        if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
            rev2 += '.';
        }
    }
    return 'Rp ' + rev2.split('').reverse().join('');
}

function ajaxkota(id){
    ajaxku = buatajax();
    var url="http://localhost/smartstore/assets/js/ongkir/data.php";
    url=url+"?p="+id;
    url=url+"&sid="+Math.random();
    ajaxku.onreadystatechange=stateChanged;
    ajaxku.open("GET",url,true);
    ajaxku.send(null);
}

function ajaxprice(id, br){
    ajaxku = buatajax();
    var url="http://localhost/smartstore/assets/js/ongkir/data.php";
    url=url+"?k="+id;
    url=url+"&b="+br;
    url=url+"&sid="+Math.random();
    ajaxku.onreadystatechange=stateChangedPrice;
    ajaxku.open("GET",url,true);
    ajaxku.send(null);
}

function ajaxongkir(id, tt){
    ajaxku = buatajax();
    var url="http://localhost/smartstore/assets/js/ongkir/data.php";
    url=url+"?n="+id;
    url=url+"&sid="+Math.random();
    ajaxku.onreadystatechange=stateChangedOngkir;
    ajaxku.open("GET",url,true);
    ajaxku.send(null);
}

/*------------------------*/
function ajaxkotadash(id){
    ajaxku = buatajax();
    var url="http://localhost/smartstore/assets/js/ongkir/data.php";
    url=url+"?pd="+id;
    url=url+"&sid="+Math.random();
    ajaxku.onreadystatechange=stateChangedDash;
    ajaxku.open("GET",url,true);
    ajaxku.send(null);
}


function buatajax(){
    if (window.XMLHttpRequest){
        return new XMLHttpRequest();
    }
    if (window.ActiveXObject){
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
    return null;
}

function stateChanged(){
    var data;
    if (ajaxku.readyState==4){
        data=ajaxku.responseText;
        if(data.length>=0){
            var subtotal = document.getElementById("txtSubTotal").value;

            document.getElementById("kota").innerHTML = data;
            document.getElementById("price").innerHTML = "<option selected>Pilih Harga</option>";
            document.getElementById("ongkir").innerHTML = "Rp 0";
            document.getElementById("total").innerHTML = toRp(subtotal);
        }else{
            document.getElementById("kota").value = "<option selected>Pilih Kota/Kab</option>";
        }
    }
}

function stateChangedPrice(){
    var data;
    if (ajaxku.readyState==4){
        data=ajaxku.responseText;
        if(data.length>=0){
            var subtotal = document.getElementById("txtSubTotal").value;

            document.getElementById("price").innerHTML = data;
            document.getElementById("ongkir").innerHTML = "Rp 0";
            document.getElementById("total").innerHTML = toRp(subtotal);
        }else{
            document.getElementById("price").value = "<option selected>Pilih Harga</option>";
        }
    }
}

function stateChangedOngkir(tt){
    var data;
    // var subtotal = tt;
    if (ajaxku.readyState==4) {
        data=ajaxku.responseText;
        if(data.length>=0){

            document.getElementById("ongkir").innerHTML = toRp(data);
            document.getElementById("txtOngkir").value = data;

            var subtotal = document.getElementById("txtSubTotal").value;
            var total = Number(subtotal) + Number(data);
            
            document.getElementById("total").innerHTML = toRp(total);
            document.getElementById("txtTotal").value = total;
        }else{
            document.getElementById("ongkir").innerHTML = "Rp 0";
        }
    };
}

function stateChangedTotal(){
    var data;
    if (ajaxku.readyState==4) {
        data=ajaxku.responseText;
        if(data.length>=0){
            document.getElementById("total").innerHTML = data;
            document.getElementById("txtTotal").value = data;
        }else{
            document.getElementById("total").innerHTML = "Rp 0";
        }
    };
}

/*-------------------------------*/
function stateChangedDash(){
    var data;
    if (ajaxku.readyState==4){
        data=ajaxku.responseText;
        if(data.length>=0){

            document.getElementById("kota").innerHTML = data;
        }else{
            document.getElementById("kota").value = "<option selected>Pilih Kota/Kab</option>";
        }
    }
}