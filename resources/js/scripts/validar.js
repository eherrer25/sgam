$(document).ready(function() {

$(".justNumbers").keypress(function (e) {
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $(this).addClass('is-invalid');
        return false;
    }else{
        $(this).removeClass('is-invalid');
    }
});
$('#phone').keyup(function (e) {
    e.preventDefault();
    var phone = $(this).val();
    if(phone.length == 0){
        $(this).removeClass('is-invalid');
        return false;
    }
    if(phone.length <= 10){
        $(this).removeClass('is-invalid');
    }else{
        $(this).addClass('is-invalid');
        return false;
    }
});
$('#mobile').keyup(function (e) {
    e.preventDefault();
    var mobile = $(this).val();
    if(mobile.length == 0){
        $(this).removeClass('is-invalid');
        return false;
    }
    if(mobile.length <= 10){
        $(this).removeClass('is-invalid');
    }else{
        $(this).addClass('is-invalid');
        return false;
    }
});
$('#email').keyup(function () {
    var email = $(this).val();
    if(email.length == 0){
        $(this).removeClass('is-invalid');
        return false;
    }
    if(email.length > 0){
        if((/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email))){
            $(this).removeClass('is-invalid');
        }else{
            $(this).addClass('is-invalid');
            return false;
        }
    }
});
$('.run').keyup(function (e) {
    console.log('su');
    e.preventDefault();
    validarRun($(this));
});



function validarRun($run) {
    $run.val(formatearRut($run.val()));

    let flag = true;

    if($run.val().length < 6 || !rutEsValido($run.val()) ){

        flag = false;

        $run.addClass('is-invalid');
        $run.parent().find('.invalid-feedback').text('El run es requerido y debe ser válido.');
    }else{

        $run.removeClass('is-invalid');
        $run.parent().find('.invalid-feedback').text('');
    }

    return flag;
}

function formatearRut(rut) {

    rut.trim();
    rut = rut.replace(/\-/g, '');
    rut = rut.replace(/\./g, '');
    rut = rut.replace(/\,/g, '');
    rut = rut.replace(/ /g, '');

    if (rut.length > 1) {
        var ultimo = rut.slice(-1);
        var sinDigito = rut.substring(0, rut.length - 1);

        return sinDigito + '-' + ultimo;
    } else {
        return rut;
    }

}

function rutEsValido(rut) {
    if (!rut || rut.trim().length < 3) return false;
    const rutLimpio = rut.replace(/[^0-9kK-]/g, "");

    if (rutLimpio.length < 3) return false;

    const split = rutLimpio.split("-");
    if (split.length !== 2) return false;

    const num = parseInt(split[0], 10);
    const dgv = split[1];

    const dvCalc = calculateDV(num);
    return dvCalc === dgv;
}

function calculateDV(rut) {
    const cuerpo = `${rut}`;
    // Calcular Dígito Verificador
    let suma = 0;
    let multiplo = 2;

    // Para cada dígito del Cuerpo
    for (let i = 1; i <= cuerpo.length; i++) {
        // Obtener su Producto con el Múltiplo Correspondiente
        const index = multiplo * cuerpo.charAt(cuerpo.length - i);

        // Sumar al Contador General
        suma += index;

        // Consolidar Múltiplo dentro del rango [2,7]
        if (multiplo < 7) {
            multiplo += 1;
        } else {
            multiplo = 2;
        }
    }

    // Calcular Dígito Verificador en base al Módulo 11
    const dvEsperado = 11 - (suma % 11);
    if (dvEsperado === 10) return "k";
    if (dvEsperado === 11) return "0";
    return `${dvEsperado}`;
}
});
