$('#addProduct').submit(function(){
    event.preventDefault();
    console.log("Dodaj");
    const $form =$(this);
    const $input = $form.find('input, select, button, textarea');

    const serijalizacija = $form.serialize();
    console.log(serijalizacija);
    $input.prop('disabled', true);

    req = $.ajax({
        url: 'handler/add.php',
        type: 'post',
        data: serijalizacija
    });

    req.done(function(res, textStatus, jqXHR){
        if(res == "Success"){
            alert("Uspesno dodat proizvod");
            console.log("Dodat proizvod");
            window.location.replace("home.php");
            
        } else console.log("Proizvod nije dodat "+ res);
        console.log(res);

    });

    req.fail(function(jqXHR, textStatus, errorThrown){

        console.error("Greska je: " +textStatus, errorThrown);
    })
});

function deleteFunc(id) {
    console.log("OVDEEE SAM")
    console.log("Brisanje");

    req = $.ajax({
        url: 'handler/delete.php',
        type:'post',
        data: {'id':id}
    });

    req.done(function(res, textStatus, jqXHR){
        if(res=="Success"){
           alert('Obrisan kolokvijum');
           console.log('Obrisan');
           location.reload(true);
        }else {
        console.log("Kolokvijum nije obrisan "+res);
        alert("Kolokvijum nije obrisan ");

        }
        console.log(res);
    });
}