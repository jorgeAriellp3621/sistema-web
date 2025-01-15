
<!-- menu lateral izquierdo -->
<?php 

if($_SESSION['permisos_acceso'] == 'Super Admin') { ?>

    <ul>
        <li>
            Menú</li>

        <?php 
            $active_home = ""; // Inicializa la variable
            $active_user = "";
            $active_password = "";

            // Verifica si "module" está definido en $_GET
            if(isset($_GET["module"]) && $_GET["module"] == "start") {
                $active_home = "active";
            }
            if(isset($_GET["module"]) && ($_GET["module"] == "user" || $_GET["module"] == "form_user")) {
                $active_user = "active";
            }
            if(isset($_GET["module"]) && $_GET["module"] == "password") {
                $active_password = "active";
            }
        ?>
        
        <li class="<?php echo $active_home; ?>">
            <a href="?module=start"><i class="menu-icon tf-icons bx bx-home-circle"></i> Inicio</a>
        </li>

                <!-- Referenciales Generales -->
        <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-layout"></i>
            <div data-i18n="Referenciales Generales">Referenciales Generales</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="?module=departamento" class="menu-link">
                <div data-i18n="Departamento">Departamento</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="?module=ciudad" class="menu-link">
                <div data-i18n="Ciudad">Ciudad</div>
              </a>
            </li>
          </ul>
        </li>

        <!-- Referenciales de Compras -->
        <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-file"></i>
            <div data-i18n="Referenciales de Compras">Referenciales de Compras</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="?module=deposito" class="menu-link">
                <div data-i18n="Depósito">Depósito</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="?module=proveedor" class="menu-link">
                <div data-i18n="Proveedor">Proveedor</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="?module=tipo_producto" class="menu-link">
                <div data-i18n="Tipo Producto">Tipo Producto</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="?module=producto" class="menu-link">
                <div data-i18n="Producto">Producto</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="?module=u_medida" class="menu-link">
                <div data-i18n="Unidad de Medida">Unidad de Medida</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="?module=pedido_compra" class="menu-link">
                <div data-i18n="Pedido Compra">Pedido Compra</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="?module=presupuesto_compra" class="menu-link">
                <div data-i18n="Pedido Compra">Presupuesto Compra</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="?module=orden_compra" class="menu-link">
                <div data-i18n="Orden Compra">Orden Compra</div>
              </a>
            </li>
          </ul>
        </li>

        <!-- Referenciales de Ventas -->
        <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-credit-card"></i>
            <div data-i18n="Referenciales de Ventas">Referenciales de Ventas</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="?module=clientes" class="menu-link">
                <div data-i18n="Clientes">Clientes</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="?module=cajas" class="menu-link">
                <div data-i18n="cajas">Cajas</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="?module=caja_apertura_cierre" class="menu-link">
                <div data-i18n="caja_apertura_cierre">Caja Apertura/Cierre</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="?module=nota_creddeb" class="menu-link">
                <div data-i18n="nota_creddeb">Nota Cred/Deb</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="?module=nota_remision" class="menu-link">
                <div data-i18n="nota_remision">Nota Remision</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="?module=marcas" class="menu-link">
                <div data-i18n="marcas">Marcas</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="?module=movil" class="menu-link">
                <div data-i18n="movil">Movil</div>
              </a>
            </li>
          </ul>
        </li>

        <!-- Administrar Usuarios -->
        <li class="menu-item <?php echo $active_user; ?>">
          <a href="?module=user" class="menu-link">
            <i class="menu-icon tf-icons bx bx-user"></i>
            <div data-i18n="Administrar Usuarios">Administrar Usuarios</div>
          </a>
        </li>

      <!-- Informes -->
      <li class="menu-item ">
        <a href="?module=informes" class="menu-link">
          <i class="menu-icon tf-icons bx bx-file"></i>
          <div data-i18n="Informes">Informes</div>
        </a>
      </li>

<!-- Cambiar Contraseña -->
<li class="menu-item <?php echo $active_password; ?>">
  <a href="?module=password" class="menu-link">
    <i class="menu-icon tf-icons bx bx-lock"></i>
    <div data-i18n="Cambiar Contraseña">Cambiar Contraseña</div>
  </a>
</li>


    </ul>

<?php }elseif($_SESSION['permisos_acceso'] == 'Compras') { ?>

<ul>
    <li>
        Menú</li>

    <?php 
        $active_home = ""; // Inicializa la variable
        $active_user = "";
        $active_password = "";

        // Verifica si "module" está definido en $_GET
        if(isset($_GET["module"]) && $_GET["module"] == "start") {
            $active_home = "active";
        }
        if(isset($_GET["module"]) && ($_GET["module"] == "user" || $_GET["module"] == "form_user")) {
            $active_user = "active";
        }
        if(isset($_GET["module"]) && $_GET["module"] == "password") {
            $active_password = "active";
        }
    ?>
    
    <li class="<?php echo $active_home; ?>">
        <a href="?module=start"><i class="menu-icon tf-icons bx bx-home-circle"></i> Inicio</a>
    </li>

    <!-- Referenciales Generales -->
<li class="menu-item">
<a href="javascript:void(0);" class="menu-link menu-toggle">
<i class="menu-icon tf-icons bx bx-layout"></i>
<div data-i18n="Referenciales Generales">Referenciales Generales</div>
</a>
<ul class="menu-sub">
<li class="menu-item">
  <a href="?module=departamento" class="menu-link">
    <div data-i18n="Departamento">Departamento</div>
  </a>
</li>
<li class="menu-item">
  <a href="?module=ciudad" class="menu-link">
    <div data-i18n="Ciudad">Ciudad</div>
  </a>
</li>
</ul>
</li>

<!-- Referenciales de Compras -->
<li class="menu-item">
<a href="javascript:void(0);" class="menu-link menu-toggle">
<i class="menu-icon tf-icons bx bx-file"></i>
<div data-i18n="Referenciales de Compras">Referenciales de Compras</div>
</a>
<ul class="menu-sub">
<li class="menu-item">
  <a href="?module=deposito" class="menu-link">
    <div data-i18n="Depósito">Depósito</div>
  </a>
</li>
<li class="menu-item">
  <a href="?module=proveedor" class="menu-link">
    <div data-i18n="Proveedor">Proveedor</div>
  </a>
</li>
<li class="menu-item">
  <a href="?module=tipo_producto" class="menu-link">
    <div data-i18n="Tipo Producto">Tipo Producto</div>
  </a>
</li>
<li class="menu-item">
  <a href="?module=producto" class="menu-link">
    <div data-i18n="Producto">Producto</div>
  </a>
</li>
<li class="menu-item">
  <a href="?module=u_medida" class="menu-link">
    <div data-i18n="Unidad de Medida">Unidad de Medida</div>
  </a>
</li>
<li class="menu-item">
  <a href="?module=pedido_compra" class="menu-link">
    <div data-i18n="Pedido Compra">Pedido Compra</div>
  </a>
</li>
<li class="menu-item">
  <a href="?module=presupuesto_compra" class="menu-link">
    <div data-i18n="Pedido Compra">Presupuesto Compra</div>
  </a>
</li>
<li class="menu-item">
  <a href="?module=orden_compra" class="menu-link">
    <div data-i18n="Orden Compra">Orden Compra</div>
  </a>
</li>
</ul>
</li>



<!-- Cambiar Contraseña -->
<li class="menu-item <?php echo $active_password; ?>">
<a href="?module=password" class="menu-link">
<i class="menu-icon tf-icons bx bx-lock"></i>
<div data-i18n="Cambiar Contraseña">Cambiar Contraseña</div>
</a>
</li>


</ul>
<?php }elseif($_SESSION['permisos_acceso'] == 'Ventas') { ?>

<ul>
    <li>
        Menú</li>

    <?php 
        $active_home = ""; // Inicializa la variable
        $active_user = "";
        $active_password = "";

        // Verifica si "module" está definido en $_GET
        if(isset($_GET["module"]) && $_GET["module"] == "start") {
            $active_home = "active";
        }
        if(isset($_GET["module"]) && ($_GET["module"] == "user" || $_GET["module"] == "form_user")) {
            $active_user = "active";
        }
        if(isset($_GET["module"]) && $_GET["module"] == "password") {
            $active_password = "active";
        }
    ?>
    
    <li class="<?php echo $active_home; ?>">
        <a href="?module=start"><i class="menu-icon tf-icons bx bx-home-circle"></i> Inicio</a>
    </li>

    <!-- Referenciales Generales -->
<li class="menu-item">
<a href="javascript:void(0);" class="menu-link menu-toggle">
<i class="menu-icon tf-icons bx bx-layout"></i>
<div data-i18n="Referenciales Generales">Referenciales Generales</div>
</a>
<ul class="menu-sub">
<li class="menu-item">
  <a href="?module=departamento" class="menu-link">
    <div data-i18n="Departamento">Departamento</div>
  </a>
</li>
<li class="menu-item">
  <a href="?module=ciudad" class="menu-link">
    <div data-i18n="Ciudad">Ciudad</div>
  </a>
</li>
</ul>
</li>



<!-- Referenciales de Ventas -->
<li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-credit-card"></i>
            <div data-i18n="Referenciales de Ventas">Referenciales de Ventas</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="?module=clientes" class="menu-link">
                <div data-i18n="Clientes">Clientes</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="?module=cajas" class="menu-link">
                <div data-i18n="cajas">Cajas</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="?module=caja_apertura_cierre" class="menu-link">
                <div data-i18n="caja_apertura_cierre">Caja Apertura/Cierre</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="?module=nota_creddeb" class="menu-link">
                <div data-i18n="nota_creddeb">Nota Cred/Deb</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="?module=nota_remision" class="menu-link">
                <div data-i18n="nota_remision">Nota Remision</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="?module=marcas" class="menu-link">
                <div data-i18n="marcas">Marcas</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="?module=movil" class="menu-link">
                <div data-i18n="movil">Movil</div>
              </a>
            </li>
          </ul>
        </li>



      <!-- Cambiar Contraseña -->
      <li class="menu-item <?php echo $active_password; ?>">
        <a href="?module=password" class="menu-link">
          <i class="menu-icon tf-icons bx bx-lock"></i>
          <div data-i18n="Cambiar Contraseña">Cambiar Contraseña</div>
        </a>
      </li>


</ul>
<?php 
}
?>
