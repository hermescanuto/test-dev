$(document).ready(function() {


    function addrow(obj) {

        $('#listacarro').append(
            "<tr id='" + obj.id + "' >" +
            "<td class='id'>" + obj.id + "</td>" +
            "<td class='marca'>" + obj.marca + "</td>" +
            "<td class='modelo' >" + obj.modelo + "</td>" +
            "<td class='ano' >" + obj.ano + "</td>" +
            "<td>" + "<button id='alt' type='button' class='btn btn-default'><span class='glyphicon glyphicon-pencil'></span> Alterar</button>" + "</td>" +
            "<td class='pa' >" +
            "<button id='sim' type='button' class='btn btn-default'><span class='glyphicon glyphicon-remove'></span> Deletar</button>" +
            "<div class='delsn' style='display:none'><button id='del' type='button' class='btn btn-default'><span class='glyphicon glyphicon-remove'></span> SIM</button>" +
            "<button id='nao' type='button' class='btn btn-default'><span class='glyphicon glyphicon-remove'></span> Nâo</button></div>" +
            "</td>" +
            "<tr>"
        );

    }

    function altrow(obj) {

        html = $("#" + obj.id).html();
        $("#" + obj.id + " .marca").text(obj.marca);
        $("#" + obj.id + " .modelo").text(obj.modelo);
        $("#" + obj.id + " .ano").text(obj.ano);
        console.log(html)
    }

    $("#listacarro").on('click', '#alt', altclicked);
    $("#listacarro").on('click', '#del', delclicked);

    $("#listacarro").on('click', '#sim', simclicked);
    $("#listacarro").on('click', '#nao', naoclicked);

    function getCarro(html) {
        marca = $($.parseHTML(html)).filter('.marca').text();
        modelo = $($.parseHTML(html)).filter('.modelo').text();
        ano = $($.parseHTML(html)).filter('.ano').text();
        id = $($.parseHTML(html)).filter('.id').text();
        car = {
            marca: marca,
            modelo: modelo,
            ano: ano,
            id: id
        };
        return car;
    }

    function setCarro(obj) {
        //$("#marca").val(obj.marca);

        $('#marca option[value=' + obj.marca + ']').prop('selected', 'selected').change();

        $("#modelo").val(obj.modelo);
        $("#ano").val(obj.ano);
        $("#id").val(obj.id);
    }


    function altclicked(event) {
        html = $(this).closest("tr").html();
        carro = getCarro(html)
        setCarro(carro);
    }


    function simclicked(event) {

        $(this).next().show();
    }

    function naoclicked(event) {
        $(this).closest("div").hide();

    }

    function delclicked(event) {
        html = $(this).closest("tr").html();
        carro = getCarro(html);
        $(this).closest("tr").remove();

        $.ajax({
            type: "DELETE",
            url: "api/carro.php/" + carro.id,

            dataType: "json",

            success: function(msg) {
                console.log(msg);

            }
        });
    }

    function listacarros() {
        $.ajax({
            type: "GET",
            url: "api/carro.php",

            dataType: "json",

            success: function(msg) {
                console.log(msg);
                lista = msg.lista;
                console.log(lista);
                $.each(lista, function(bb) {

                    console.log(lista[bb]);
                    addrow(lista[bb]);

                });
            }
        });

    }

	function isNumeric(value) {
  		return !isNaN(value) && (function(x) { return (x | 0) === x; })(parseFloat(value))
	}

    $("#send").click(function() {

        metodo = "POST";
        entrypoint = "api/carro.php"

        marca = $("#marca").val();
        modelo = $("#modelo").val();
        ano = $("#ano").val();
        id = $("#id").val()        

        if (marca == '-1') {
            $('#marcaI').show();
            return false
        } else {
            $('#marcaI').hide();
        }

        if (modelo + "" == "") {
            $('#modeloI').show();
            return false
        } else {
            $('#modeloI').hide();
        }

        if ( isNumeric(ano) == false) {
            $('#anoI').show();
            return false
        } else {

			$('#anoI').hide();
        }


        over = null;

        dados = {
            marca: marca,
            modelo: modelo,
            ano: ano
        }
        if (id + "" != "") {
            entrypoint = entrypoint + "/" + id;
            metodo = "PUT";
        }

        $.ajax({
            type: metodo,
            url: entrypoint,
            data: dados,
            dataType: "json",

            success: function(msg) {
                console.log(msg.id)
                if (id + "" != "") {
                    altrow(msg);
                } else {
                    addrow(msg);
                }

            }
        });

        carro = {
            marca: -1,
            modelo: null,
            ano: null,
            id: null
        }
        setCarro(carro);
    })


    listacarros();


});