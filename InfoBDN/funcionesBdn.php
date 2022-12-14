<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>funciones</title>
</head>

<body>
    <?php
        //Funcion para conectar a la base de datos
        function conectar($nombre){
            $conexion = mysqli_connect("Localhost", "root", "", $nombre);
            return $conexion;
        }
        //función para validar al administrador
        function validarAdmin($conexion,$usuario,$password){
            $correcto=0;
            $sql = "SELECT * from administrador where  contrasena = md5('$password')";
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta == false){
                mysqli_error($conexion);
            }
            $numlineas = mysqli_num_rows($consulta);
            $linea = mysqli_fetch_array($consulta);
            //comprobamos los datos del usuario con la base de datos y los guardamos como sesión
            $prueba = md5($password);
            if($prueba == $linea[2]){
                $_SESSION["usuario"] = $linea;
                $_SESSION["rol"] = 1;
                $correcto = 1;
            }
            return $correcto;
        }

        //función para validar alumnos
        function validarAlumno($conexion, $usuario, $password){
            $correcto=0;
            $sql = "SELECT * from alumnos where  contrasena = md5('$password') and dni = $usuario";
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta == false){
                mysqli_error($conexion);
            }
            $numlineas = mysqli_num_rows($consulta);
            $linea = mysqli_fetch_array($consulta);
            //comprobamos los datos del usuario con la base de datos y los guardamos como sesión
            $prueba = md5($password);
            if($prueba == $linea[5] && $usuario = $linea[1]){
                $_SESSION["alumno"] = $linea;
                $_SESSION["rol"] = 2;
                $correcto = 1;
            }
            return $correcto;
        }

        //función para validar profesores
        function validarProfesor($conexion, $usuario, $password){
            $correcto=0;
            $sql = "SELECT * from profesores where dni ='$usuario' and contrasena = md5('$password') and dni = $usuario";
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta == false){
                mysqli_error($conexion);
            }
            $numlineas = mysqli_num_rows($consulta);
            $linea = mysqli_fetch_array($consulta);
            //comprobamos los datos del usuario con la base de datos y los guardamos como sesión
            $prueba = md5($password);
            if($prueba == $linea[6] && $usuario = $linea[1]){
                $_SESSION["profesor"] = $linea;
                $_SESSION["rol"] = 3;
                $correcto = 1;
            }
            return $correcto;
        }

        // query de todos los cursos
        function consultaCursos($nombre){
            $conexion = conectar($nombre);
            if ($conexion == false){
                mysqli_connect_error();
            }
            else{
                //generamos la query
                $sql = "SELECT * from cursos";
            }
            //la enviamos a la base de datos
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta == false){
                mysqli_error($conexion);
            }
            return $consulta;
        }

        //tabla de cursos de admincursos.php
        function tablaCursos($cursos){
            $numlineas = mysqli_num_rows($cursos);
            echo "<h2> Cursos BDN </h2>";
            echo "<table>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Nombre</th>";
            echo "<th>Descripción</th>";
            echo "<th>Duración</th>";
            echo "<th>Inicio</th>";
            echo "<th>Final</th>";
            echo "<th>Profesor</th>";
            echo "<th>Activo</th>";
            echo "<th>foto</th>";
            echo "<th>Mod. estado</th>";
            echo "<th>Mod. curso</th>";
            echo "<th>Mod. foto</th>";
            echo "</tr>";
            foreach($cursos as $curso => $campo){
                $id=$campo["ID"];
                $foto = $campo["cfoto"];
                echo "<tr>";
                foreach($campo as $dato){
                    if($dato == $foto){
                        echo "<td> <img width='50' height = '50' src = ".$foto." </td>";
                    }
                    else{
                        echo "<td> $dato </td>";
                    }
                }
                if($campo['activo']=='0'){
                    echo "<td> $<a href=estadoCurso.php?Numero=$id>Activar</a></td>";
                }
                else{
                    echo "<td> $<a href=estadoCurso.php?Numero=$id>Desactivar</a></td>";
                }
                echo "<td> <a href='modificarCurso.php?Numero=".$id."'> <img src='imagen/lapiz.png' width='30'></a> </td>";
                echo "<td> <a href='fotoCurso.php?Numero=".$id."'> <img src='imagen/espejo.png' width='30'></a> </td>";
                echo "</tr>";
            }
            echo "</table>";
        }

        //busco el curso a modificar en la BBDD
        function modificarCursos($nombre, $curso){

            $conexion = conectar($nombre);
            if ($conexion == false){
                mysqli_connect_error();
            }
            else{
                //generamos la query
                $sql = "SELECT * from cursos WHERE ID = $curso";
                //la enviamos a la base de datos
            }    
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta == false){
                mysqli_error($conexion);
            }
        
            return $consulta; 
        }
        
        //Extrae todos los profesores de la tabla del mismo nombre
        function consultaProfes($BBDD){
            $conexion = conectar($BBDD);
            if ($conexion == false){
                mysqli_connect_error();
            }
            else{
                //generamos la query
                $sql = "SELECT ID, dni, nombre, apellido, titulo, mail, activo, pfoto from profesores";
            }
            //la enviamos a la base de datos
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta == false){
                mysqli_error($conexion);
            }
            return $consulta;
        }
        
        //Tabla de profesores de adminProf.php
        function tablaProfes($profes){
            echo "<h2> Profesores </h2>";
            echo "<table>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>DNI</th>";
            echo "<th>Nombre</th>";
            echo "<th>apellido1</th>";
            echo "<th>titulo</th>";
            echo "<th>mail</th>";
            echo "<th>Activo</th>";
            echo "<th>foto</th>";
            echo "<th>Mod. estado</th>";
            echo "<th>Mod. profesor</th>";
            echo "<th>Mod. foto</th>";
            echo "</tr>";
            foreach($profes as $profe => $campo){
                $id=$campo["ID"];
                $foto = $campo["pfoto"];
                echo "<tr>";
                foreach($campo as $dato){
                    if($dato == $foto){
                        echo "<td> <img width='50' height = '50' src = ".$foto." </td>";
                    }
                    else{
                        echo "<td> $dato </td>";
                    }
                }

                if($campo['activo']=='0'){
                    echo "<td> $<a href=estadoProfesor.php?Numero=$id>Activar</a></td>";
                }
                else{
                    echo "<td> $<a href=estadoProfesor.php?Numero=$id>Desactivar</a></td>";
                }
                echo "<td> <a href='modificarProfesor.php?Numero=".$id."'> <img src='imagen/lapiz.png' width='30'></a> </td>";
                echo "<td> <a href='fotoProfesor.php?Numero=".$id."'> <img src='imagen/espejo.png' width='30'></a> </td>";
                echo "</tr>";
            }
        
            echo "</table>";

        }

        //seleccionar el profesor a modificar 
        function modificarProfesor($nombre, $curso){

            $conexion = conectar($nombre);
            if ($conexion == false){
                mysqli_connect_error();
            }
            else{
                //generamos la query
                $sql = "SELECT * from profesores WHERE ID = $curso";
                //la enviamos a la base de datos
            }    
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta == false){
                mysqli_error($conexion);
            }
        
            return $consulta;
            
        }
        
        // cambiar estado curso
        function estadoCurso($id){
            $BBDD = 'infobdn';
            $conexion = conectar($BBDD);
            if ($conexion == false){
                mysqli_connect_error();
            }
            else{
                //generamos la query
                $sql = "SELECT * from cursos WHERE ID = $id";
                //la enviamos a la base de datos
            }    
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta == false){
                mysqli_error($conexion);
            }
            $numlineas = mysqli_num_rows($consulta);
            $linea = mysqli_fetch_array($consulta);
            if($linea[7] == 0){
                $sql = "UPDATE cursos  SET activo= '1' WHERE ID = '$id'";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta == false){
                    mysqli_error($conexion);
                }
            }
            else{
                $sql = "UPDATE cursos  SET activo= '0' WHERE ID = '$id'";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta == false){
                    mysqli_error($conexion);
                }
            }
            ?>
                <meta http-equiv="refresh" content="1; url= adminCursos.php">
            <?php
        }

        //cambiar estado de profesor
        function estadoProfesor($id){
            $BBDD = 'infobdn';
            $conexion = conectar($BBDD);
            if ($conexion == false){
                mysqli_connect_error();
            }
            else{
                //generamos la query
                $sql = "SELECT * from profesores WHERE ID = $id";
                //la enviamos a la base de datos
            }    
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta == false){
                mysqli_error($conexion);
            }
            $numlineas = mysqli_num_rows($consulta);
            $linea = mysqli_fetch_array($consulta);
            if($linea[7] == 0){
                $sql = "UPDATE profesores  SET activo= '1' WHERE ID = '$id'";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta == false){
                    mysqli_error($conexion);
                }
            }
            else{
                $sql = "UPDATE profesores  SET activo= '0' WHERE ID = '$id'";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta == false){
                    mysqli_error($conexion);
                }
                //cuando un profesor se vuelve inactivo cambiamos los cursos en los que está a sinprofesor
                $consulta = buscaCursos($id);
                $i=0;
                $numlineas = mysqli_num_rows($consulta);
                while($i< $numlineas){
                    $linea = mysqli_fetch_array($consulta);
                    $sql = "UPDATE cursos  SET profesor = '1'";
                    $consulta = mysqli_query($conexion, $sql);
                    if ($consulta == false){
                        mysqli_error($conexion);
                    }
                    else{
                        $modificar = mysqli_query($conexion, $sql);
                    }
                    $i++;
                }
            }
            ?>
                <meta http-equiv="refresh" content="1; url= adminProf.php">
            <?php
        }

        //buscar cursos por id profesor
        function buscaCursos($id){
            $nombre = "infobdn";
            $conexion = conectar($nombre);
            if ($conexion == false){
                mysqli_connect_error();
            }
            else{
                //generamos la query
                $sql = "SELECT * from cursos WHERE profesor = '$id'";
                //la enviamos a la base de datos
            }
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta == false){
                mysqli_error($conexion);
            }
            return $consulta;
        }

        //consulta de matriculas
        function consultaMatriculas($usuario){
            $BBDD = 'infobdn';
            $conexion = conectar($BBDD);
            if ($conexion == false){
                mysqli_connect_error();
            }
            else{
                //generamos la query
                $sql = "SELECT cursos.ID, cursos.nombre, cursos.descripcion, cursos.duracion, cursos.inicio, cursos.final, cursos.profesor, matricula.nota from matricula inner join cursos on matricula.idCurso = cursos.ID where matricula.idAlumno = '$usuario'";
            }
            //la enviamos a la base de datos
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta == false){
                mysqli_error($conexion);
            }
            return $consulta;

        }

        //mostrar los cursos a los que se ha matriculado el alumno
        function alumnoMatriculas($matriculas){
            $numlineas = mysqli_num_rows($matriculas);
            echo "<h2> Cursos BDN </h2>";
            echo "<table>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Nombre curso</th>";
            echo "<th>Descripción</th>";
            echo "<th>Duración</th>";
            echo "<th>Inicio</th>";
            echo "<th>Final</th>";
            echo "<th>Profesor</th>";
            echo "<th> Nota </th>";
            echo "<th> Darse de baja </th>";
            echo "</tr>";
            foreach($matriculas as $curso => $campo){
                $id=$campo["ID"];
                echo "<tr>";
                foreach($campo as $dato){
                    echo "<td> $dato </td>";
                }
                echo "<td> <a href='alumnoFrontal.php?Numero=".$id."'> <img src='imagen/lapiz.png' width='50'></a> </td>";
                echo "</tr>";
            }
            echo "</table>";
        }

        //todos los cursos disponibles para el alumno
        function cursosDisponibles($BBDD, $id){
            $fecha_actual = date("Y-m-d");
            $conexion = conectar($BBDD);
            if ($conexion == false){
                mysqli_connect_error();
            }
            else{
                //generamos la query
                $sql = "SELECT * from cursos where $fecha_actual <= inicio and ID not in (select idCurso from matricula where idAlumno = $id)" ;
            }
            //la enviamos a la base de datos
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta == false){
                mysqli_error($conexion);
            }
            return $consulta;
        }

        //modificar alumno
        function modificarAlumno($BBDD,$id){
            $conexion = conectar($BBDD);
            if ($conexion == false){
                mysqli_connect_error();
            }
            else{
                //generamos la query
                $sql = "SELECT * from alumnos WHERE ID = $id";
                //la enviamos a la base de datos
            }    
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta == false){
                mysqli_error($conexion);
            }
        
            return $consulta;
        }

        //Los alumnos de los cursos en la tabla profesor
        function cursosProfesor($id){
            $BBDD = 'infobdn';
            $conexion = conectar($BBDD);
            if ($conexion == false){
                mysqli_connect_error();
            }
            else{
                //generamos la query
                $sql = "SELECT ID, nombre, inicio, final  from  cursos where profesor = '$id'";
            }
            //la enviamos a la base de datos
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta == false){
                mysqli_error($conexion);
            }
            return $consulta;

        }
        function tablaCursosProfesor($consulta, $nombre, $apellido){
            $fecha_actual = date("Y-m-d");
            $numlineas = mysqli_num_rows($consulta);
            echo "<h2> Cursos de $nombre $apellido</h2>";
            echo "<table>";
            echo "<tr>";
            echo "<th> Nombre </th>";
            echo "<th> Inicio </th>";
            echo "<th> Final </th>";
            echo "</tr>";
            $i=0;
            $numlineas = mysqli_num_rows($consulta);
            while($i< $numlineas){
                $linea = mysqli_fetch_array($consulta);
                $id = $linea[0];
                echo "<tr>";
                echo "<td> $linea[1] </td>";
                echo "<td> $linea[2] </td>";
                echo "<td> $linea[3] </td>";
                echo "<td> <a href='tablaCurso.php?Numero=".$id."'> <img src='imagen/lapiz.png' width='30'></a> </td>";
                /*
                if($fecha_actual >= $linea[3]){
                    echo "<td> <a href='tablaCurso.php?Numero=".$id."'> <img src='imagen/lapiz.png' width='30'></a> </td>";
                }
                else{
                    echo "<td> Pendiente </td>";
                }
                */
                echo "</tr>";
                $i++;
            }
            echo "</table>";
        }

        //busca los alumnos de un curso para el profesor
        function alumnosCurso($BBDD, $id){
            $conexion = conectar($BBDD);
            if ($conexion == false){
                mysqli_connect_error();
            }
            else{
                //generamos la query
                $sql = "SELECT cursos.nombre, alumnos.dni, alumnos.nombre, alumnos.apellido, alumnos.foto, matricula.nota, matricula.idAlumno, cursos.final from (alumnos inner join matricula on matricula.idAlumno = alumnos.ID) inner join cursos on matricula.idCurso = cursos.ID  WHERE matricula.idCurso = $id";
                //la enviamos a la base de datos
            }    
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta == false){
                mysqli_error($conexion);
            }
        
            return $consulta;
        }

        // tabla de los alumnos en el frontal del profesor
        function tablaAlumnos($consulta){
            $fecha_actual = date("Y-m-d");
            $numlineas = mysqli_num_rows($consulta);
            echo "<h2> Alumnos del curso </h2>";
            echo "<table>";
            echo "<tr>";
            echo "<th> DNI </th>";
            echo "<th> Nombre </th>";
            echo "<th> Apellido </th>";
            echo "<th> Foto </th>";
            echo "<th> Nota </th>";
            echo "</tr>";
            $i=0;
            $numlineas = mysqli_num_rows($consulta);
            while($i< $numlineas){
                $linea = mysqli_fetch_array($consulta);
                $id = $linea[6];
                $foto = $linea[4];
                echo "<tr>";
                echo "<td> $linea[1] </td>";
                echo "<td> $linea[2] </td>";
                echo "<td> $linea[3] </td>";
                echo "<td> <img width='50' height = '50' src = ".$foto." </td>";
                echo "<td> $linea[5] </td>";
                if($fecha_actual >= $linea[7]){
                    echo "<td> <a href='ponerNota.php?Numero=".$id."'> <img src='imagen/lapiz.png' width='30'></a> </td>";
                }
                else{
                    echo "<td> $linea[7] </td>";
                }
                echo "</tr>";
                $i++;
            }
            echo "</table>";

        }

        //comprobam mails de alumnos en el registro
        function comprobarMail($email){
            $correcto =0;
            $BBDD="infobdn";   
            $conexion = conectar($BBDD);
            if ($conexion == false){
                mysqli_connect_error();
            }
            else{
                //generamos la query para saber si está en la base de datos
                $sql = "SELECT * from alumnos where  mail = '$email'";
            }
            //la enviamos a la base de datos
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta == false){
                mysqli_error($conexion);
            }
            //si existe el mail le informamos que está registrado y lo devolvemos a registro
            if(mysqli_num_rows($consulta)>0){
                $correcto =0;
                echo 'Ese usuario ya está registrado';
                ?>
                <meta http-equiv="refresh" content="5; url= landpage.php">
                <?php
            }
            else{
                $correcto = 1;
            }
            return $correcto;
        }

        //estilo y maquetación

        //El encabezado de casi todas las páginas
        function encabezado(){
            ?>
            <header class="encabezado">
                <img alt="logo" src="imagen/Logo.png" width = "100px" heigth= "100px"/>
                <h1>INFOBDN, ENCANTADOS DE FORMARTE</h1>
                <a href="destruirSesion.php">
                    <button class="admin">Salir de la sesión.</button>
                </a>
            </header>   
            <?php 
        }

        //navegación en todas las páginas
        function navegacion(){
            if($_SESSION["rol"] == 2){
                ?>
                <nav class="menu">
                    <ul class="navlist">
                        <li><a href="consultarCursos.php">Cursos</a></li>
                        <li><a href="modificarAlumno.php">Editar perfil</a></li>
                        <li><a href="fotoAlumno.php">Foto</a></li>
                        <li><a href="alumnoFrontal.php">pagina principal</a></li>
                    </ul>
                </nav>
                <?php 
            }
            if($_SESSION["rol"] == 1){
                ?>
                <nav class="menu">
                    <ul>
                        <li><a href="admincursos.php">Cursos</a></li>
                        <li><a href="adminProf.php">Profesores</a></li>
                        <li><a href="anadirCurso.php">Añadir Curso</a></li>
                        <li><a href="anadirProfesor.php">Añadir Profesor</a></li>
                    </ul>
                </nav>
                <?php
            }
            if($_SESSION["rol"] == 3){
                echo "<nav class='menu'>";
                    echo  "<ul>";
                        echo "<li><a href='profesorFrontal.php'> volver a página principal </a></li>";
                    echo  "</ul>";
                echo "</nav>";
            }
        }
        // el footer de todas las páginas
        function footer(){
            ?>
            <footer class="pie">
                <ul class="soluciones">
                    <li>Soluciones</li>
                    <li><a href="particulares.php">Particulares</a></li>
                    <li><a href="empresas.php">Empresas</a></li>
                    <li><a href="centros.php">Centros Educativos</a></li>
                </ul>
                <ul class="acerca">
                    <li>Acerca de </li>
                    <li><a href="nosotros.php">Nosotros</a></li>
                    <li><a href="aviso.php">Aviso Legal</a></li>
                    <li><a href="privacidad.php">recursos</a></li>
                </ul>
            </footer>   
            <?php 
        }
        function borrarCurso($eliminar,$conexion){
            $sql = "DELETE FROM matricula WHERE idCurso = $eliminar";
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta == false){
                mysqli_error($conexion);
            }
            else{
                mysqli_query($conexion, $sql);
            }
            ?>
                <meta http-equiv="refresh" content="1; url= alumnoFrontal.php">
            <?php
        }

    ?>

</body>