<?php
// Inicio de la sesión
session_start();
// Recupero la sesión asignada en este caso al nombre del usuario
$usuario = $_SESSION['usuario'];
// Y a su código, que me ayudará para hacer la tabla de los pedidos y las ventas
$codTrabajador = $_SESSION['cod'];
// En el caso de no existir usuario, que valla al loggin
if (!isset($usuario)) {
    header('location: login.php');
    // Si existe el usuario, entra al sistema
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Panadería</title>
        <link rel="stylesheet" href="https://bootswatch.com/4/sketchy/bootstrap.min.css" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="../css/index.css">
        <script src="../js/js.js"></script>
    </head>

    <body>
        <nav class="navbar navbar-light bg-dark">
            <span class="navbar-brand text-center">
                <h2>Bienvenido <?php echo $_SESSION['usuario']; ?></h2>
            </span>
            <!-- Modal del sistema de busqueda, donde aparecerá las coincidencias -->
            <div id="salidaBusqueda" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="text-center">Nota Informativa</h3>
                            <div class="modal-title">
                                <button type="button" class="btn btn-info bsqdReset" data-dismiss="modal">Aceptar</button>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="text-center infoMdl"></div>
                        </div>
                    </div>
                </div>
            </div>
            <form class="form-inline">
                <input class="form-control mr-sm-2" type="search" id="buscar" placeholder="Consulta precio . . .">
            </form>
        </nav>
        <!-- Ticket de la compra -->
        <section>
            <form id="formTicket">
                <div class="container tabla">
                    <div class="row">
                        <div class="col-sm-1 offset-1 total col-xs-1">
                            <h3>Total</h3>
                            <input type="text" id="resCompra" class="transparente">
                            <button type="submit" id="ventaTicket" class="btn btn-success btn-lg">Venta</button>
                        </div>
                        <div class="col-sm-9 ticket col-xs-10">
                            <table class="table table-sm">
                                <thead>
                                    <tr class="table-info text-center" id="cabezaTicket">
                                        <th>Código</th>
                                        <th>Nombre</th>
                                        <th>Unidades</th>
                                        <th>Precio</th>
                                        <th>Total</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <!-- Los productos crecerán hacia abajo en el tbody -->
                                <tbody id="ticket">

                                </tbody>
                                <!-- Para mantener el buscador de productos siempre debajo lo pongo en el tfoot -->
                                <tfoot id="codProTicket">

                                </tfoot>
                            </table>
                        </div>
                        <div class="col-sm-1 opciones col-xs-1">
                            <!-- El trabajador al botón de administración no tendrá acceso, por ello el disable=disable -->
                            <button type="button" class="btn btn-info p-3 mb-4 rounded" disabled="disabled" id="opcionesAdministracion">Administrador</button>
                            <button type="button" class="btn btn-info p-3 mb-4 rounded" id="opcionesDomicilio" data-toggle="modal" data-target="#mdlDomicilio">Domicilio</button>
                            <button type="button" class="btn btn-info p-3 mb-4 rounded" id="opcionesOp">Opciones</button>
                            <button type="button" class="btn btn-info p-3 mb-4 rounded" id="pscb">Visibilidad</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
        <aside>
            <!-- Carrusel de imagenes -->
            <div id="carrusel" class="carousel slide text-center" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carrusel" data-slide-to="0"></li>
                    <li data-target="#carrusel" data-slide-to="1"></li>
                    <li data-target="#carrusel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../imagenes/carru2.jpg" alt="fotoAnimo1">
                    </div>
                    <div class="carousel-item">
                        <img src="../imagenes/carru1.jpg" alt="fotoAnimo2">
                    </div>
                    <div class="carousel-item text-center">
                        <img src="../imagenes/carru3.jpg" alt="fotoAnimo3">
                    </div>
                    <div class="carousel-item text-center">
                        <img src="../imagenes/carru5.jpg" alt="fotoAnimo3">
                    </div>
                    <div class="carousel-item text-center">
                        <img src="../imagenes/carru4.jpg" alt="fotoAnimo3">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carrusel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carrusel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <!-- Esta es la salida que aparece por pantalla cuando se pinche alguna las opciones Administrador
    que a priori el js de la página lo mantiene oculto -->
            <div class="salidaAdministrar bg-dark">
                <h2 class="text-center">Gestión de la empresa</h2>
                <!-- Los modales no dependerán de botones en esta opción, sino que funcionarán al pulsar en las imagenes -->
                <!-- A cada opcion tendrá un modal para guardar, modificar o eliminar los datos. Usuario, Stock y proveedor -->
                <!-- Imagen que lanza el modal -->

                <div class="d-flex flex-row d-flex justify-content-around d-flex align-items-center">
                    <div class="p-2">
                        <figure>
                            <img src="../imagenes/usuario.png" alt="iMusuario" id="usuario" data-toggle="modal" data-target='#formUsuario'>
                            <figcaption>Usuarios</figcaption>
                        </figure>
                    </div>
                    <!-- Modal de los usuarios-->
                    <div class="modal fade" id="formUsuario" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Opciones de Usuarios</h5>
                                    <button type="button" id="btnListaUsuario" class="btn btn-primary" data-dismiss="modal">Mostrar
                                        Trabajadores</button>
                                </div>
                                <!-- Datos de crear usuario -->
                                <form id="idCrearUsuario">
                                    <div class="modal-body">
                                        <input type="hidden" id="cod_usuario">
                                        <label for="nombreUsuario">Nombre</label>
                                        <input type="text" id="nombreUsuario" placeholder="Nombre . . ." required>
                                        <label for="passUsuario">Contraseña</label>
                                        <input type="password" id="passUsuario" placeholder=" * * * " required>
                                        <label form="tipoUsuario">Tipo Usuario</label>
                                        <input list="tipoUsuario" placeholder="Jefe | trabajador" id="tipUsuario" required>
                                        <label form="aliasUsuario">Alias</label>
                                        <input type="text" id="aliasUsuario" placeholder="Superman . . ." required>
                                        <datalist id="tipoUsuario">
                                            <option value="Jefe">
                                            <option value="Trabajador">
                                        </datalist>
                                    </div>
                                    <div class="modal-footer">
                                        <div id="contenedorUsuarios"></div>
                                        <!-- data-dismiss="modal" sirve para cerrar el modal por defecto -->
                                        <button type="submit" class="btn btn-info">Agregar</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Imagen que lanza el modal productos-->
                    <div class="p-2">
                        <figure>
                            <img src="../imagenes/stock.png" alt="iMstock" id="stock" data-toggle="modal" data-target="#formStock">
                            <figcaption>Stock</figcaption>
                        </figure>
                    </div>
                    <!-- Modal del Stock-->
                    <div class="modal fade" id="formStock" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Opciones de Stock</h5>
                                    <button type="button" id="btnListaStock" class="btn btn-primary" data-dismiss="modal">Mostrar
                                        Stock</button>
                                </div>
                                <!-- formulario para crear stock -->
                                <form id="idCrearStock">
                                    <div class="modal-body">
                                        <label for="pro">Compañía</label>
                                        <select id="pro">
                                        </select>
                                        <label for="cBarras">Código de Barras</label>
                                        <input type="text" id="cBarras" placeholder="Código..." required>
                                        <label for="nomProducto">Nombre</label>
                                        <input type="text" id="nomProducto" placeholder="Nombre Producto" required>
                                        <label for="nProductos">Cantidad</label>
                                        <input type="number" id="nProductos" placeholder="0" required>
                                        <label for="precio">Precio</label>
                                        <input type="number" id="precio" placeholder="0.00" step="0.01">
                                        <label for="precioVenta">Precio Final</label>
                                        <input type="number" id="precioVenta" placeholder="0.00" step="0.01" required>
                                        <label for="tipProducto">Visible al inicio</label>
                                        <input list="visibilidad" id="tipProducto" placeholder="Sí | No" required>
                                        <datalist id=visibilidad>
                                            <option value="Si"></option>
                                            <option value="No"></option>
                                        </datalist>
                                    </div>
                                    <div class="modal-footer">
                                        <div id="contenedorStock"></div>
                                        <button type="submit" id="btnCrearStock" class="btn btn-info">Agregar</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="cerrarMenu3">Cerrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Imagen que lanza el modal proveedor-->
                    <div class="p-2">
                        <figure>
                            <img src="../imagenes/proveedor.png" alt="iMproveedores" id="proveedor" data-toggle="modal" data-target="#formProveedor">
                            <figcaption>Proveedores</figcaption>
                        </figure>
                    </div>
                    <!-- Modal del Proveedor-->
                    <div class="modal fade" id="formProveedor" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Opciones de Proveedores</h5>
                                    <button type="button" id="btnListaProveedor" class="btn btn-primary" data-dismiss="modal">Mostrar
                                        Proveedores</button>
                                </div>
                                <!-- formulario para crear Proveedores -->
                                <form id="idCrearProveedor">
                                    <div class="modal-body">
                                        <input type="hidden" id="cod_Proveedor">
                                        <label for="nombreProveedor">Compañía</label>
                                        <input type="text" id="nombreProveedor" placeholder="Nombre . . ." required>
                                        <label for="telProveedor">Teléfono</label>
                                        <input type="tel" id="telProveedor" placeholder="Contaca al . . ." required>
                                        <label for="direccion">Dirección</label>
                                        <input type="tel" id="direccion" placeholder="C/ . . ." required>
                                    </div>
                                    <div class="modal-footer">
                                        <div id="contenedorProveedor"></div>
                                        <button type="submit" id="btnCrearStock" class="btn btn-info">Agregar</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Imagen que lanza el modal reparto-->
                    <div class="p-2">
                        <figure>
                            <img src="../Imagenes/reparto.png" alt="iMreparto" id="transporte" data-toggle="modal" data-target="#formTransporte">
                            <figcaption>Empresa Transporte</figcaption>
                        </figure>
                    </div>
                    <!-- Modal de la empresa transporte-->
                    <div class="modal fade" id="formTransporte" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Opciones de Empresa Transporte</h5>
                                    <button type="button" id="btnListaTransporte" class="btn btn-primary" data-dismiss="modal">Mostrar
                                        Empresas</button>
                                </div>
                                <!-- formulario para crear Empresa Transporte -->
                                <form id="idCrearEmpresa">
                                    <div class="modal-body">
                                        <input type="hidden" id="cod_Empresa">
                                        <label for="nombreEmpresa">Compañía</label>
                                        <input type="text" id="nombreEmpresa" placeholder="Nombre . . ." required>
                                        <label for="telEmpresa">Teléfono</label>
                                        <input type="tel" id="telEmpresa" placeholder="Contaca al . . ." required>
                                        <label for="comisionEmp">Comisión</label>
                                        <input type="number" id="comisionEmp" step="0.01" placeholder="Comisión . . ." required>
                                    </div>
                                    <div class="modal-footer">
                                        <div id="contenedorEmpresa"></div>
                                        <button type="submit" class="btn btn-info">Agregar</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="p-2">
                        <button type="button" class="btn btn-danger" id="cerrarAdministrador">Atrás</button>
                    </div>
                </div>
            </div>
            <!-- Datos para modificar el trabajador -->
            <div class="container">
                <div class="row">
                    <div class="offset-2 col-8 offset-2">
                        <form id="idModificarUsuario">
                            <h1>Actualizando: <input type="text" id="trabajadorSeleccionado" class="transparente" disabled></h1>
                            <input type="hidden" id="cod_usuarioM">
                            <label for="nombreUsuarioM">Nombre</label>
                            <input type="text" id="nombreUsuarioM" required placeholder="Nombre . . .">
                            <label for="passUsuarioM">Contraseña</label>
                            <input type="password" id="passUsuarioM" required placeholder=" * * * ">
                            <label form="tipoUsuarioM">Tipo Usuario</label>
                            <input list="tipoUsuarioM" id="tipUsuarioM" required>
                            <label form="aliasUsuarioM">Alias</label>
                            <input type="text" id="aliasUsuarioM" required>
                            <datalist id="tipoUsuarioM">
                                <option value="Jefe">
                                <option value="Trabajador">
                            </datalist>
                            <div id="contenedorUsuarios"></div>
                            <button type="submit" class="btn btn-info modiTraba">Actualizar</button>
                            <button type="button" class="btn btn-danger atrasTraba">Atrás</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Listado de trabajadores -->
            <div class="container salidaTodoUsuarios">
                <h1 class="text-center">Listado de Trabajadores</h1>
                <div class="row">
                    <div class="offset-2 col-8 offset-2">
                        <button type="button" class="btn btn-danger" id="cerrarListaUsuarios">Volver</button>
                        <table class="table table-striped table-bordered">
                            <thead class="table-info">
                                <tr class="text-center">
                                    <td>Nombre</td>
                                    <td>Contraseña</td>
                                    <td>Tipo</td>
                                    <td>Alias</td>
                                    <td>Opciones</td>
                                </tr>
                            </thead>
                            <tbody id="salidaUsuarios">

                            </tbody>
                        </table>
                    </div>
                </div>
                <button type="button" class="btn btn-danger" id="cerrarListaUsuarios2">Volver</button>
            </div>
            <!-- Datos para modificar los productos -->
            <div class="container">
                <div class="row">
                    <div class="offset-2 col-8 offset-2">
                        <form id="idModiStock">
                            <h1>Actualizando: <input type="text" id="productoSeleccionado" class="transparente" disabled></h1>
                            <label for="cBarrasM">Código de Barras</label>
                            <input type="text" id="cBarrasM" required placeholder="Código...">
                            <label for="nomProductoM">Nombre</label>
                            <input type="text" id="nomProductoM" required placeholder="Nombre Producto">
                            <label for="nProductosM">Cantidad</label>
                            <input type="number" id="nProductosM" required placeholder="0">
                            <label for="precioM">Precio</label>
                            <input type="number" id="precioM" required placeholder="0" step="0.01">
                            <label for="precioVentaM">Precio Final</label>
                            <input type="number" id="precioVentaM" required placeholder="0" step="0.01">
                            <label for="tipProductoM">Visible al inicio</label>
                            <input list="visibilidadM" id="tipProductoM" required>
                            <datalist id=visibilidadM>
                                <option value="Si"></option>
                                <option value="No"></option>
                            </datalist>
                            <button type="submit" id="btnModiStock" class="btn btn-info">Actualizar</button>
                            <button type="button" class="btn btn-danger" id="atraStock">Atrás</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Listado del stock de la tienda -->
            <div class="container salidaListaStock">
                <h1 class="text-center">Listado de Productos en la tienda</h1>
                <div class="row">
                    <div class="offset-2 col-8 offset-2">
                        <button type="button" class="btn btn-danger" id="cerrarListaStock">Volver</button>
                        <table class="table table-striped table-bordered">
                            <thead class="table-info">
                                <tr class="text-center">
                                    <td>Código</td>
                                    <td>Nombre</td>
                                    <td>Cantidad</td>
                                    <td>Precio</td>
                                    <td>Precio de Venta</td>
                                    <td>Visible</td>
                                    <td>Opciones</td>
                                </tr>
                            </thead>
                            <tbody id="salidaStock">

                            </tbody>
                        </table>
                    </div>
                </div>
                <button type="button" class="btn btn-danger" id="cerrarListaStock2">Volver</button>
            </div>
            <!-- formulario para modificar Proveedores  -->
            <div class="container">
                <div class="row">
                    <div class="offset-2 col-8 offset-2">
                        <form id="idModiProveedor">
                            <h1>Actualizando: <input type="text" id="proveedorSeleccionado" class="transparente" disabled></h1>
                            <input type="hidden" id="cod_ProveedorM">
                            <label for="nombreProveedor">Compañía</label>
                            <input type="text" id="nombreProveedorM" required placeholder="Nombre . . .">
                            <label for="telProveedor">Teléfono</label>
                            <input type="tel" id="telProveedorM" required placeholder="Contaca al . . .">
                            <label for="direccion">Dirección</label>
                            <input type="tel" id="direccionM" required placeholder="C/ . . .">
                            <button type="submit" id="btnModiProve" class="btn btn-info">Actualizar</button>
                            <button type="button" class="btn btn-danger atrasProveedor">Atrás</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- listado de los proveedores contratados -->
            <div class="container salidaListaProveedor">
                <h1 class="text-center">Listado de Proveedores contratados</h1>
                <div class="row">
                    <div class="offset-2 col-8 offset-2">
                        <button type="button" class="btn btn-danger" id="cerrarListaProveedor">Volver</button>
                        <table class="table table-striped table-bordered">
                            <thead class="table-info">
                                <tr class="text-center">
                                    <td>Compañía</td>
                                    <td>Teléfono</td>
                                    <td>Dirección</td>
                                    <td>Opciones</td>
                                </tr>
                            </thead>
                            <tbody id="salidaProveedor">

                            </tbody>
                        </table>
                    </div>
                </div>
                <button type="button" class="btn btn-danger" id="cerrarListaProveedor2">Volver</button>
            </div>
            <!-- Modificar Empresas de Transporte contratadas -->
            <div class="container">
                <div class="row">
                    <div class="offset-2 col-8 offset-2">
                        <form id="idModiEmpresa">
                            <h1>Actualizando: <input type="text" id="empresaSeleccionada" class="transparente" disabled></h1>
                            <input type="hidden" id="cod_EmpresaM">
                            <label for="nombreEmpresaM">Compañía</label>
                            <input type="text" id="nombreEmpresaM" required placeholder="Nombre . . .">
                            <label for="telEmpresaM">Teléfono</label>
                            <input type="tel" id="telEmpresaM" required placeholder="Contaca al . . .">
                            <label for="comisionEmpM">Comisión</label>
                            <input type="number" id="comisionEmpM" required step="0.01" placeholder="Comisión . . .">
                            <button type="submit" class="btn btn-info btnModiEmp">Agregar</button>
                            <button type="button" class="btn btn-danger atrasEmpresa">Cerrar</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- listado de las Empresas de Transporte contratadas -->
            <div class="container salidaListaEmpresa">
                <h1 class="text-center">Listado de Empresas de Transporte contratadas</h1>
                <div class="row">
                    <div class="offset-2 col-8 offset-2">
                        <button type="button" class="btn btn-danger" id="cerrarListaEmpresa">Volver</button>
                        <table class="table table-striped table-bordered">
                            <thead class="table-info">
                                <tr class="text-center">
                                    <td>Nombre</td>
                                    <td>Teléfono</td>
                                    <td>Comisión</td>
                                    <td>Opciones</td>
                                </tr>
                            </thead>
                            <tbody id="salidaEmpresa">

                            </tbody>
                        </table>
                    </div>
                </div>
                <button type="button" class="btn btn-danger" id="cerrarListaEmpresa2">Volver</button>
            </div>
            <!-- Modal del Domicilio (dentro está el Cliente)-->
            <div class="modal fade" id="mdlDomicilio" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Domicilio</h5>
                            <div id="contenedorClientes"></div>
                            <button type="button" id="btnListaPedidos" class="btn btn-info" data-dismiss="modal">Historial Pedidos</button>
                            <button type="button" id="btnListaClientes" class="btn btn-info" data-dismiss="modal">Mostrar Clientes</button>
                            <button type="button" id="btnClienteNuevo" class="btn btn-primary">Cliente Nuevo</button>
                            <!-- data-dismiss="modal" sirve para cerrar el modal por defecto -->
                            <button type="button" class="btn btn-danger" id="cierraDomi" data-dismiss="modal">Cerrar</button>
                        </div>
                        <div class="modal-header">
                            <p class="modal-title">Buscar Cliente</p>
                            <form id="BuscarCliente">
                                <label for="telBusCliente">Teléfono</label>
                                <input type="tel" id="telBusCliente" placeholder="950 . . .">
                                <button type="button" id="btnTelClientes" class="btn btn-success">Buscar</button>
                            </form>
                        </div>
                        <!-- Datos de crear cliente -->
                        <form id="crearCliente">
                            <div class="modal-header">
                                <h5 class="modal-title">Cliente</h5>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="idCliente">
                                <label for="nombreCliente">Nombre</label>
                                <input type="text" id="nombreCliente" placeholder="Nombre . . ." required>
                                <label for="telCliente">Teléfono</label>
                                <input type="tel" id="telCliente" placeholder="950 . . ." required>
                                <label form="direccionCliente">Dirección</label>
                                <input type="text" placeholder="C/ . . .  " id="direccionCliente" required>
                            </div>
                            <div class="modal-footer">
                                <!-- data-dismiss="modal" sirve para cerrar el modal por defecto -->
                                <button type="submit" class="btn btn-info" id="subClienteNuevo">Agregar</button>
                                <button type="button" class="btn btn-danger" id="cerrarClienteNuevo">Cerrar</button>
                            </div>
                        </form>
                        <form id="crearPedido">
                            <div class="modal-header">
                                <h5 class="modal-title">Pedido</h5>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="idPedido">
                                <label form="direccionPedido">Dirección</label>
                                <input type="text" placeholder="C/ . . .  " id="direccionPedido" style="width:25vw" required>
                                <input type="hidden" id="codSesionUsu" value="<?php echo $codTrabajador ?>">
                                <label for="empTransPedido">Empresa</label>
                                <select id="empTransPedido">
                                </select>

                                <button type="submit" class="btn btn-info botonDomi" id="subPedidos">Agregar</button>
                                <button type="button" class="btn btn-danger" id="cerrarPedido" data-dismiss="modal">Cerrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- formulario de modificación de los clientes -->
            <div class="container">
                <div class="row">
                    <div class="offset-2 col-8 offset-2">
                        <form id="idModiCliente">
                            <h1>Actualizando: <input type="text" id="clienteSeleccionado" class="transparente" disabled></h1>
                            <input type="hidden" id="idClienteM">
                            <label for="nombreClienteM">Nombre</label>
                            <input type="text" id="nombreClienteM" required placeholder="Nombre . . .">
                            <label for="telClienteM">Teléfono</label>
                            <input type="tel" id="telClienteM" required placeholder="950 . . .">
                            <label form="direccionClienteM">Dirección</label>
                            <input type="text" placeholder="C/ . . .  " required id="direccionClienteM">
                            <button type="submit" class="btn btn-info" id="cerrarClienteActM">Actualizar</button>
                            <button type="button" class="btn btn-danger" id="cerrarClienteNuevoM">Atrás</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- listado de Clientes -->
            <div class="container salidaListaClientes">
                <h1 class="text-center">Listado de clientes</h1>
                <div class="row">
                    <div class="offset-2 col-8 offset-2">
                        <button type="button" class="btn btn-danger" id="cerrarClientePedido">Volver</button>
                        <table class="table table-striped table-bordered">
                            <thead class="table-info">
                                <tr class="text-center">
                                    <td>Nombre</td>
                                    <td>Teléfono</td>
                                    <td>Dirección</td>
                                    <td>Opciones</td>
                                </tr>
                            </thead>
                            <tbody id="salidaClientes">

                            </tbody>
                        </table>
                    </div>
                </div>
                <button type="button" class="btn btn-danger" id="cerrarClientePedido2">Volver</button>
            </div>
            <!-- listado del Historial de pedidos -->
            <div class="container salidaListaPedidos">
                <h1 class="text-center">Pedidos Realizados</h1>
                <div class="row">
                    <div class="offset-2 col-8 offset-2">
                        <button type="button" class="btn btn-danger" id="cerrarListaPedido">Volver</button>
                        <table class="table table-striped table-bordered">
                            <thead class="table-info">
                                <tr class="text-center">
                                    <td>Trabajador</td>
                                    <td>Empresa Transporte</td>
                                    <td>Teléfono Empresa</td>
                                    <td>Dirección del Pedido</td>
                                    <td>Comisión</td>
                                </tr>
                            </thead>
                            <tbody id="salidaPedidos">

                            </tbody>
                        </table>
                    </div>
                </div>
                <button type="button" class="btn btn-danger" id="cerrarListaPedido2">Volver</button>
            </div>
            <!-- listado del resumen diario -->
            <div class="container salidaListaResumen">
                <h1 class="text-center">Resumen del día</h1>
                <div class="row">
                    <div class="offset-2 col-8 offset-2">
                        <button type="button" class="btn btn-danger" id="cerrarListaResumen">Volver</button>
                        <table class="table table-striped table-bordered">
                            <thead class="table-success">
                                <tr class="text-center">
                                    <th>
                                        <h3>Empleado: <input type="text" id="nomTraDiario" class="transparente2" value="<?php echo $usuario ?>"></h3>
                                    </th>
                                    <th>
                                        <h3>Total: <input type="text" id="totalDiario" class="transparente2"></h3>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                        <table class="table table-striped table-bordered">
                            <thead class="table-info">
                                <tr class="text-center">
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="salidaResumen">

                            </tbody>
                        </table>
                    </div>
                </div>
                <button type="button" class="btn btn-danger" id="cerrarListaResumen2">Volver</button>
            </div>
            <!--Productos que salen en la pantalla por defecto del programa, que serán unos productos que no tengan -->
            <div class="container psc">
                <div class="row text-center">
                    <div class="col-12">
                        <button class="btn btn-primary btn-sm" id="ocultarPsc">ocultar</button>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card mb-3">
                            <div class="card border-warning">
                                <div class="card-group productosSinCodigo">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Esta es la salida que aparece por pantalla cuando se pinche las opción Opciones
             que a priori el js de la página lo mantiene oculto -->
            <div class="salidaOpciones bg-dark">
                <h2 class="text-center">Opciones</h2>
                <div class="d-flex flex-row d-flex justify-content-around d-flex align-items-center">
                    <div class="p-2">
                        <!-- Imagen que lanza el modal -->
                        <figure>
                            <img src="../imagenes/Calculadora.png" alt="iMproveedores" id="calculadora" data-toggle="modal" data-target="#calculator">
                            <figcaption>Calculadora</figcaption>
                        </figure>
                    </div>
                    <!-- Modal de la calculadora-->
                    <div class="modal fade" id="calculator" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-title text-center">
                                    <h3>Calculadora</h3>
                                </div>
                                <div class="modal-body">
                                    <!-- formulario para crear la calculadora -->
                                    <form id="calculadora">
                                        <table>
                                            <tr>
                                                <td colspan="4">
                                                    <input id="resultado" type="text" value="0" size="20" /><input id="memoria" type="hidden" value="0" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="button" value="7" onClick="var str1=document.getElementById('resultado').value; if(str1 == '0'){document.getElementById('resultado').value=7}else{ var str2='7'; var res = str1.concat(str2);document.getElementById('resultado').value=res;}">
                                                </td>
                                                <td>
                                                    <input type="button" value="8" onClick="var str1=document.getElementById('resultado').value; if(str1 == '0'){document.getElementById('resultado').value=8}else{ var str2='8'; var res = str1.concat(str2);document.getElementById('resultado').value=res;}">
                                                </td>
                                                <td>
                                                    <input type="button" value="9" onClick="var str1=document.getElementById('resultado').value; if(str1 == '0'){document.getElementById('resultado').value=9}else{ var str2='9'; var res = str1.concat(str2);document.getElementById('resultado').value=res;}">
                                                </td>
                                                <td>
                                                    <input type="button" value="/" onClick="operaciones('dividir'); return false;" style="width:55px">
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <input type="button" value="4" onClick="var str1=document.getElementById('resultado').value; if(str1 == '0'){document.getElementById('resultado').value=4}else{ var str2='4'; var res = str1.concat(str2);document.getElementById('resultado').value=res;}">
                                                </td>
                                                <td>
                                                    <input type="button" value="5" onClick="var str1=document.getElementById('resultado').value; if(str1 == '0'){document.getElementById('resultado').value=5}else{ var str2='5'; var res = str1.concat(str2);document.getElementById('resultado').value=res;}">
                                                </td>
                                                <td>
                                                    <input type="button" value="6" onClick="var str1=document.getElementById('resultado').value; if(str1 == '0'){document.getElementById('resultado').value=6}else{ var str2='6'; var res = str1.concat(str2);document.getElementById('resultado').value=res;}">
                                                </td>
                                                <td>
                                                    <input type="button" value="*" onClick="operaciones('multiplicar'); return false;">
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <input type="button" value="1" onClick="var str1=document.getElementById('resultado').value; if(str1 == '0'){document.getElementById('resultado').value=1}else{ var str2='1'; var res = str1.concat(str2);document.getElementById('resultado').value=res;}">
                                                </td>
                                                <td>
                                                    <input type="button" value="2" onClick="var str1=document.getElementById('resultado').value; if(str1 == '0'){document.getElementById('resultado').value=2}else{ var str2='2'; var res = str1.concat(str2);document.getElementById('resultado').value=res;}">
                                                </td>
                                                <td>
                                                    <input type="button" value="3" onClick="var str1=document.getElementById('resultado').value; if(str1 == '0'){document.getElementById('resultado').value=3}else{ var str2='3'; var res = str1.concat(str2);document.getElementById('resultado').value=res;}">
                                                </td>
                                                <td>
                                                    <input type="button" value="-" onClick="operaciones('restar'); return false;">
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <input type="button" value="0" onClick="var str1=document.getElementById('resultado').value; if(str1 == '0'){document.getElementById('resultado').value=0}else{ var str2='0'; var res = str1.concat(str2);document.getElementById('resultado').value=res;}">
                                                </td>
                                                <td colspan="2">
                                                    <input type="button" value="=" onClick="operaciones('igual'); return false;" style="width:110px;">
                                                </td>
                                                <td>
                                                    <input type="button" value="+" onClick="operaciones('sumar'); return false;">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                                <div class="container">
                                    <button type="button" class="btn btn-danger btn-sm btn-block" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-2">
                        <figure>
                            <img src="../Imagenes/resumen.png" alt="resumen" data-toggle="modal" data-target="#formCerrar">
                            <figcaption>Acabar turno</figcaption>
                        </figure>
                    </div>
                    <!-- Modal de cierre -->
                    <div class="modal fade" id="formCerrar" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Fin de turno</h3>
                                    <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                                </div>
                                <div class="modal-body cierre">
                                    <div class="d-flex flex-row d-flex justify-content-around d-flex align-items-center">
                                        <div class="p-2">
                                            <figure>
                                                <img src="../Imagenes/lista.png" alt="resumen" id="resumen" data-dismiss="modal">
                                                <figcaption>Resumen del día</figcaption>
                                            </figure>
                                        </div>
                                        <div class="p-2">
                                            <figure>
                                                <img src="../Imagenes/cerrar.png" alt="Cerrar" id="cerrar">
                                                <figcaption>Cierre</figcaption>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-2">
                        <button type="button" class="btn btn-danger" id="cerrarAdministrador2">Atrás</button>
                    </div>
                </div>
            </div>
            <!-- Modal de Información en general (back-end)-->
            <div id="modalInfo" class="modal fade" role="dialog">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="text-center" style="color:blue;">Nota</h3>
                            <div class="modal-title">
                                <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Aceptar</button>
                            </div>
                        </div>
                        <div class="modal-body">
                            <h5 class="text-center"><input type="text" id="infoModal" class="text-center transparente"></h5>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        <footer class="page-footer bg-dark">
            Panadería Virtu@l
        </footer>
    </body>

    </html>

    <!-- este trozo de php es el Cierre del else de la sesión puesto al inicio de la pagína -->
<?php }; ?>