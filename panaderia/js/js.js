// Inicio de la página con el DOM cargado
$(function () {

    //|------------------------------------------------------------------------------------------------|
    //|                                          FUNCIONALIDAD                                         |
    //|------------------------------------------------------------------------------------------------|

    //|--------------------------------------------------|
    //|                      Login                       |
    //|--------------------------------------------------|


    $('#formLogin').submit(function (e) {
        $('#btnValidar').val("V A L I D A N D O  .  .  .");
        //Que no recarge la página sola
        e.preventDefault();
        var datosLogin = {
            //variable que va al back end ':' valor que cojo de su formulario por las id's
            nombreUsuario: $('#nombreInicio').val(),
            passUsuario: $('#passInicio').val()
        };

        $.post('../funcionalidad/loginUsuario.php', datosLogin, respuestaBackEnd => {
            console.log(respuestaBackEnd)
            // Salida por pantalla de que no hay coincidencia
            $('.error').html(respuestaBackEnd);
            // El botón Vuelve al valor inicial de entrar si no entra al sistema
            $('#btnValidar').val("Entrar");
            // Formateo de los inputs
            $('#formLogin').trigger('reset');
            const usuario = JSON.parse(respuestaBackEnd);
            console.log(respuestaBackEnd)
            // Saco el valor del tipo y según convenga lo redirijo donde quiera
            $tipo = usuario[0]['tipo'];
            if ($tipo == 'Jefe') {
                //Salida por pantalla de bienvenida al entrar al sistema
                $('.error').html("B I E N V E N I D O");
                // Redirección de entrada del jefe
                location.href = "index.php";
            } else if ($tipo == 'Trabajador') {
                // Redirección de entrada del Trabajador
                $('.error').html("B I E N V E N I D O");
                location.href = "panaderia.php";
            }
        });
    });


    //|--------------------------------------------------|
    //|              Funciones de inicio                 |
    //|--------------------------------------------------|


    // Opcion a rellenar el ticket
    lineaNueva();
    //Contador de los productos del ticket: que se vea el cero 
    sumarProductos();

    //|--------------------------------------------------|
    //|            Visibilidad de secciones              |
    //|--------------------------------------------------|

    //Mantengo TODAS las salidas ocultas de los div del index hasta que pulse el botón apropiado

    $('.salidaAdministrar').hide();
    $('.salidaOpciones').hide();
    $('.salidaTodoUsuarios').hide();
    $('.salidaListaStock').hide();
    $('.salidaListaProveedor').hide();
    $('.salidaListaEmpresa').hide();
    $('.salidaListaPedidos').hide();
    $('.salidaListaClientes').hide();
    $('.salidaListaResumen').hide();
    $('.psc').hide();
    $('#idModificarUsuario').hide();
    $('#idModiStock').hide();
    $('#idModiProveedor').hide();
    $('#idModiCliente').hide();
    $('#idModiEmpresa').hide();
    $('#crearCliente').hide();
    $('#crearPedido').hide();
    //Reseteo del formulario del usuarios
    $('#usuario').click(function () {
        $('#idCrearUsuario').trigger('reset');
    });
    //Reseteo del formulario del stock
    $('#stock').click(function () {
        $('#idCrearStock').trigger('reset');
    });
    //Reseteo del formulario del productos
    $('#proveedor').click(function () {
        $('#idCrearProveedor').trigger('reset');
    });
    // Dentro del modal de busqueda, al cerrarlo con el botón borrará el texto que haya escrito en el buscador
    $('.bsqdReset').click(function () {
        $('#buscar').val('');
    });
    //Al pinchar el btn administrador, se despliegan las opciones de usuario, stock y proveedor, ocultando el resto
    $('#opcionesAdministracion').click(function () {
        $('.salidaAdministrar').show();
        $('.salidaOpciones').hide();
        $('#carrusel').hide();
        $('.psc').hide();
        $('footer').hide();
    });
    //Volver al índex de la página en el menu de administrador
    $('#cerrarAdministrador').click(function () {
        $('.salidaAdministrar').hide();
        $('#carrusel').show();
        $('footer').show();
    });
    //Volver al índex de la página en el menu de administrador
    $('#cerrarAdministrador2').click(function () {
        $('.salidaOpciones').hide();
        $('footer').show();
        $('#carrusel').show();
    });
    //Una vez abierto el menu de las opciones, que se pueda volver atrás
    $('#opcionesOp').click(function () {
        $('.salidaOpciones').show();
        $('.salidaAdministrar').hide();
        $('.psc').hide();
        $('footer').hide();
        $('#carrusel').hide();
    });
    //Desplegado el modal de usuarios podremos acceder a todos los usuarios que haya en el sistema por la salida por pantalla
    $('#btnListaUsuario').click(function () {
        $('.salidaTodoUsuarios').show();
        //Llamamos a la función para que se abra la lista
        mostrarTrabajadores();
        $('.salidaAdministrar').hide();
        //Ocultamos la section, es decir. Ocultamos todo lo que se ve en el index para dejar paso SÓLO a los listados
        $('section').hide();
        $('footer').hide();
        $('#carrusel').hide();
    });
    //Desplegado el modal de productos podremos acceder al stock que haya en el sistema por la salida por pantalla 
    $('#btnListaStock').click(function () {
        $('.salidaListaStock').show();
        mostrarStock();
        $('.salidaAdministrar').hide();
        $('section').hide();
        $('footer').hide();
        $('#carrusel').hide();
    });
    //Desplegado el modal de proveedores podremos acceder al la lista de proveedores que haya en el sistema
    $('#btnListaProveedor').click(function () {
        $('.salidaListaProveedor').show();
        mostrarProveedores();
        $('.salidaAdministrar').hide();
        $('section').hide();
        $('footer').hide();
        $('#carrusel').hide();
    });
    //Desplegado el modal del domicilio podremos acceder al la lista de clientes que haya en el sistema
    $('#btnListaClientes').click(function () {
        $('.salidaListaClientes').show();
        mostrarClientes();
        $('.salidaAdministrar').hide();
        $('section').hide();
        $('.psc').hide();
        $('footer').hide();
        $('#carrusel').hide();
    });
    //Desplegado el modal de Empresas de Transporte podremos acceder al la lista de Empresas que haya en el sistema
    $('#btnListaTransporte').click(function () {
        $('.salidaListaEmpresa').show();
        mostrarEmpresa();
        $('.salidaAdministrar').hide();
        $('section').hide();
        $('footer').hide();
        $('#carrusel').hide();
    });
    // Mostrar el listado del resumen diario
    $('#resumen').click(function () {
        mostrarResumenDiario();
        mostrarTotal();
        $('.salidaListaResumen').show();
        $('.salidaOpciones').hide();
        $('section').hide();
        $('#carrusel').hide();
    });
    //Dentro de la lista de usuarios, al pulsar ese botón, volverá a la gestion de la empresa ocultando el resto de salidas
    $('#cerrarListaUsuarios').click(function () {
        $('.salidaAdministrar').show();
        $('section').show();
        $('.salidaListaProveedor').hide();
        $('.salidaListaStock').hide();
        $('.salidaTodoUsuarios').hide();
        $('footer').hide();
        $('#carrusel').hide();
    });
    //Lo mismo que el de arriba, pero al pie de la tabla
    $('#cerrarListaUsuarios2').click(function () {
        $('.salidaAdministrar').show();
        $('section').show();
        $('.salidaListaProveedor').hide();
        $('.salidaListaStock').hide();
        $('.salidaTodoUsuarios').hide();
        $('.salidaListaEmpresa').hide();
        $('footer').hide();
        $('#carrusel').hide();
    });
    //Dentro de la lista de productos, al pulsar ese botón, volverá a la gestion de la empresa ocultando el resto de salidas
    $('#cerrarListaStock').click(function () {
        $('.salidaAdministrar').show();
        $('section').show();
        $('.salidaListaStock').hide();
        $('.salidaListaProveedor').hide();
        $('.salidaTodoUsuarios').hide();
        $('footer').hide();
        $('#carrusel').hide();
    });
    //Lo mismo que el de arriba, pero al pie de la tabla
    $('#cerrarListaStock2').click(function () {
        $('.salidaAdministrar').show();
        $('section').show();
        $('.salidaListaStock').hide();
        $('.salidaListaProveedor').hide();
        $('.salidaTodoUsuarios').hide();
        $('.salidaListaEmpresa').hide();
        $('footer').hide();
        $('#carrusel').hide();
    });
    //Dentro de la lista de proveedores, al pulsar ese botón, volverá a la gestion de la empresa ocultando el resto de salidas
    $('#cerrarListaProveedor').click(function () {
        $('.salidaAdministrar').show();
        $('section').show();
        $('.salidaListaStock').hide();
        $('.salidaListaProveedor').hide();
        $('.salidaTodoUsuarios').hide();
        $('.salidaListaEmpresa').hide();
        $('footer').hide();
        $('#carrusel').hide();
    });
    //Lo mismo que el de arriba, pero al pie de la tabla
    $('#cerrarListaProveedor2').click(function () {
        $('.salidaAdministrar').show();
        $('section').show();
        $('.salidaListaStock').hide();
        $('.salidaListaProveedor').hide();
        $('.salidaTodoUsuarios').hide();
        $('.salidaListaEmpresa').hide();
        $('footer').hide();
        $('#carrusel').hide();
    });
    //Dentro de la lista de Empresa, al pulsar ese botón, volverá a la gestion de la empresa ocultando el resto de salidas
    $('#cerrarListaEmpresa').click(function () {
        $('.salidaAdministrar').show();
        $('section').show();
        $('.salidaListaStock').hide();
        $('.salidaListaProveedor').hide();
        $('.salidaTodoUsuarios').hide();
        $('.salidaListaEmpresa').hide();
        $('footer').hide();
        $('#carrusel').hide();
    });
    //Lo mismo que el de arriba, pero al pie de la tabla
    $('#cerrarListaEmpresa2').click(function () {
        $('.salidaAdministrar').show();
        $('section').show();
        $('.salidaListaStock').hide();
        $('.salidaListaProveedor').hide();
        $('.salidaTodoUsuarios').hide();
        $('.salidaListaEmpresa').hide();
        $('footer').hide();
        $('#carrusel').hide();
    });
    // Cerrar el modal del domicilio
    $('#cierraDomi').click(function () {
        $('footer').show();
        $('#carrusel').show();
    });
    //Dentro de la lista de Clientes, al pulsar ese botón, volverá a la gestion de la empresa ocultando el resto de salidas
    $('#cerrarClientePedido').click(function () {
        $('section').show();
        $('#mdlDomicilio').modal('show');
        $('.salidaListaStock').hide();
        $('.salidaListaProveedor').hide();
        $('.salidaTodoUsuarios').hide();
        $('.salidaListaEmpresa').hide();
        $('.salidaListaClientes').hide();
        $('footer').show();
        $('#carrusel').show();
    });
    //Lo mismo que el de arriba, pero al pie de la tabla
    $('#cerrarClientePedido2').click(function () {
        $('#mdlDomicilio').modal('show');
        $('section').show();
        $('.salidaListaStock').hide();
        $('.salidaListaProveedor').hide();
        $('.salidaTodoUsuarios').hide();
        $('.salidaListaEmpresa').hide();
        $('.salidaListaClientes').hide();
        $('footer').show();
        $('#carrusel').show();

    });
    // Cerrar el historial de pedidos
    $('#cerrarListaPedido').click(function () {
        $('.salidaAdministrar').hide();
        $('section').show();
        $('#mdlDomicilio').modal('show');
        $('.salidaListaStock').hide();
        $('.salidaListaProveedor').hide();
        $('.salidaTodoUsuarios').hide();
        $('.salidaListaEmpresa').hide();
        $('.salidaListaPedidos').hide();
        $('footer').show();
        $('#carrusel').show();
    });
    //Lo mismo que el de arriba, pero al pie de la tabla
    $('#cerrarListaPedido2').click(function () {
        $('.salidaAdministrar').hide();
        $('section').show();
        $('#mdlDomicilio').modal('show');
        $('.salidaListaStock').hide();
        $('.salidaListaProveedor').hide();
        $('.salidaTodoUsuarios').hide();
        $('.salidaListaEmpresa').hide();
        $('.salidaListaPedidos').hide();
        $('footer').show();
        $('#carrusel').show();
    });
    // Cerrar la lista del resumen diario de ventas
    $('#cerrarListaResumen').click(function () {
        $('.salidaOpciones').show();
        $('section').show();
        $('.salidaListaStock').hide();
        $('.salidaListaProveedor').hide();
        $('.salidaTodoUsuarios').hide();
        $('.salidaListaEmpresa').hide();
        $('.salidaListaResumen').hide();
        $('footer').hide();
        $('#carrusel').hide();
    });
    //Lo mismo que el de arriba, pero al pie de la tabla
    $('#cerrarListaResumen2').click(function () {
        $('.salidaOpciones').show();
        $('section').show();
        $('.salidaListaStock').hide();
        $('.salidaListaProveedor').hide();
        $('.salidaTodoUsuarios').hide();
        $('.salidaListaEmpresa').hide();
        $('.salidaListaResumen').hide();
        $('footer').hide();
        $('#carrusel').hide();
    });
    // Desplegar el historial de pedidos
    $('#btnListaPedidos').click(function () {
        mostrarHistorialPedido();
        $('.salidaListaPedidos').show();
        $('.salidaAdministrar').hide();
        $('section').hide();
        $('.psc').hide();
        $('footer').hide();
        $('#carrusel').hide();
    });
    // Cancelar actualización, ver listado trabajadores
    $('.atrasTraba').click(function () {
        $('.salidaTodoUsuarios').show();
        $('#idModificarUsuario').hide();
        $('footer').hide();
        $('#carrusel').hide();
    });
    // Cancelar actualización, ver listado Productos
    $('#atraStock').click(function () {
        $('.salidaListaStock').show();
        $('#idModiStock').hide();
        $('footer').hide();
        $('#carrusel').hide();
    });
    // Salgan los proveedores para seleccionarlos en el ingreso de stock
    $('#stock').click(function () {
        // Para evitar repeticiones le pongo el empty al select
        $('#pro').empty();
        // Mostrar las empresas del select de los productos
        mostrarProve();
    });
    // Cancelar actualización, ver listado Empresa
    $('.atrasEmpresa').click(function () {
        $('.salidaListaEmpresa').show();
        $('#idModiEmpresa').hide();
        $('footer').hide();
        $('#carrusel').hide();
    });
    // Cancelar actualización, ver listado Proveedores
    $('.atrasProveedor').click(function () {
        $('.salidaListaProveedor').show();
        $('#idModiProveedor').hide();
        $('footer').hide();
        $('#carrusel').hide();
    });
    //Desplegará/plegar la opción del formulario clientes
    $('#btnClienteNuevo').click(function () {
        $('#crearCliente').trigger('reset');
        $('#crearCliente').show();
    });
    //Contraer el formulario del cliente
    $('#cerrarClienteNuevo').click(function () {
        $('#crearCliente').hide();
    });
    //Contraer el formulario del cliente
    $('#cerrarClienteNuevoM').click(function () {
        $('#idModiCliente').hide();
        $('.salidaListaClientes').show();
        $('footer').hide();
        $('#carrusel').hide();
    });
    //Modal del domicilio, si sales de él todo se contraerá con cerrar
    $('#cerrarPedido').click(function () {
        $('#crearPedido').trigger('reset');
        $('#direccionPedido').val("");
        $('#telBusCliente').val("");
        $('#crearPedido').hide();
        $('#crearCliente').hide();
        $('footer').hide();
        $('#carrusel').hide();
    });
    //Mostrar/Ocultar los artículos sin código
    $('#pscb').click(function () {
        // Los productos visibles
        productosSinCodigoDeBarras();
        $('.salidaAdministrar').hide();
        $('.psc').show();
        $('.salidaOpciones').hide();
        $('footer').hide();
        $('#carrusel').hide();
    });
    //Desplegable de la empresa de transporte
    $('#transporte').click(function () {
        $('#idCrearEmpresa').trigger('reset');
        $('#empTrans').empty();
        mostrarProve();
    });
    // Ocultar todo lo desplegado al pulsar el botón del domicilio
    $('#opcionesDomicilio').click(function () {
        $('.salidaAdministrar').hide();
        $('.salidaOpciones').hide();
        $('.psc').hide();
        $('#crearPedido').hide();
        $('#crearCliente').hide();
        $('footer').show();
        $('#carrusel').show();
    });
    // Ocultar los productos sin código de barras
    $('#ocultarPsc').click(function () {
        $('.psc').hide();
        $('footer').show();
        $('#carrusel').show();
    });


    //|--------------------------------------------------|
    //|    Añadir a la base de datos los trabajadores    |
    //|--------------------------------------------------|

    $('#idCrearUsuario').submit(function (e) {
        //Que no recarge la página sola
        e.preventDefault();
        // En caso de haber sacado información de contraseña errónea que se borre si ha ingresado bien la contraseña
        $('#contenedorUsuarios').html('');
        // Le marcamos un patrón a la contraseña, carácteres alfanúmericos con la ñ includio entre 1 y 20 carácteres
        var patron = /(?=^[\wñ]{1,20}$)/;
        // Obtengo el valor del campo de la contraseña
        var contrasena = $('#passUsuario').val();
        console.log(contrasena)
        // Y la paso por match, para comprobar si cumple el patrón
        if (contrasena.match(patron)) {
            // Limpio la clase que pueda traer (por si a fallao en el primer intento)
            $('#passUsuario').addClass("");
            //Preparamos y enviamos los datos que recojo del html al back-end si el patrón es válido
            var datosUsuario = {
                //variable que va al back end ':' valor que cojo de su formulario por las id's
                nombreUsuario: $('#nombreUsuario').val(),
                passUsuario: $('#passUsuario').val(),
                tipUsuario: $('#tipUsuario').val(),
                alias: $('#aliasUsuario').val()
            };
            $.post('../funcionalidad/crearUsuarios.php', datosUsuario, (respuestaBackEnd) => {
                console.log(respuestaBackEnd)
                //el trigger reset, es para que se borren los datos del formulario una vez enviado
                $('#idCrearUsuario').trigger('reset');
                //Quiero que los valores devueltos aparezcan en este modal del formulario
                $('#modalInfo').modal('show');
                // Y que aparezca en el input que hay, el mensaje del back-end
                $('#infoModal').val(respuestaBackEnd);
            });
        } else {
            // En caso de no cumplir el patrón:
            // Pondra el foco en el campo de la contraseña
            $('#passUsuario').focus();
            // Se le asignara la clase error
            $('#passUsuario').addClass("error");
            // Limpio la contraseña que había puesta
            $('#passUsuario').val("");
            // Y le saco por pantalla que patrón quiere
            $('#contenedorUsuarios').html("La contraseña admite:<br><ul><li>Carácteres alfabéticos</li><li>Carácteres númericos</li><li>Guión bajo: _</li><li>Entre 1 y 20 carácteres</li></ul>");
        }
    });


    //|--------------------------------------------------|
    //|    Añadir a la base de datos los productos       |
    //|--------------------------------------------------|

    $('#idCrearStock').submit(function (e) {
        e.preventDefault();
        //Vamos a crear la foreign, le enviamos el codigo del proveedor ya creado cogido del select
        if ($("#pro option:selected").val() == -1) {
            $('#modalInfo').modal('show');
            $('#infoModal').val("Seleccione compañía");
        } else {
            var datosStock = {
                codProveedor: $("#pro option:selected").val(),
                cBarras: $('#cBarras').val(),
                nomProducto: $('#nomProducto').val(),
                nProductos: $('#nProductos').val(),
                precio: $('#precio').val(),
                precioVenta: $('#precioVenta').val(),
                visibilidad: $('#tipProducto').val()
            };
            console.log(datosStock)
            $.post('../funcionalidad/crearStock.php', datosStock, (respuestaBackEnd) => {
                console.log(respuestaBackEnd)
                $('#idCrearStock').trigger('reset');
                $('#modalInfo').modal('show');
                $('#infoModal').val(respuestaBackEnd);
                // Que se actualice al momento los productos que tengan un sí en su visibilidad
                productosSinCodigoDeBarras();
            });
        }
    });

    //|--------------------------------------------------|
    //|    Añadir a la base de datos los Proveedores     |
    //|--------------------------------------------------|

    $('#idCrearProveedor').submit(function (e) {
        e.preventDefault();
        // El telefono deber constar de 9 dítos y empezará por 6,7 (móvil) y 9 (fijo)
        var patron = /^(6|7|9)[0-9]{8}$/;
        var telefono = $('#telProveedor').val();
        console.log(telefono)
        if (telefono.match(patron)) {
            $('#telProveedor').addClass("acierto2");
            var datosProveedor = {
                nombre: $('#nombreProveedor').val(),
                telefono: $('#telProveedor').val(),
                direccion: $('#direccion').val()
            };
            $.post('../funcionalidad/crearProveedor.php', datosProveedor, respuestaBackEnd => {
                console.log(respuestaBackEnd)
                $('#idCrearProveedor').trigger('reset');
                $('#modalInfo').modal('show');
                $('#infoModal').val(respuestaBackEnd);
            });
        } else {
            $('#telProveedor').focus();
            $('#telProveedor').addClass("error");
            $('#modalInfo').modal('show');
            $('#infoModal').val("Teléfono no válido");
        }
    });


    //|--------------------------------------------------|
    //|       Añadir a la base de datos Clientes        |
    //|--------------------------------------------------|

    $('#crearCliente').submit(function (e) {
        e.preventDefault();
        var patron = /^(6|7|9)[0-9]{8}$/;
        var telefono = $('#telCliente').val();
        if (telefono.match(patron)) {
            $('#telCliente').addClass("acierto2");
            var datosCliente = {
                nombre: $('#nombreCliente').val(),
                telefono: $('#telCliente').val(),
                direccion: $('#direccionCliente').val()
            };
            $.post('../funcionalidad/crearCliente.php', datosCliente, respuestaBackEnd => {
                console.log(respuestaBackEnd);
                $('#modalInfo').modal('show');
                $('#infoModal').val(respuestaBackEnd);
                $('#crearCliente').trigger('reset');
                mostrarEmpresa();
            });
        } else {
            $('#telCliente').focus();
            $('#telCliente').addClass("error");
            $('#modalInfo').modal('show');
            $('#infoModal').val("Teléfono no válido");
            if ($('#infoModal').val() == "Teléfono no válido") {
                $('#crearCliente').show();
            } else {
                $('#crearCliente').hide();
            }
        }
    });

    //|--------------------------------------------------|
    //|   Añadir a la base de datos Empresa Transporte  |
    //|--------------------------------------------------|

    $('#idCrearEmpresa').submit(function (e) {
        e.preventDefault();
        var patron = /^(6|7|9)[0-9]{8}$/;
        var telefono = $('#telEmpresa').val();
        if (telefono.match(patron)) {
            $('#telEmpresa').addClass("acierto2");
            var datosEmpresa = {
                nombre: $('#nombreEmpresa').val(),
                telefono: $('#telEmpresa').val(),
                comision: $('#comisionEmp').val()
            };
            $.post('../funcionalidad/crearEmpresa.php', datosEmpresa, respuestaBackEnd => {
                console.log(respuestaBackEnd);
                $('#idCrearEmpresa').trigger('reset');
                $('#modalInfo').modal('show');
                $('#infoModal').val(respuestaBackEnd);
            });
        } else {
            $('#telEmpresa').focus();
            $('#telEmpresa').addClass("error");
            $('#modalInfo').modal('show');
            $('#infoModal').val("Teléfono no válido");
        }
    });


    //|--------------------------------------------------|
    //|             Consulta productos-precio            |
    //|--------------------------------------------------|

    // keyup es una funcion que recogerá lo que metas por teclado
    $('#buscar').keyup(function () {
        // Comprobamos obligatoriamente que haya algo escrito para que realice la busque solo cuando se escriba en su input
        if ($('#buscar').val()) {
            var listaBuscar = { buscar: $('#buscar').val() }
            $.post('../funcionalidad/buscar.php', listaBuscar, respuestaBackEnd => {
                console.log(respuestaBackEnd)
                // Combertimos el JSON que viene del back end en string
                var productos = JSON.parse(respuestaBackEnd);
                // Los resultados devueltos serán impresos por pantalla con la siguiente plantilla
                var plantilla = '';
                // Recorrera el array productos los datos devueltos del json
                productos.forEach(producto => {
                    plantilla += `
                    ${producto.nombre}${"  ->  "}${producto.precio}${" €"}${"<br>"}`
                });
                if (respuestaBackEnd != "[]") {
                    $('#salidaBusqueda').modal("show");
                    $('.infoMdl').html(plantilla);
                }
            });
        };
    });


    //|--------------------------------------------------|
    //|             Lista de los trabajadores            |
    //|--------------------------------------------------|
    //Será lo que se vea al pulsar el botón "Mostrar Trabajadores"
    function mostrarTrabajadores() {
        // Los listado al no necesitar envío de datos, le enviamos al back-end la ubicación que tiene que buscar y la variable devuelta
        $.get('../funcionalidad/listaTrabajadores.php', respuestaBackEnd => {
            var trabajadores = JSON.parse(respuestaBackEnd);
            console.log(trabajadores);
            var plantilla = "";
            trabajadores.forEach(trabajador => {
                plantilla +=
                    //Ponemos en el tr el código porque es el que declara la fila, con ello conseguiremos borrar y modificar
                    //la fila, ergo el trabajador
                    `<tr trabajadorId="${trabajador.cod}" class="text-center">
                  <td>${trabajador.nombre}</td>
                  <td>* * * * *</td>
                  <td>${trabajador.tipo}</td>
                  <td>${trabajador.alias}</td>
                  <td><button class="modificarTrabajador btn btn-warning">Editar</button>
                  <button class="eliminarTrabajador btn btn-danger">Borrar</button></td>
                  </tr>`
            });
            $('#salidaUsuarios').html(plantilla);
        });
    };


    //|--------------------------------------------------|
    //|                 Lista del Stock                  |
    //|--------------------------------------------------|
    //Será lo que se vea al pulsar el botón "Mostrar Stock"
    function mostrarStock() {
        $.get('../funcionalidad/listaStock.php', respuestaBackEnd => {
            console.log(respuestaBackEnd)
            var productos = JSON.parse(respuestaBackEnd);
            console.log(productos)
            var plantilla = "";
            productos.forEach(producto => {
                plantilla +=
                    `<tr productoId="${producto.cod}" class="text-center">
                        <td>${producto.cod}</td>
                        <td>${producto.nombre}</td>
                        <td>${producto.cantidad}</td>
                        <td>${producto.precio}</td>
                        <td>${producto.pventa}</td>
                        <td>${producto.visibilidad}</td>
                        <td><button class="modificarProducto btn btn-warning">Editar</button>
                        <button class="eliminarProducto btn btn-danger">Borrar</button></td>
                    </tr>`
            });
            $('#salidaStock').html(plantilla);
        });
    };


    //|--------------------------------------------------|
    //|             Lista de los Proveedores             |
    //|------- ------------------------------------------|

    function mostrarProveedores() {
        $.get('../funcionalidad/listaProveedor.php', respuestaBackEnd => {
            var proveedores = JSON.parse(respuestaBackEnd);
            console.log(proveedores);
            var plantilla = "";
            proveedores.forEach(proveedor => {
                plantilla +=
                    `<tr proveedorId="${proveedor.cod}" class="text-center">
                  <td>${proveedor.compania}</td>
                  <td>${proveedor.telefono}</td>
                  <td>${proveedor.direccion}</td>
                  <td><button class="modificarProveedor btn btn-warning">Editar</button>
                  <button class="eliminarProveedor btn btn-danger">Borrar</button></td>
                  </tr>`
            });
            $('#salidaProveedor').html(plantilla);
        });
    };


    //|--------------------------------------------------|
    //|             Lista de los Pedidos                 |
    //|------- ------------------------------------------|
    function mostrarHistorialPedido() {
        $.post('../funcionalidad/listaHistorialPedidos.php', respuestaBackEnd => {
            console.log(respuestaBackEnd)
            var pedidos = JSON.parse(respuestaBackEnd);
            var plantilla = "";
            pedidos.forEach(pedido => {
                plantilla +=
                    `
                <tr class="text-center">
                    <td>${pedido.trabajador}</td>
                    <td>${pedido.empresa}</td>
                    <td>${pedido.telefono}</td>
                    <td>${pedido.direccion}</td>
                    <td>${pedido.comision}</td>
                </tr>
                `
            });
            $('#salidaPedidos').html(plantilla);
        });
    }


    //|--------------------------------------------------|
    //|             Lista de los Clientes                |
    //|------- ------------------------------------------|
    function mostrarClientes() {
        $.post('../funcionalidad/listaClientes.php', respuestaBackEnd => {
            var clientes = JSON.parse(respuestaBackEnd);
            var plantilla = "";
            clientes.forEach(cliente => {
                plantilla +=
                    `
                    <tr clienteId=${cliente.cod} class="text-center">
                        <td>${cliente.nombre}</td>
                        <td>${cliente.telefono}</td>
                        <td>${cliente.direccion}</td>
                        <td><button class="modificarCliente btn btn-warning">Editar</button>
                        <button class="eliminarCliente btn btn-danger">Borrar</button></td>
                    </tr>
                `
            });
            $('#salidaClientes').html(plantilla)
        });
    }


    //|--------------------------------------------------|
    //|         Lista de las Empresa Transporte          |
    //|--------------------------------------------------|

    function mostrarEmpresa() {
        $.get('../funcionalidad/listaEmpresa.php', respuestaBackEnd => {
            var empresas = JSON.parse(respuestaBackEnd);
            console.log(empresas);
            var plantilla = "";
            empresas.forEach(empresa => {
                plantilla +=
                    `<tr empresaId="${empresa.cod}" class="text-center">
                  <td>${empresa.nombre}</td>
                  <td>${empresa.telefono}</td>
                  <td>${empresa.comision}</td>
                  <td><button class="modificarEmpresa btn btn-warning">Editar</button>
                  <button class="eliminarEmpresa btn btn-danger">Borrar</button></td>
                  </tr>`
            });
            $('#salidaEmpresa').html(plantilla);
        });
    };


    //|--------------------------------------------------|
    //|               Eliminar Trabajadores              |
    //|--------------------------------------------------|
    //Lo que estamos haciendo, es seleccionar en cualquier parte del documento un click porque se llama de manera dinámica y no desde el html
    //Luego con el THIS le diremos exactamente cual es el botón que se esta clickeando
    //Llamamos a la clase eliminar, puesta en la tabla dinámica
    $(document).on('click', '.eliminarTrabajador', (e) => {
        //Lógico, preguntar si queremos elimar lo primero al hacer click
        if (confirm('¿Elimiar Trabajador?')) {
            //Escalamos por los td, hasta llegar al padre y borrar el tr entero -> botón(hijo) -> contenido -> tr(padre)
            var elementoABorrar = $(this)[0].activeElement.parentElement.parentElement;
            console.log(elementoABorrar)
            //Conseguimos el código del dato, por ello al tr le pusimos un id en la manera dinámica
            //Utilizamos el getAttribute para controlarlo de forma dinámica y no el getElementbyId
            var cod = elementoABorrar.getAttribute('trabajadorId');
            console.log(cod)
            $.post('../funcionalidad/borrarTrabajador.php', { cod }, respuestaBackEnd => {
                console.log(respuestaBackEnd)
                //Salida por pantalla del dato eliminado
                $('#modalInfo').modal('show');
                $('#infoModal').val(respuestaBackEnd);
                //Llamo a la función de la lista de los trabajadores, para que una vez eliminado el tr, la lista siga apareciendo
                mostrarTrabajadores();
            });
        };
    });


    //|--------------------------------------------------|
    //|                Eliminar Productos                |
    //|--------------------------------------------------|

    $(document).on('click', '.eliminarProducto', e => {
        if (confirm("¿Eliminar Producto?")) {
            var elementoABorrar = $(this)[0].activeElement.parentElement.parentElement;
            var cod = elementoABorrar.getAttribute('productoId');
            $.post('../funcionalidad/borrarProducto.php', { cod }, respuestaBackEnd => {
                $('#modalInfo').modal('show');
                $('#infoModal').val(respuestaBackEnd);
                mostrarStock();
            });
        };
    });


    //|--------------------------------------------------|
    //|                Eliminar Proveedor                |
    //|--------------------------------------------------|

    $(document).on('click', '.eliminarProveedor', e => {
        if (confirm('¿Eliminar Proveedor?')) {
            var elementoABorrar = $(this)[0].activeElement.parentElement.parentElement;
            var cod = elementoABorrar.getAttribute('proveedorId');
            $.post('../funcionalidad/borrarProveedor.php', { cod }, respuestaBackEnd => {
                $('#modalInfo').modal('show');
                $('#infoModal').val(respuestaBackEnd);
                mostrarProveedores();
            });
        };
    });


    //|--------------------------------------------------|
    //|                Eliminar Clientes                 |
    //|--------------------------------------------------|

    $(document).on('click', '.eliminarCliente', e => {
        if (confirm('¿Eliminar cliente?')) {
            var elementoABorrar = $(this)[0].activeElement.parentElement.parentElement;
            var cod = elementoABorrar.getAttribute('clienteId');
            $.post('../funcionalidad/borrarClientes.php', { cod }, respuestaBackEnd => {
                $('#modalInfo').modal('show');
                $('#infoModal').val(respuestaBackEnd);
                mostrarClientes();
            });
        };
    });

    //|--------------------------------------------------|
    //|          Eliminar Empresa Transporte             |
    //|--------------------------------------------------|
    $(document).on('click', '.eliminarEmpresa', e => {
        if (confirm('¿Eliminar cliente?')) {
            var elementoABorrar = $(this)[0].activeElement.parentElement.parentElement;
            var cod = elementoABorrar.getAttribute('empresaId');
            $.post('../funcionalidad/borrarEmpresa.php', { cod }, respuestaBackEnd => {
                $('#modalInfo').modal('show');
                $('#infoModal').val(respuestaBackEnd);
                mostrarEmpresa();
            });
        };
    });


    //|--------------------------------------------------|
    //|               Modificar Trabajador               |
    //|--------------------------------------------------|
    // Para modificar, haremos una función para llamar desde la base de datos a lo que queremos modificar
    // Por ello, como en .eliminar vamos a buscar el cod de lo que queremos modificar para mandarlo a la consulta
    // Y que nos devuelva los valores actuales del atributo para poder rellenarlos con los que se querrán actualizar
    $(document).on('click', '.modificarTrabajador', function () {
        $('#idModificarUsuario').show();
        $('.salidaTodoUsuarios').hide();
        // Busco el elemento a modificar escalando por la tabla es decir la posicion del tr
        let elementoAModificar = $(this)[0].parentElement.parentElement;
        console.log(elementoAModificar)
        //Cogemos el cod con la clase del nombre del tr pertinente
        let cod = elementoAModificar.getAttribute('trabajadorId');
        // Mandamos el código para que nos devuelva la bd sus valores
        $.post('../funcionalidad/llamadaTrabajador.php', { cod }, function (respuestaBackEnd) {
            console.log(respuestaBackEnd)
            //Los datos vendrán del back end en un JSON que los guardo en una variable para luego en ese array, buscar el dato exacto
            const trabajador = JSON.parse(respuestaBackEnd);
            // Relleno con la id del input los valores del array, buscandolos por su posición
            $('#cod_usuarioM').val(trabajador[0]['cod']);
            $('#nombreUsuarioM').val(trabajador[0]['nombre']);
            // La siguiente línea de código es para el título al pinchar el trabajador, para que salga 
            // que trabajador se está actualizando
            $('#trabajadorSeleccionado').val(trabajador[0]['nombre']);
            $('#passUsuarioM').val(trabajador[0]['contrasena']);
            $('#tipUsuarioM').val(trabajador[0]['tipo']);
            $('#aliasUsuarioM').val(trabajador[0]['alias']);
        });
    });
    //Una vez relleno los inputs al pulsar el botón editar haremos una función para cuando se envíe el formulario (submit)
    $('#idModificarUsuario').submit(function (e) {
        // el prevenDefault necesario para controlar el submit con mi envío y no por defecto
        e.preventDefault();
        // Ahora con los datos que se han introducido los envío al back end, para que se actualicen definitivamente
        // Primero, defino lo que se va a mandar
        var patron = /(?=^[\wñ]{1,20}$)/;
        var contrasena = $('#passUsuarioM').val();
        if (contrasena.match(patron)) {
            var datosNuevos = {
                // Segundo Cojo los valores de los inputs
                cod: $('#cod_usuarioM').val(),
                nombre: $('#nombreUsuarioM').val(),
                contrasena: $('#passUsuarioM').val(),
                tipo: $('#tipUsuarioM').val(),
                alias: $('#aliasUsuarioM').val()
            };
            // Tercero, los envío para ser actualizados
            $.post('../funcionalidad/actualizarTrabajador.php', datosNuevos, respuestaBackEnd => {
                console.log(respuestaBackEnd)
                // Que salga por pantalla que se ha actualizado
                $('#modalInfo').modal('show');
                $('#infoModal').val(respuestaBackEnd);
                //Al colocar la funcion del listado junto con el preventDefault, hará que se actualice al momento la lista
                mostrarTrabajadores();
                // Actualizar los trabajadores, las funciones son iguales, uno es para actualizar y otro solo para cancelar la actualización
                // Sus funciones son diferenciadas porque el modiTraba es en submit y hará que actualice el campo
                if (respuestaBackEnd == "Trabajador actualizado") {
                    $('.salidaTodoUsuarios').show();
                    $('#idModificarUsuario').hide();
                    $('footer').hide();
                    $('#carrusel').hide();
                } else {
                    $('#tipUsuarioM').val('');
                }
            });
        } else {
            $('#passUsuarioM').focus();
            $('#passUsuarioM').addClass("error");
            $('#passUsuarioM').val("");
            $('#modalInfo').modal('show');
            $('#infoModal').val("Contraseña no válida");
        }
    });


    //|--------------------------------------------------|
    //|               Modificar Productos                |
    //|--------------------------------------------------|

    $(document).on('click', '.modificarProducto', function () {
        $('#idModiStock').show();
        $('.salidaListaStock').hide();
        let elementoAModificar = $(this)[0].parentElement.parentElement;
        console.log(elementoAModificar)
        let cod = elementoAModificar.getAttribute('productoId');
        $.post('../funcionalidad/llamadaProductos.php', { cod }, function (respuestaBackEnd) {
            console.log("llamada" + respuestaBackEnd)
            const producto = JSON.parse(respuestaBackEnd);
            $('#cBarrasM').val(producto[0]['cod']);
            $('#nomProductoM').val(producto[0]['nombre']);
            $('#productoSeleccionado').val(producto[0]['nombre']);
            $('#nProductosM').val(producto[0]['cantidad']);
            $('#precioM').val(producto[0]['precio']);
            $('#precioVentaM').val(producto[0]['pventa']);
            $('#tipProductoM').val(producto[0]['visibilidad']);
        });
    });
    $('#idModiStock').submit(function (e) {
        e.preventDefault();
        var datosNuevos = {
            cod: $('#cBarrasM').val(),
            nombre: $('#nomProductoM').val(),
            cantidad: $('#nProductosM').val(),
            precio: $('#precioM').val(),
            pventa: $('#precioVentaM').val(),
            visibilidad: $('#tipProductoM').val()
        };
        $.post('../funcionalidad/actualizarProducto.php', datosNuevos, respuestaBackEnd => {
            console.log("actualizar" + respuestaBackEnd)
            $('#modalInfo').modal('show');
            $('#infoModal').val(respuestaBackEnd);
            mostrarStock();
            if (respuestaBackEnd == "Producto actualizado") {
                // Actualizar los Productos, ocultar una vez acabado 
                $('.salidaListaStock').show();
                $('#idModiStock').hide();
                $('footer').hide();
                $('#carrusel').hide();
            }
        });
    });


    //|--------------------------------------------------|
    //|              Modificar Proveedores               |
    //|--------------------------------------------------|

    $(document).on('click', '.modificarProveedor', function () {
        $('#idModiProveedor').show();
        $('.salidaListaProveedor').hide();
        let elementoAModificar = $(this)[0].parentElement.parentElement;
        console.log(elementoAModificar)
        let cod = elementoAModificar.getAttribute('proveedorId');
        $.post('../funcionalidad/llamadaProveedor.php', { cod }, function (respuestaBackEnd) {
            const proveedor = JSON.parse(respuestaBackEnd);
            $('#cod_ProveedorM').val(proveedor[0]['cod']);
            $('#nombreProveedorM').val(proveedor[0]['nombre']);
            $('#proveedorSeleccionado').val(proveedor[0]['nombre']);
            $('#telProveedorM').val(proveedor[0]['telefono']);
            $('#direccionM').val(proveedor[0]['direccion']);
        });
    });
    $('#idModiProveedor').submit(function (e) {
        e.preventDefault();
        var patron = /^(6|7|9)[0-9]{8}$/;
        var telefono = $('#telProveedorM').val();
        if (telefono.match(patron)) {
            var datosNuevos = {
                cod: $('#cod_ProveedorM').val(),
                nombre: $('#nombreProveedorM').val(),
                telefono: $('#telProveedorM').val(),
                direccion: $('#direccionM').val()
            };
            $.post('../funcionalidad/actualizarProveedor.php', datosNuevos, respuestaBackEnd => {
                mostrarProveedores();
                $('#modalInfo').modal('show');
                $('#infoModal').val(respuestaBackEnd);
                // Actualizar los Proveedores, ocultar una vez acabado 
                $('.salidaListaProveedor').show();
                $('#idModiProveedor').hide();
                $('footer').hide();
                $('#carrusel').hide();
            });
        } else {
            $('#telProveedorM').focus();
            $('#telProveedorM').addClass("error");
            $('#modalInfo').modal('show');
            $('#infoModal').val("Teléfono no válido");
        }
    });


    //|--------------------------------------------------|
    //|           Modificar Empresa Transporte           |
    //|--------------------------------------------------|

    $(document).on('click', '.modificarEmpresa', function () {
        $('#idModiEmpresa').show();
        $('.salidaListaEmpresa').hide();
        let elementoAModificar = $(this)[0].parentElement.parentElement;
        console.log(elementoAModificar)
        let cod = elementoAModificar.getAttribute('empresaId');
        $.post('../funcionalidad/llamadaEmpresa.php', { cod }, function (respuestaBackEnd) {
            const empresa = JSON.parse(respuestaBackEnd);
            $('#cod_EmpresaM').val(empresa[0]['cod']);
            $('#empresaSeleccionada').val(empresa[0]['nombre']);
            $('#nombreEmpresaM').val(empresa[0]['nombre']);
            $('#telEmpresaM').val(empresa[0]['telefono']);
            $('#comisionEmpM').val(empresa[0]['comision']);
        });
    });
    $('#idModiEmpresa').submit(function (e) {
        e.preventDefault();
        var patron = /^(6|7|9)[0-9]{8}$/;
        var telefono = $('#telEmpresaM').val();
        if (telefono.match(patron)) {
            var datosNuevos = {
                cod: $('#cod_EmpresaM').val(),
                nombre: $('#nombreEmpresaM').val(),
                telefono: $('#telEmpresaM').val(),
                comision: $('#comisionEmpM').val()
            };
            $.post('../funcionalidad/actualizarEmpresa.php', datosNuevos, respuestaBackEnd => {
                mostrarEmpresa();
                $('#modalInfo').modal('show');
                $('#infoModal').val(respuestaBackEnd);
                //Actualizar Empresas Transpore, ocultar una vez acabado
                $('.salidaListaEmpresa').show();
                $('#idModiEmpresa').hide();
                $('footer').hide();
                $('#carrusel').hide();
            });
        } else {
            $('#telEmpresaM').focus();
            $('#telEmpresaM').addClass("error");
            $('#modalInfo').modal('show');
            $('#infoModal').val("Teléfono no válido");
        }
    });


    //|--------------------------------------------------|
    //|               Modificar Clientes                 |
    //|--------------------------------------------------|

    $(document).on('click', '.modificarCliente', function () {
        $('#idModiCliente').show();
        $('.salidaListaClientes').hide();
        let elementoAModificar = $(this)[0].parentElement.parentElement;
        console.log(elementoAModificar)
        let cod = elementoAModificar.getAttribute('clienteId');
        $.post('../funcionalidad/llamadaClientes.php', { cod }, function (respuestaBackEnd) {
            const clientes = JSON.parse(respuestaBackEnd);
            $('#idClienteM').val(clientes[0]['cod']);
            $('#clienteSeleccionado').val(clientes[0]['nombre']);
            $('#nombreClienteM').val(clientes[0]['nombre']);
            $('#telClienteM').val(clientes[0]['telefono']);
            $('#direccionClienteM').val(clientes[0]['direccion']);
        });
    });
    $('#idModiCliente').submit(function (e) {
        e.preventDefault();
        var patron = /^(6|7|9)[0-9]{8}$/;
        var telefono = $('#telClienteM').val();
        if (telefono.match(patron)) {
            var datosNuevos = {
                cod: $('#idClienteM').val(),
                nombre: $('#nombreClienteM').val(),
                telefono: $('#telClienteM').val(),
                direccion: $('#direccionClienteM').val()
            };
            $.post('../funcionalidad/actualizarCliente.php', datosNuevos, respuestaBackEnd => {
                mostrarClientes();
                $('#modalInfo').modal('show');
                $('#infoModal').val(respuestaBackEnd);
                //Contraer el formulario del cliente
                $('#idModiCliente').hide();
                $('.salidaListaClientes').show();
                $('footer').hide();
                $('#carrusel').hide();
            });
        } else {
            $('#telClienteM').focus();
            $('#telClienteM').addClass("error");
            $('#modalInfo').modal('show');
            $('#infoModal').val("Teléfono no válido");
        }
    });


    // |-----------------------------------------------------------------------|
    // |      Agregar a la base de datos los Pedidos -> gestiona_transporta    |
    // |                                   &                                   |
    // |             Agregar a la base de datos los Pedidos                    |
    // |-----------------------------------------------------------------------|
    // Tiene que existir como clave primaria en su tabla, antes de poder estar como foránea en otra
    $('#crearPedido').submit(function (e) {
        e.preventDefault();
        var datosPedido = {
            direccion: $('#direccionPedido').val(),
            trabajador: $('#codSesionUsu').val()
        }
        // Con el pedido hecho, saco a través de su dirección el código
        $.post('../funcionalidad/crearPedido.php', datosPedido, respuestaBackEnd => {
            // Me devuelve el cod, del pedido insertando en la tabla el id del trabajador
            console.log("primera" + respuestaBackEnd)
            if ($("#empTransPedido option:selected").val() == -1) {
                $('#modalInfo').modal('show');
                $('#infoModal').val("Seleccione empresa");
            } else {
                var masDatos = {
                    trabajador: $('#codSesionUsu').val(),
                    //Esta es la forma de sacar un valor de un select, si quisiera sacar el texto(option) seria .html() y no .val()
                    empresa: $("#empTransPedido option:selected").val(),
                    cod: respuestaBackEnd
                }
                // Es necesario registrar el cod del pedido antes de volver antes de meterlo en la tabla triernia por
                // Realizo la insercción en dos fases de post
                console.log(masDatos)
                $.post('../funcionalidad/crearPedido2.php', masDatos, respuestaBackEnd => {
                    console.log("segunda" + respuestaBackEnd)
                    $('#modalInfo').modal('show');
                    $('#infoModal').val(respuestaBackEnd);
                    $('#crearPedido').trigger("reset");
                    $('#telBusCliente').val("");
                    $('#direccionPedido').val("");
                    $('#crearPedido').hide('reset');
                    $('#crearCliente').hide();
                    $('footer').hide();
                });
            }
        });
    });


    //|--------------------------------------------------|
    //|     Llamada a la Empresa Transporte (Pedidos)    |
    //|--------------------------------------------------|
    // Cuando vas asignar el pedido, asignas a su vez que empresa manda el pedido. Llama las empresas que haya
    function mostrarEmpresa2() {
        console.log("pulsado")
        $.get('../funcionalidad/listaEmpresa.php', respuestaBackEnd => {
            var empresas = JSON.parse(respuestaBackEnd);
            console.log(empresas);
            var plantilla = "";
            empresas.forEach(empresa => {
                plantilla +=
                    `
                    <option value="${empresa.cod}">${empresa.nombre}</option>
                    `
            });
            console.log(plantilla)
            $('#empTransPedido').append('<option value="-1" selected>Empresa Tansporte</option>' + plantilla);
        });
    };


    //|--------------------------------------------------|
    //|                Llamada Proveedores               |
    //|--------------------------------------------------|
    //Al crear el producto despliego la opción de proveedores para coger su id y agregarlo a la base de datos
    //para asi conseguir las foreign
    function mostrarProve() {
        $.get('../funcionalidad/listaProveedor2.php', respuestaBackEnd => {
            var proveedores = JSON.parse(respuestaBackEnd);
            console.log(proveedores);
            var plantilla = "";
            proveedores.forEach(proveedor => {
                plantilla +=
                    `
                    <option value="${proveedor.cod}">${proveedor.compania}</option>
                    `
            });
            $('#pro').append('<option value="-1" selected>Compañia</option>' + plantilla);
        });
    };


    //|--------------------------------------------------|
    //|  Buscar direccion del cliente por su telefono    |
    //|--------------------------------------------------|
    // Aquí es donde pongo la foreign bien puesta, agregando pedido a su cliente
    $('#btnTelClientes').click(function () {
        var telefono = $('#telBusCliente').val();
        if (telefono == "") {
            telefono = -1;
        }
        console.log("telefono: " + telefono)
        $.post('../funcionalidad/buscarDireccion.php', { telefono }, respuestaBackEnd => {
            $('#modalInfo').modal('show');
            $('#infoModal').val(respuestaBackEnd);
            if (respuestaBackEnd == "El cliente no existe") {
                $('#crearPedido').hide();
            }
            const direccion = JSON.parse(respuestaBackEnd);
            $('#direccionPedido').val(direccion[0]['direccion']);
            $('#infoModal').val("Existe el cliente");
            $('#modalInfo').modal('hide');
        });
        $('#btnTelClientes').trigger("reset");
        // Se desplegará la opcion de pedidos tras pulsar el boton busqueda por telefono
        $('#crearPedido').show();
        $('#empTransPedido').empty();
        //Desplegar las empresas que hay en el select de transporte
        mostrarEmpresa2();
        $('footer').hide();
    });


    //|--------------------------------------------------|
    //|                     Salir                        |
    //|--------------------------------------------------|
    //Salir al login y cerrar la sesión del usuario
    $('#cerrar').click(function () {
        if (confirm('¿Salir?')) {
            location.href = "../funcionalidad/salir.php";
        }
    });









    //|------------------------------------------------------------------------------------------------|
    //|                                          TICKET DE COMPRA                                      |
    //|------------------------------------------------------------------------------------------------|


    // Importante, importantísimo este trozo de aqui. No perder el focus en ningun momento
    // del buscador de productos. Da igual donde pinches en el DOM de la zona del ticket,
    //que siempre tendrá el foco puesto en el input del código de barras
    $(document).on('click', '#formTicket', function () {
        $('#codTicketProducto').focus();
    });

    //|--------------------------------------------------|
    //|           Focus del ticket de Compra             |
    //|--------------------------------------------------|

    // Vamos ayudarnos de los metedos insertRow (Agrega linea nueva) y insertCell (Agregar celda) 
    function lineaNueva() {
        // Pongo la id de la tabla de la compra puesto en el tfoot, porque al borrar el contenido
        // del tabla Ticket, se borrarán solo los articulos del mismo sin tocar el buscador porque están el tbody
        var tablaTicket = document.getElementById("codProTicket");
        // Defino la fila
        var lineaNueva = tablaTicket.insertRow(0);
        // Defino la celda
        var celdaNueva = lineaNueva.insertCell(0);
        // Le digo que va a tener esa nueva celda
        var nuevoInput = `<input type="number" id="codTicketProducto" placeholder="cod..">`;
        celdaNueva.innerHTML = nuevoInput;
        // Al dejar el foco puesto en el id del input, consigo que baje el scroll consigo
        $('#codTicketProducto').focus();
    };

    //|--------------------------------------------------|
    //|   Aparición de Productos sin Código de Barras    |
    //|--------------------------------------------------|

    function productosSinCodigoDeBarras() {
        $.get('../funcionalidad/productosVisibles.php', respuestaBackEnd => {
            var productos = JSON.parse(respuestaBackEnd);
            var plantilla = "";
            productos.forEach(producto => {
                plantilla += `
                        <div class="card bg-info" idSubPro=${producto.cod}>
                            <div class="card-body text-center psc2" >
                                <p class="card-text" id="a">${producto.nombre}</p>
                                <button class="btn btn-warning btn-sm anadirTicket" style="color:black;">Añadir</button>
                            </div>
                        </div>`
                $('#codTicketProducto').focus();
            });
            $('.productosSinCodigo').html(plantilla);
        });
    };


    //|------------------------------------------------------|
    //|       Productos al Ticket con código de barras       |
    //|------------------------------------------------------|

    $('#codTicketProducto').keyup(function nuevoCodigo() {
        var codProducto = $('#codTicketProducto').val();
        llamadaProductos(codProducto);
    });


    //|--------------------------------------------------|
    //|     Productos al Ticket sin código de barras     |
    //|--------------------------------------------------|

    $(document).on('click', '.anadirTicket', function () {
        let subir = $(this)[0].parentElement.parentElement;
        let codProducto = subir.getAttribute('idSubPro');
        llamadaProductos(codProducto);
    });


    //|--------------------------------------------------|
    //|   Llamada al back-end para rellenar el ticket    |
    //|--------------------------------------------------|

    function llamadaProductos(codProducto) {
        $.get('../funcionalidad/listaCompra.php', { codProducto }, respuestaBackEnd => {
            console.log(respuestaBackEnd)
            var compra = JSON.parse(respuestaBackEnd);
            console.log(compra)
            var plantilla = "";
            compra.forEach(producto => {
                var cantidad, total, redondeoTotal;
                // Cantidad de productos que se llevan
                cantidad = parseInt(prompt("¿Cuántos?"));
                if (cantidad >= 1 && cantidad != NaN) {
                    total = cantidad * producto.pventa;
                } else {
                    cantidad = 1;
                    total = producto.pventa;
                }
                plantilla +=
                    `
                    <tr style="text-align: center">
                    <td><input type="number" class="cantidad" value="${codProducto}" style="background-color:transparent;border: 0; text-align:center;" disabled></td>
                    <td>${producto.nombre}</td>
                    <td>${cantidad}</td>
                    <td>${producto.pventa}</td>
                    <td><input type="number"class="subtotal" value="${total}" style="background-color:transparent;border: 0;text-align:center;" disabled></td>
                    <td><button class="btn btn-danger eliminarProductoTicket">Borrar</button></td>
                    </tr>       
                    `
                // Voy a generar la plantilla dentro de la misma plantilla para poder
                // captar el codigo del producto y la cantidad dinámicamente y de esta manera
                // puedo captar la cantidad total de cada venta
                $('#ticket').append(plantilla);
                sumarProductos();
                // Dentro de la función de colocar los productos al ticket, hago:
                //|----------------------------------------------------------------------|
                //|           Cerrar la venta del ticket (dentro de la llamada)          |
                //|----------------------------------------------------------------------|
                // Para actualizar los productos en la bd necesito conger los valores dinámicamente
                // Actualización de productos del ticket tras pulsar el botón de venta (hacer el submit)
                // Al pulsar el botón de venta se mandarán los valores
                $('#formTicket').submit(function (e) {
                    if (confirm('¿Confirmar Venta?')) {
                        e.preventDefault();
                        var datosVenta = {
                            codProducto,
                            cantidad,
                            codTrabajador: $('#codSesionUsu').val(),
                            totVenta: $('#resCompra').val()
                        };
                        console.log(datosVenta)
                        // Aprovecho para rellenar tabla de unión entre trabajador y productos en la actualización
                        $.post('../funcionalidad/actualizarProductosTrasVenta.php', datosVenta, respuestaBackEnd => {
                            console.log(respuestaBackEnd)
                            $('#formTicket').trigger('reset');
                            // Borro el contenido del tbody
                            $('#ticket').empty();
                            sumarProductos();
                        });
                    }
                });
            });
            // Limpiar el input de entrada tras cada producto añadido a la lista
            $('#codTicketProducto').val('');
        });
    }


    //|--------------------------------------------------|
    //|      Suma de todos los productos del ticket      |
    //|--------------------------------------------------|

    function sumarProductos() {
        var sum = 0, tot = 0;
        $('.subtotal').each(function () {
            sum += Number($(this).val());
        });
        $('#resCompra').val(sum.toFixed(2)).append("€");
    }


    // Esta línea siguiente, nos ayuda ha hacer un orden en la funciones
    //$.when(funcion()).then(funcion2());
    //|--------------------------------------------------|
    //|       Listado del resumen diario de ventas       |
    //|--------------------------------------------------|

    function mostrarResumenDiario() {
        $.get('../funcionalidad/listaResumen.php', respuestaBackEnd => {
            console.log(respuestaBackEnd)
            var listados = JSON.parse(respuestaBackEnd);
            console.log(listados);
            var plantilla = "";
            listados.forEach(listado => {
                plantilla +=
                    `
                    <tr class="text-center">
                  <td>${listado.producto}</td>
                  <td>${listado.precio}</td>
                  <td>${listado.cantidad}</td>
                  <td class="sumaTotal">${listado.precio * listado.cantidad}</td>
                  </tr>`

            });
            $('#salidaResumen').html(plantilla);
            mostrarTotal();
        });
    };


    //|--------------------------------------------------|
    //|                  Total Diario                    |
    //|--------------------------------------------------|

    function mostrarTotal() {
        var sum = 0;
        $(".sumaTotal").each(function () {
            sum += parseFloat($(this).text());
        });
        $("#totalDiario").val(sum.toFixed(2));
    }


    //|--------------------------------------------------|
    //|           Borrar productos del ticket            |
    //|--------------------------------------------------|

    $("#ticket").on("click", ".eliminarProductoTicket", function () {
        $(this).closest("tr").remove();
        sumarProductos();
    });




    // FIN de la función
});




