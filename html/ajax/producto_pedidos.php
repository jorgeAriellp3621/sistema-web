<div class="container">
    <?php 
    require_once '../config/database.php';

    $action = isset($_REQUEST['action']) && $_REQUEST['action'] != NULL ? $_REQUEST['action'] : '';

    if ($action == 'ajax') {
        // Validar la existencia del parámetro 'x'
        $x = isset($_REQUEST['x']) ? mysqli_real_escape_string($mysqli, strip_tags($_REQUEST['x'])) : '';

        $aColumns = array('cod_producto', 'cod_tipo_prod', 'id_u_medida', 'p_descrip', 'precio');
        $sTable = "producto";
        $sWhere = "";

        if (!empty($x)) {
            $sWhere = "WHERE (";
            foreach ($aColumns as $col) {
                $sWhere .= "$col LIKE '%$x%' OR ";
            }
            $sWhere = substr_replace($sWhere, "", -3) . ')';
        }

        // Paginación
        include 'paginacion.php';
        $page = isset($_REQUEST['page']) && !empty($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
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
                <table class="table table-bordered table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>Código</th>
                            <th>Tip. Producto</th>
                            <th>Unid. Medida</th>
                            <th>Producto</th>
                            <th class="text-end">Cantidad</th>
                            <th class="text-end">Precio</th>
                            <th class="text-center">Seleccionar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        while ($row = mysqli_fetch_array($query)) {
                            $id_producto = $row['cod_producto'];
                            $descrip_producto = $row['p_descrip'];

                            // Obtener tipo de producto
                            $codigo_tproducto = $row['cod_tipo_prod'];
                            $sql_tproducto = mysqli_query($mysqli, "SELECT t_p_descrip FROM tipo_producto WHERE cod_tipo_prod='$codigo_tproducto'");
                            $rw_tproducto = mysqli_fetch_array($sql_tproducto);
                            $tproducto_nombre = $rw_tproducto['t_p_descrip'] ?? 'N/A';

                            // Obtener unidad de medida
                            $id_u_medida = $row['id_u_medida'];
                            $sql_umedida = mysqli_query($mysqli, "SELECT u_descrip FROM u_medida WHERE id_u_medida='$id_u_medida'");
                            $rw_umedida = mysqli_fetch_array($sql_umedida);
                            $u_medida_nombre = $rw_umedida['u_descrip'] ?? 'N/A';

                            $precio_compra = $row['precio'];
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($id_producto); ?></td>
                                <td><?php echo htmlspecialchars($tproducto_nombre); ?></td>
                                <td><?php echo htmlspecialchars($u_medida_nombre); ?></td>
                                <td><?php echo htmlspecialchars($descrip_producto); ?></td>
                                <td class="col-xs-2 text-end">
                                    <input type="text" class="form-control text-end" id="cantidad_<?php echo htmlspecialchars($id_producto); ?>" value="1">
                                </td>
                                <td class="col-xs-2 text-end">
                                    <input type="text" class="form-control text-end" id="precio_compra_<?php echo htmlspecialchars($id_producto); ?>" value="<?php echo htmlspecialchars($precio_compra); ?>">
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-success" onclick="agregar('<?php echo htmlspecialchars($id_producto); ?>')">
                                        <i class="glyphicon glyphicon-plus"></i> Agregar
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between">
                <span class="text-muted">Mostrando <?php echo htmlspecialchars($page); ?> de <?php echo htmlspecialchars($total_pages); ?> páginas.</span>
                <?php echo paginate($reload, $page, $total_pages, $adjacents); ?>
            </div>
        <?php 
        } else {
            echo "<div class='alert alert-warning text-center'>No se encontraron resultados.</div>";
        }
    }
    ?>
</div>
