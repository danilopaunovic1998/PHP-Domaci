
$(document).ready(function () {
    $('#addProduct').submit(function () {
        event.preventDefault();
        console.log("Dodaj");
        const $form = $(this);
        const $input = $form.find('input, select, button, textarea');

        const serijalizacija = $form.serialize();
        console.log(serijalizacija);
        $input.prop('disabled', true);

        req = $.ajax({
            url: 'handler/add.php',
            type: 'post',
            data: serijalizacija
        });

        req.done(function (res, textStatus, jqXHR) {
            if (res == "Success") {
                alert("Uspesno dodat proizvod");
                console.log("Dodat proizvod");
                window.location.replace("home.php");

            } else console.log("Proizvod nije dodat " + res);
            console.log(res);

        });

        req.fail(function (jqXHR, textStatus, errorThrown) {

            console.error("Greska je: " + textStatus, errorThrown);
        })
    });


    $('#pretraga').keyup(function () {
        var unos = $(this).val();
        $.ajax({
            url:'handler/search.php',
            method:'post',
            data:{param: unos},
            success: function(response){
                $("#table-data").html(response);
            }
        })
    });
    $("#sort").change(function(){
        var unos = $(this).val();
        $.ajax({
            url:'handler/sort.php',
            method:'post',
            data:{param: unos},
            success: function(response){
                $("#table-data").html(response);
            }
        })
    });
    $('#updateProduct').submit(function () {
        event.preventDefault();
        console.log("Izmeni");
        const $form = $(this);
        const $input = $form.find('input, select, button, textarea');
    
        const serijalizacija = $form.serialize();
        console.log(serijalizacija);
        $input.prop('disabled', true);
    
        request = $.ajax({
            url: 'handler/update.php',
            type: 'post',
            data: serijalizacija
        });
    
        request.done(function (response, textStatus, jqXHR) {
            if (response == "Success") {
                console.log("Izmenjeno");
                location.reload(true);
            }
            else console.log("Nije izmenjeno" + response);
            console.log(response);
        });
        request.fail(function (jqXHR, textStatus, errorThrown) {
            console.error('Problem je sledeci: ' + textStatus, errorThrown);
        });
    });
});

function popuniModal(id) {
    request = $.ajax({
        url: 'handler/get.php',
        type: 'post',
        data: { 'id': id },
        dataType: 'json'
    });

    request.done(function (response, textStatus, jqXHR) {
        console.log("popunjena");
        console.log(response);
        $('#title').val(response[0]['title']);
        console.log(response[0]['title']);

        $('#description').val(response[0]['description'].trim());
        console.log(response[0]['description'].trim());

        $('#price').val(response[0]['price'].trim());
        console.log(response[0]['price'].trim());

        $('#type').val(response[0]['typeid'].trim()).change();
        $('#productid').val(id);


    });

    request.fail(function (jqXHR, textStatus, errorThrown) {

        console.error("Greska je: " + textStatus, errorThrown);
    });
}

function deleteFunc(id) {

    req = $.ajax({
        url: 'handler/delete.php',
        type: 'post',
        data: { 'id': id }
    });

    req.done(function (res, textStatus, jqXHR) {
        if (res == "Success") {
            alert('Obrisan proizvod');
            console.log('Obrisan');
            location.reload(true);
        } else {
            console.log("Proizvod nije obrisan " + res);
            alert("Proizvod nije obrisan ");

        }
        console.log(res);
    });
}






