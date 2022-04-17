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
})