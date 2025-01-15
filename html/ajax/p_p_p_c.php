<?php
require_once '../config/database.php';

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
if ($action == 'ajax') {
    // Validar si 'x' está definido y no es NULL
    $x = isset($_REQUEST['x']) ? mysqli_real_escape_string($mysqli, strip_tags($_REQUEST['x'])) : '';
    $aColumns = array('cod_producto', 'cod_tipo_prod', 'p_descrip');
    $sTable = "producto";
    $sWhere = "";
    
    // Verificar si $x no está vacío
    if (!empty($x)) {
        $sWhere = "WHERE (";
        for ($i = 0; $i < count($aColumns); $i++) {
            $sWhere .= $aColumns[$i] . " LIKE '%" . $x . "%' OR ";
        }
        $sWhere = substr_replace($sWhere, "", -3);
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
                <tr class="warning">
                    <th class='center'>Código</th>
                    <th class='center'>Tipo Producto</th>
                    <th class='center'>Producto</th>
                    <th><span class="pull-right">Cantidad</span></th>
                    <th style="width:36px;">Seleccionar</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_array($query)) {
                    $id_producto = $row['cod_producto'];
                    $descrip_producto = $row['p_descrip'];
                    $codigo_tproducto = $row['cod_tipo_prod'];
                    $sql_tproducto = mysqli_query($mysqli, "SELECT t_p_descrip FROM tipo_producto WHERE cod_tipo_prod='$codigo_tproducto'");
                    $rw_tproducto = mysqli_fetch_array($sql_tproducto);
                    $tproducto_nombre = $rw_tproducto['t_p_descrip'];
                    ?>
                    <tr>
                        <td class='center'><?php echo $id_producto; ?></td>
                        <td class='center'><?php echo $tproducto_nombre; ?></td>
                        <td class='center'><?php echo $descrip_producto; ?></td>
                        <td class="col-xs-1">
                            <div class="pull-right">
                                <input type="text" class="form-control" style="text-align:right" id="cantidad_<?php echo $id_producto; ?>" value="1">
                            </div>
                        </td>
                        <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-success" onclick="agregar('<?php echo htmlspecialchars($id_producto); ?>')">
                                        <i class="glyphicon glyphicon-plus"></i> Agregar
                                    </a>
                                </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan=5>
                        <span class="pull-right">
                            <?php echo paginate($reload, $page, $total_pages, $adjacents); ?>
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    <?php }
}
?>