//Calculadora
function operaciones(op) {
    var ops = {
        sumar: function sumarNumeros(n1, n2) {
            return (parseInt(n1) + parseInt(n2));
        },
        restar: function restarNumeros(n1, n2) {
            return (parseInt(n1) - parseInt(n2));
        },
        multiplicar: function multiplicarNumeros(n1, n2) {
            return (parseInt(n1) * parseInt(n2));
        },
        dividir: function dividirNumeros(n1, n2) {
            return (parseInt(n1) / parseInt(n2));
        }
    };
    var operacion;
    switch (op) {
        case 'sumar':
            var operando1 = document.getElementById("resultado").value;
            document.getElementById("resultado").value = operando1 + "+";
            operacion = document.getElementById("resultado").value;
            document.getElementById("memoria").value = "suma";
            break;
        case 'restar':
            var operando1 = document.getElementById("resultado").value;
            document.getElementById("resultado").value = operando1 + "-";
            operacion = document.getElementById("resultado").value;
            document.getElementById("memoria").value = "resta";
            break;
        case 'multiplicar':
            var operando1 = document.getElementById("resultado").value;
            document.getElementById("resultado").value = operando1 + "*";
            operacion = document.getElementById("resultado").value;
            document.getElementById("memoria").value = "multiplicacion";
            break;
        case 'dividir':
            var operando1 = document.getElementById("resultado").value;
            document.getElementById("resultado").value = operando1 + "/";
            operacion = document.getElementById("resultado").value;
            document.getElementById("memoria").value = "division";
            break;
        case 'igual':
            operacion = document.getElementById("resultado").value;
            var memoriaop = document.getElementById("memoria").value;
            switch (memoriaop) {
                case 'suma':
                    var operandos = operacion.split("+");
                    var resultado = ops.sumar(operandos[0], operandos[1]);
                    document.getElementById("resultado").value = resultado;
                    break;
                case 'resta':
                    var operandos = operacion.split("-");
                    var resultado = ops.restar(operandos[0], operandos[1]);
                    document.getElementById("resultado").value = resultado;
                    break;
                case 'multiplicacion':
                    var operandos = operacion.split("*");
                    var resultado = ops.multiplicar(operandos[0], operandos[1]);
                    document.getElementById("resultado").value = resultado;
                    break;
                case 'division':
                    var operandos = operacion.split("/");
                    var resultado = ops.dividir(operandos[0], operandos[1]);
                    document.getElementById("resultado").value = resultado;
                    break;
            }
            break;
    }
}