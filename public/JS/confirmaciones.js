$(function inicio() {

    $(document).on('click', ".fila", function() {
        //   var seleccion = $(this).find('th:nth-child(1)').html();
        var dato = $(this).find('input:nth-child(1)').val();
        var ver = $(this).find('input:nth-child(1)').is(":checked");
        if (ver == false) {
            $(this).find('input:nth-child(1)').prop("checked", true);
        } else {
            $(this).find('input:nth-child(1)').prop("checked", false);
        }
        console.log(dato);
    });
    
    $(document).on('click', '.registrar_Envio_Material', function() {
        const row = $(this).closest('tr');
        const Id_Utilerias_Sucursales = row.find('td:nth-child(1)').text().trim();
        const Id_Almacen = row.find('td:nth-child(2)').text().trim();
        const Cantidad_Pedido = row.find('td:nth-child(3)').text().trim();
        const Nombre_Materia = row.find('td:nth-child(4)').text().trim();
        const Estatus = row.find('td:nth-child(5)').text().trim();
        const Fecha_Solicitud = row.find('td:nth-child(6)').text().trim();
        const NombreSucursal = row.find('td:nth-child(7)').text().trim();
        const Nombre = row.find('td:nth-child(8)').text().trim();
         
       // const nota = row.find('input[name="comentarios"]').val().trim();
        const seleccionado = row.find('input[name="Confirmacion_Salida"]').is(':checked');
    
        const data = {
            Id_Utilerias_Sucursales,
            Id_Almacen,
            Cantidad_Pedido,
            Nombre_Materia,
            Estatus,
            Fecha_Solicitud,
            NombreSucursal,
            Nombre,
            seleccionado
        };
    
        console.log(data);
        // Aquí puedes enviar los datos con AJAX o procesarlos como prefieras
        // $.post('/ruta/destino', data, function(response) {
        //     console.log(response);
        // });
        alert(data);
    
        $.ajax({
            url: base_url + 'Registrar_Solicitud_Material',
            type: 'POST',
            data: data,
            success: function(respuesta) {
                alert("CAMPOS REGISTRADOS: " + respuesta);
            },
            error: function() {
                console.error("No se ha podido enviar la información");
            }
        });
    
    
    });


    $(document).on('click', '.Eliminar_Registro', function() {
        const row = $(this).closest('tr');
        const idCelda = row.find('td:nth-child(1)').text().trim();
        console.log(idCelda);
        alert("ID de la celda: " + idCelda);



        const data = { idCelda: parseInt(idCelda) };

        $.ajax({
            url: base_url + 'SeleccionarYEliminarPanadero',
            type: 'POST',
            data: data,
            success: function(respuesta) {
            alert("CAMPO Eliminado: " + respuesta);
            },
            error: function() {
            console.error("No se ha podido enviar la información");
            }
        });
    });





    
    
    
    
    
    });