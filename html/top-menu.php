<?php
include("config/database.php");

// Iniciar la sesión si no se ha iniciado antes
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si la sesión contiene la variable 'id_user'
if (isset($_SESSION['id_user'])) {
    // Escapar la variable para evitar problemas de seguridad
    $id_user = (int) $_SESSION['id_user']; // Convertir a entero por seguridad

    // Preparar la consulta
    $stmt = $mysqli->prepare("SELECT id_user, name_user, foto, permisos_acceso FROM usuarios WHERE id_user = ?");
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se obtuvieron datos
    if ($data = $result->fetch_assoc()) {
        ?>
        <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                <div class="avatar avatar-online">
                    <img src="<?php echo ($data['foto'] == "") ? 'images/user/mi-perfil.jpeg' : 'images/user/' . $data['foto']; ?>" 
                         alt="Imagen de usuario" class="w-px-40 h-auto rounded-circle" />
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="#">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar avatar-online">
                                    <img src="<?php echo ($data['foto'] == "") ? 'images/user/mi-perfil.jpeg' : 'images/user/' . $data['foto']; ?>" 
                                         alt="Imagen de usuario" class="w-px-40 h-auto rounded-circle" />
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <span class="fw-semibold d-block"><?php echo $data['name_user']; ?></span>
                                <small class="text-muted"><?php echo ucfirst($data['permisos_acceso']); ?></small>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <a class="dropdown-item" href="?module=perfil">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">Mi Perfil</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Ajustes</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                        <span class="d-flex align-items-center align-middle">
                            <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                            <span class="flex-grow-1 align-middle">Facturación</span>
                            <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                        </span>
                    </a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
    <a class="dropdown-item" href="#" onclick="confirmLogout(event)">
        <i class="bx bx-power-off me-2"></i>
        <span class="align-middle">Cerrar Sesión</span>
    </a>
</li>
            </ul>
        </li>
        <?php
    } else {
        echo "<p>Error: Usuario no encontrado.</p>";
    }
} else {
    echo "<p>Error: Usuario no identificado.</p>";
}
?>
