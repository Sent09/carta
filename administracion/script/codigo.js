$(document).ready(function(){   
    
    cargarPagina(0);
    var paginaGlobal = 0;
    function cargarPagina(pagina){
        paginaGlobal = pagina;
        $.ajax({
            url: "ajaxselect.php?pagina="+pagina,
            success: function (result){
                destruirTabla();
                mostrarTabla(result);
                asignarEventos();
            },
            error: function () {
                toastr.error(' ', 'Error');
            }
        });
    }
    
    function asignarEventos(){
        $('#botoninsertar').on("click", insertarPlato);
        var enlaces = document.getElementsByClassName("enlace");
        for (var i = 0; i < enlaces.length; i++)
            agregarEventoPaginar(enlaces[i]);
        enlaces = document.getElementsByClassName("enlace_borrar");
        for (var i = 0; i < enlaces.length; i++)
            agregarEventoBorrar(enlaces[i]);
        enlaces = document.getElementsByClassName("enlace_editar");
        for (var i = 0; i < enlaces.length; i++)
            agregarEventoEditar(enlaces[i]);
        enlaces = document.getElementsByClassName("enlace_ver");
        for (var i = 0; i < enlaces.length; i++)
            agregarEventoVer(enlaces[i]);
    }
    function agregarEventoPaginar(elemento) {
        var datahref = elemento.getAttribute("data-href");
        elemento.onclick = function (e) {
            paginaGlobal = datahref;
            cargarPagina(datahref)
        };
    }
    function insertarPlato(){
        $('#myModal').modal('show');
        var guardarPlato = document.getElementById("guardarPlato");
        guardarPlato.onclick = function(){
            var nombre = $('#nombreInsertar').val();
            var descripcion = $('#descripcionInsertar').val();
            var precio = $('#precioInsertar').val();
            var ingredientes = $('#ingredientesInsertar').val();            
            //Fotos
            var archivo = document.getElementById("archivo");
            var ajax, archivoactual, archivos, parametros, i, longitud;
            archivos = archivo.files;
            longitud = archivo.files.length;
            parametros = new FormData();
            parametros.append("numerodearchivos", longitud);
            for (i = 0; i < longitud; i++) {
                archivoactual = archivos[i];
                parametros.append('archivo[]', archivoactual, archivoactual.name);
            }
            $.ajax({
                url: "ajaxinsert.php?nombre="+nombre+"&descripcion="+descripcion+"&precio="+precio+"&ingredientes="+ingredientes,
                success: function (result) {
                    if(result.result > 0){
                        toastr.success('Se ha guardado el plato', 'Bien');
                        ajax = new XMLHttpRequest();
                        if(ajax.upload){
                            ajax.open("POST", "ajaxinsertimagenes.php?id="+result.id, true);
                            ajax.onreadystatechange=function(texto){
                                if(ajax.readyState==4){
                                    if(ajax.status==200){
                                        
                                    } else{
                                        toastr.warning('No se guardaron las imagenes', 'Error');
                                    }
                                }
                            };
                            ajax.send(parametros);
                        }
                        $('#nombreInsertar').val("");
                        $('#descripcionInsertar').val("");
                        $('#precioInsertar').val("");
                        $('#ingredientesInsertar').val("");
                    }else{
                        toastr.error('Error al insertar', 'Error');
                    }                    
                    cargarPagina(paginaGlobal);
                },
                error: function () {
                    toastr.error(' ', 'Error');
                }
            }); 
            $('#myModal').modal('hide');
        }
    }
    
    function mostrarTabla(datos) {
        var tabla = document.createElement("table");
        tabla.setAttribute("class", "table table-striped table-bordered");
        var tr, td;
        for (var i = 0; i < datos.platos.length; i++) {
            if (i === 0) {
                tr = document.createElement("tr");
                for (var j in datos.platos[i]) {
                    if(j !== "descripcion"){
                        td = document.createElement("th");
                        td.textContent = j;
                        tr.appendChild(td);
                    }
                }
                td = document.createElement("th");
                td.textContent = "Ver plato";
                tr.appendChild(td);
                td = document.createElement("th");
                td.textContent = "Editar plato";
                tr.appendChild(td);
                td = document.createElement("th");
                td.textContent = "Eliminar plato";
                tr.appendChild(td);
                tabla.appendChild(tr);
            }
            tr = document.createElement("tr");
            for (var j in datos.platos[i]) {
                if(j !== "descripcion"){
                    td = document.createElement("td");
                    td.textContent = datos.platos[i][j];
                    tr.appendChild(td);             
                }
            }
            td = document.createElement("td");
            td.innerHTML = "<a  class='enlace_ver' data-ver='" + datos.platos[i].idplato + "'><input type='button' class='btn btn-info' value='Ver'></a>";
            tr.appendChild(td);
            td = document.createElement("td");
            td.innerHTML = "<a  class='enlace_editar' data-editar='" + datos.platos[i].idplato + "'><input type='button' class='btn btn-warning' value='Editar'></a>";
            tr.appendChild(td);
            td = document.createElement("td");
            td.innerHTML = "<a  class='enlace_borrar' data-nombre='"+datos.platos[i].nombre+"' data-borrar='" + datos.platos[i].idplato + "'><input type='button' class='btn btn-danger' value='Eliminar'></a>";
            tr.appendChild(td);
            tabla.appendChild(tr);
        }
        
        /*paginacion*/
        tr = document.createElement("tr");
        td = document.createElement("th");
        td.setAttribute("colspan", 10);
        var contenido ="";
        contenido += "<nav><ul class='pagination'><li><a class='enlace' data-href='" + datos.paginas.inicio + "'>&lt;&lt;</a></li> ";
        contenido += "<li><a class='enlace' data-href='" + datos.paginas.anterior + "'>&lt;</a> ";
        if (datos.paginas.primero !== -1)
            contenido += "<li><a  class='enlace' data-href='" + datos.paginas.primero + "'>" + (parseInt(datos.paginas.primero) + 1) + "</a></li> ";
        if (datos.paginas.segundo !== -1)
            contenido += "<li><a  class='enlace' data-href='" + datos.paginas.segundo + "'>" + (parseInt(datos.paginas.segundo) + 1) + "</a></li> ";
        if (datos.paginas.actual !== -1)
            contenido += "<li class='active'><a  class='enlace' data-href='" + datos.paginas.actual + "'>" + (parseInt(datos.paginas.actual) + 1) + "</a></li> ";
        if (datos.paginas.cuarto !== -1)
           contenido += "<li><a  class='enlace' data-href='" + datos.paginas.cuarto + "'>" + (parseInt(datos.paginas.cuarto) + 1) + "</a></li> ";
        if (datos.paginas.quinto !== -1)
            contenido += "<li><a  class='enlace' data-href='" + datos.paginas.quinto + "'>" + (parseInt(datos.paginas.quinto) + 1) + "</a></li> ";
        contenido += "<li><a  class='enlace' data-href='" + datos.paginas.siguiente + "'>&gt;</a></li> ";
        contenido += "<li><a  class='enlace' data-href='" + datos.paginas.ultimo + "'>&gt;&gt;</a></li></ul></nav> ";
        td.innerHTML = contenido;
        tr.appendChild(td);
        tabla.appendChild(tr);
        var div = document.getElementById("divajax");
        div.appendChild(tabla);
    }
    
    function destruirTabla() {
        var div = document.getElementById("divajax");
        while (div.hasChildNodes()) {
            div.removeChild(div.firstChild);
        }
    }
    function agregarEventoBorrar(elemento) {
        var databorrar = elemento.getAttribute("data-borrar");
        var datanombre = elemento.getAttribute("data-nombre");
        elemento.onclick = function () {
            confirmarBorrar(databorrar, datanombre);
        };
    }
    function confirmarBorrar(elemento, nombre) {
        var cm = document.getElementById("nombreEliminar");
        cm.innerHTML = "¿Borrar " + nombre + "?";
        var eliminarPlato = document.getElementById("eliminarPlato");
        eliminarPlato.onclick = function () {
            $.ajax({
                url: "ajaxdelete.php?id=" + elemento,
                success: function (result) {
                    if(result.result>0){
                        toastr.success('Se ha eliminado el plato', 'Bien');
                    }else{
                        toastr.warning('No se ha eliminado el plato', 'Error');
                    }
                    cargarPagina(paginaGlobal);
                },
                error: function () {
                    toastr.error(' ', 'Error');
                }
            });
            $("#modalBorrar").modal('hide');
        }
        $('#modalBorrar').modal('show');
    }
    
    function agregarEventoEditar(elemento) {
        elemento.onclick = function (e) {
            editarPlato(elemento);
        };
    }
    
    function editarPlato(elemento){
        var id = document.getElementById("idEditar");
        var nombre = document.getElementById("nombreEditar");
        var descripcion = document.getElementById("descripcionEditar");
        var precio = document.getElementById("precioEditar");
        var ingredientes = document.getElementById("ingredientesEditar");
        $("#archivoEditar").replaceWith($("#archivoEditar").clone(true));
        $('#modalEditar').modal('show');
        var td = elemento.parentNode.parentNode.getElementsByTagName("td");
        $.ajax({
            url: "ajaxgetplato.php?id=" + td[0].textContent,
            success: function (result) {
                id.value = td[0].textContent;
                nombre.value = result.nombre;
                descripcion.value = result.descripcion;
                precio.value = result.precio;
                ingredientes.value = result.ingredientes;
                var editarBoton = document.getElementById("editarPlato");
                var borrarFotos = document.getElementById("borrarFotos");
                borrarFotos.onclick = function(){
                    $('#modalEditar').modal('hide');
                    $('#modalFotos').modal('show');
                    var divFotosBorrar = document.getElementById("divFotosBorrar");
                    divFotosBorrar.innerHTML = "";
                    $.ajax({
                        url: "ajaxgetimagenes.php?id=" + id.value,
                        success: function (result) {
                            for(var i = 0; i<result.fotos.length; i++){
                                divFotosBorrar.innerHTML += "<img width='300' style='margin-right: 10px;' src='../img/"+result.fotos[i].urlfoto+"' /><input data-id='"+result.fotos[i].id+"' type='checkbox' class='checkboxfotos'>";
                            }                        
                        },
                        error: function () {
                            toastr.error('Error al cargar las imagenes', 'Error');
                        }
                    });
                    var eliminarFotos = document.getElementById("eliminarFotos");
                    eliminarFotos.onclick = function(){
                        var checkboxFotos = document.getElementsByClassName("checkboxfotos");
                        var parametros, ajax;
                        parametros = new FormData();
                        for(var i = 0; i<checkboxFotos.length; i++){
                            if(checkboxFotos[i].checked){                                
                                parametros.append('fotos[]', checkboxFotos[i].getAttribute("data-id"));
                            }
                        }
                        if(parametros){
                            ajax = new XMLHttpRequest();
                            if(ajax.upload){
                                ajax.open("POST", "ajaxborrarfotos.php", true);
                                ajax.onreadystatechange=function(texto){
                                    if(ajax.readyState==4){
                                        if(ajax.status==200){
                                            toastr.success('Se han eliminado las fotos seleccionadas', 'Bien');
                                            $('#modalFotos').modal('hide');
                                        } else{
                                            toastr.error('No se han eliminado las fotos seleccionadas', 'Error');
                                            $('#modalFotos').modal('show');
                                        }
                                    }
                                };
                                ajax.send(parametros);
                            }
                        }
                    }
                }
                
                editarBoton.onclick = function(){
                    var id = document.getElementById("idEditar");
                    var nombre = document.getElementById("nombreEditar");
                    var descripcion = document.getElementById("descripcionEditar");
                    var precio = document.getElementById("precioEditar");
                    var ingredientes = document.getElementById("ingredientesEditar");
                    $.ajax({
                        url: "ajaxeditar.php?id="+id.value+"&nombre="+nombre.value+"&descripcion="+descripcion.value+"&precio="+precio.value+"&ingredientes="+ingredientes.value,
                        success: function (result) {
                            if(result.result>0){
                                toastr.success('Se ha editado el plato', 'Bien');
                            }else{
                                toastr.warning('No se ha editado el plato', 'Error');
                            }
                            var archivo = document.getElementById("archivoEditar");
                            var ajax, archivoactual, archivos, parametros, i, longitud;
                            archivos = archivo.files;
                            longitud = archivo.files.length;
                            parametros = new FormData();
                            parametros.append("numerodearchivos", longitud);
                            for (i = 0; i < longitud; i++) {
                                archivoactual = archivos[i];
                                parametros.append('archivo[]', archivoactual, archivoactual.name);
                            }
                            ajax = new XMLHttpRequest();
                            if(ajax.upload){
                                ajax.open("POST", "ajaxinsertimagenes.php?id="+id.value, true);
                                ajax.onreadystatechange=function(texto){
                                    if(ajax.readyState==4){
                                        if(ajax.status==200){
                                            
                                        } else{
                                            toastr.error('No se han guardado las fotos', 'Error');
                                        }
                                    }
                                };
                                ajax.send(parametros);
                            }
                            cargarPagina(paginaGlobal);
                            $('#modalEditar').modal('hide');
                        },
                        error: function () {
                            toastr.error('Error al editar el plato', 'Error');
                        }
                    });
                }
            },
            error: function () {
                toastr.error('Error al cargar el plato', 'Error');
            }
        });
    }
    function agregarEventoVer(elemento) {
        elemento.onclick = function (e) {
            verUsuario(elemento);
        };
    }
    function verUsuario(elemento){
        var dataid = elemento.getAttribute("data-ver");
        var divver = document.getElementById("divver");
        divver.innerHTML = "";
        $.ajax({
            url: "ajaxgetplato.php?id=" + dataid,
            success: function (result) {
                var divver = document.getElementById("divver");
                divver.innerHTML += "<h4>Nombre: </h4>"+ result.nombre;
                divver.innerHTML += "<h4>Precio: </h4>"+ result.precio;
                divver.innerHTML += "<h4>Descripcion: </h4>"+ result.descripcion;
                divver.innerHTML += "<h4>Ingredientes: </h4>"+ result.ingredientes + "<br><br>";
                $.ajax({
                    url: "ajaxgetimagenes.php?id=" + dataid,
                    success: function (result) {
                        for(var i = 0; i<result.fotos.length; i++){
                            divver.innerHTML += "<img width='300' style='margin-right: 10px;' src='../img/"+result.fotos[i].urlfoto+"' />";
                        }                        
                    },
                    error: function () {
                        toastr.error('Error al cargar las imagenes', 'Error');
                    }
                });
            },
            error: function () {
                toastr.error('Error al cargar el plato', 'Error');
            }
        });
    }
    
});

