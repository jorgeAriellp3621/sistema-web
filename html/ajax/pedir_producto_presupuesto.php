<?php
require_once '../config/database.php';

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
    // Verificar si 'x' está presente en la solicitud antes de usarlo
    $x = isset($_REQUEST['x']) ? mysqli_real_escape_string($mysqli, strip_tags($_REQUEST['x'], ENT_QUOTES)) : '';

    $aColumns = array('cod_producto', 'cod_tipo_prod', 'p_descrip', 'precio');
    $sTable = "producto";
    $sWhere = "";
    
    // Asegurarse de que 'x' no esté vacío antes de agregar la condición WHERE
    if($x != ""){
        $sWhere = "WHERE (";
        for ($i = 0; $i < count($aColumns); $i++) {
            $sWhere .= $aColumns[$i] . " LIKE '%" . $x . "%' OR ";
        }
        $sWhere = substr_replace($sWhere, "", -3); // Eliminar el último "OR"
        $sWhere .= ')';
    }

    // Paginación
    include 'paginacion.php';
    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $per_page = 5;
    $adjacents = 4;
    $offset = ($page - 1) * $per_page;

    $count_query = mysqli_query($mysqli, "SELECT count(*) AS numrows FROM $sTable $sWhere");
    $row = mysqli_fetch_array($count_query);
    $numrows = $row['numrows'];
    $total_pages = ceil($numrows / $per_page);
    $reload = './index.php';

    $sql = "SELECT * FROM $sTable $sWhere LIMIT $offset, $per_page";
    $query = mysqli_query($mysqli, $sql);

    if ($numrows > 0) { ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="bg-light">
                    <tr class="text-center">
                        <th>Código</th>
                        <th>Tipo Producto</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Seleccionar</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                while ($row = mysqli_fetch_array($query)) {
                    $id_producto = $row['cod_producto'];
                    $descrip_producto = $row['p_descrip'];
                    $codigo_tproducto = $row['cod_tipo_prod'];
                    $sql_tproducto = mysqli_query($mysqli, "SELECT t_p_descrip FROM tipo_producto WHERE cod_tipo_prod='$codigo_tproducto'");
                    $rw_tproducto = mysqli_fetch_array($sql_tproducto);
                    $tproducto_nombre = $rw_tproducto['t_p_descrip'];

                    $precio_venta = $row['precio'];
                    $precio_final = $precio_venta;
                ?>
                <tr>
                    <td class="text-center"><?php echo $id_producto; ?></td>
                    <td><?php echo $tproducto_nombre; ?></td>
                    <td><?php echo $descrip_producto; ?></td>
                    <td class="col-xs-1">
                        <div class="input-group">
                            <input type="text" class="form-control text-end" id="cantidad_<?php echo $id_producto;?>" value="1">
                        </div>
                    </td>
                    <td class="col-xs-2">
                        <div class="input-group">
                            <input type="text" class="form-control text-end" id="precio_venta_<?php echo $id_producto;?>" value="<?php echo $precio_final?>">
                        </div>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-success" onclick="agregar('<?php echo $id_producto; ?>')">
                            <i class="bi bi-plus-circle"></i>
                        </button>
                    </td>
                </tr>    
                <?php }
                ?>
                <tr>
                    <td colspan="6" class="text-center">
                        <div>
                            <?php echo paginate($reload, $page, $total_pages, $adjacents);?>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    <?php }
}
?>
