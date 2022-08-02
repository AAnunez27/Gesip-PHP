
<nav>
    <div class='nav-wrapper white' id='barra'>
        <a href='../menu.php' class='brand-logo'><img src='../IMG/Logo.png' alt='logo' id /></a>
        <ul id='nav-mobile' class='right hide-on-med-and-down '>

            <!-- Dropdown 1 -->
            <li><a class='dropdown-trigger grey-text text-darken-3' href='#!' data-target='dropdown1'>Usuarios<i class='material-icons right'>arrow_drop_down</i></a></li>
            <!--Estructura Dropdown -->
            <ul id='dropdown1' class='dropdown-content'>
                <li><a href='../Usuarios/registrar_usuarios.php' class='grey-text text-darken-3 modal-trigger'>Registrar
                        Usuarios</a></li>
                <li><a href='../Usuarios/listar_usuario.php' class='grey-text text-darken-3'>Listar Usuarios</a></li>
            </ul>
            <!-- Dropdown 2 -->
            <li><a class='dropdown-trigger grey-text text-darken-3' href='#!' data-target='dropdown2'>Dispositivos<i class='material-icons right'>arrow_drop_down</i></a></li>
            <!--Estructura Dropdown -->
            <ul id='dropdown2' class='dropdown-content'>
                <li><a href='../Dispositivos/agregar_dispositivos.php' class='grey-text text-darken-3'>Agregar
                        Dispositivos</a></li>
                <li><a href='../Dispositivos/listar_dispositivos.php' class='grey-text text-darken-3'>Listar
                        Dispositivos</a></li>
            </ul>
            <!-- Dropdown 3 -->
            <li><a class='dropdown-trigger grey-text text-darken-3' href='#!' data-target='dropdown3'>Asignaciones<i class='material-icons right'>arrow_drop_down</i></a></li>
            <!--Estructura Dropdown -->
            <ul id='dropdown3' class='dropdown-content'>
                <li><a href='../Asignaciones/asignar_dispositivos.php' class='grey-text text-darken-3'>Asignar
                        Dispositivos</a></li>
                <li><a href='../Asignaciones/listar_asignaciones.php' class='grey-text text-darken-3'>Listar
                        Asignaciones</a></li>
            </ul>
            <!-- Menu -->
            <li><a href='../menu.php' class='grey-text text-darken-3'><i class='material-icons left'>home</i></a></li>
            <!-- Dropdown 4 -->
            <li><a class='dropdown-trigger grey-text text-darken-3' href='#!' data-target='dropdown4'><i class='material-icons'>person</i></a></li>
            <!--Estructura Dropdown -->
            <ul id='dropdown4' class='dropdown-content'>
                <li><a href='../Usuarios/perfil_usuario.php' class='grey-text text-darken-3'>Perfil de Usuario</a></li>
                <li><a href='../cerrar.php' class='grey-text text-darken-3'>Cerrar Sesión</a></li>               
            </ul>

        </ul>
    </div>
</nav>