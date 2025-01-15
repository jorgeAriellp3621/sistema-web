<?php 
require "config/database.php";

if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
} else {
    // Comprobamos si el parámetro 'module' está definido en $_GET
    $module = isset($_GET['module']) ? $_GET['module'] : null;

    if ($module == "start") {
        include "modules/start/view.php";
    } elseif ($module == "password") {
        include "modules/password/view.php";
    } elseif ($module == "user") {
        include "modules/user/view.php";
    } elseif ($module == "form") {
        include "modules/user/form.php";
    } elseif ($module == "perfil") {
        include "modules/perfil/view.php";
    } elseif ($module == "form_perfil") {
        include "modules/perfil/form.php";
    }
    elseif ($module == "departamento") {
        include "modules/departamento/view.php";
    } elseif ($module == "form_departamento") {
        include "modules/departamento/form.php";
    }
    elseif ($module == "ciudad") {
        include "modules/ciudad/view.php";
    } elseif ($module == "form_ciudad") {
        include "modules/ciudad/form.php";
    }
    elseif ($module == "clientes") {
        include "modules/clientes/view.php";
    } elseif ($module == "form_clientes") {
        include "modules/clientes/form.php";
    }
    elseif ($module == "compras") {
        include "modules/compras/view.php";
    } elseif ($module == "form_compras") {
        include "modules/compras/form.php";
    }
    elseif ($module == "ventas") {
        include "modules/ventas/view.php";
    } elseif ($module == "form_ventas") {
        include "modules/ventas/form.php";
    }
    elseif ($module == "deposito") {
        include "modules/deposito/view.php";
    } elseif ($module == "form_deposito") {
        include "modules/deposito/form.php";
    }
    elseif ($module == "u_medida") {
        include "modules/u_medida/view.php";
    } elseif ($module == "form_u_medida") {
        include "modules/u_medida/form.php";
    }
    elseif ($module == "tipo_producto") {
        include "modules/tipo_producto/view.php";
    } elseif ($module == "form_tipo_producto") {
        include "modules/tipo_producto/form.php";
    }
    elseif ($module == "proveedor") {
        include "modules/proveedor/view.php";
    } elseif ($module == "form_proveedor") {
        include "modules/proveedor/form.php";
    }
    elseif ($module == "producto") {
        include "modules/producto/view.php";
    } elseif ($module == "form_producto") {
        include "modules/producto/form.php";
    }
    elseif ($module == "stock") {
        include "modules/stock/view.php";
    } elseif ($module == "form_stock") {
        include "modules/stock/form.php";
    }
    elseif ($module == "pedido_compra") {
        include "modules/pedido_compra/view.php";
    } elseif ($module == "form_pedido_compra") {
        include "modules/pedido_compra/form.php";
    }
    elseif ($module == "presupuesto_compra") {
        include "modules/presupuesto_compra/view.php";
    } elseif ($module == "form_presupuesto_compra") {
        include "modules/presupuesto_compra/form.php";
    }
    elseif ($module == "orden_compra") {
        include "modules/orden_compra/view.php";
    } elseif ($module == "form_orden_compra") {
        include "modules/orden_compra/form.php";
    }
    elseif ($module == "caja_apertura_cierre") {
        include "modules/caja_apertura_cierre/view.php";
    } elseif ($module == "form_caja_apertura_cierre") {
        include "modules/caja_apertura_cierre/form.php";
    }
    elseif ($module == "cajas") {
        include "modules/cajas/view.php";
    } elseif ($module == "form_cajas") {
        include "modules/cajas/form.php";
    }
    elseif ($module == "nota_creddeb") {
        include "modules/nota_creddeb/view.php";
    } elseif ($module == "form_nota_creddeb") {
        include "modules/nota_creddeb/form.php";
    }
    elseif ($module == "marcas") {
        include "modules/marcas/view.php";
    } elseif ($module == "form_marcas") {
        include "modules/marcas/form.php";
    }
    elseif ($module == "movil") {
        include "modules/movil/view.php";
    } elseif ($module == "form_movil") {
        include "modules/movil/form.php";
    }
    elseif ($module == "informes") {
        include "modules/informes/view.php";
    }
    elseif ($module == "informe_venta") {
        include "modules/informe_venta/informe_ventas.php";
        include "modules/informe_venta/procesar_ventas.php";
    }
    elseif ($module == "informe_compra") {
        include "modules/informe_compra/informe_compras.php";
        include "modules/informe_compra/procesar_compras.php";
    }
    elseif ($module == "informe_pedido") {
        include "modules/informe_pedido/informe_pedidos.php";
        include "modules/informe_pedido/procesar_pedidos.php";
    }
    elseif ($module == "informe_presupuesto") {
        include "modules/informe_presupuesto/informe_presupuestos.php";
        include "modules/informe_presupuesto/procesar_presupuestos.php";
    }
    elseif ($module == "informe_orden") {
        include "modules/informe_orden/informe_ordenes.php";
        include "modules/informe_orden/procesar_ordenes.php";
    }
    elseif ($module == "informe_caja") {
        include "modules/informe_caja/informe_cajas.php";
        include "modules/informe_caja/procesar_cajas.php";
    }
    elseif ($module == "nota_remision") {
        include "modules/nota_remision/view.php";
    } elseif ($module == "form_nota_remision") {
        include "modules/nota_remision/form.php";
    }
    
    
}


?>
