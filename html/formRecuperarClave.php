<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger">
        <?php
        if ($_GET['error'] == 1) {
            echo "El correo ingresado no está registrado.";
        } elseif ($_GET['error'] == 2) {
            echo "Por favor, ingrese un correo válido.";
        }
        ?>
    </div>
<?php elseif (isset($_GET['success'])): ?>
    <div class="alert alert-success">
        Se ha enviado una nueva contraseña a tu correo.
    </div>
<?php endif; ?>
