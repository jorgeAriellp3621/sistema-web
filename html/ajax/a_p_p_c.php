<?php 
session_start();
$session_id = session_id();
if(isset($_POST['id'])) { $id = $_POST['id']; }
if(isset($_POST['cantidad'])) { $cantidad = $_POST['cantidad']; }

require_once '../config/database.php';

if(!empty($id) && !empty($cantidad)) {
    $insert_tmp = mysqli_query($mysqli, "INSERT INTO tmp (id_producto, cantidad_tmp, session_id) 
    VALUES('$id', '$cantidad', '$session_id')");
}
if(isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $delete = mysqli_query($mysqli, "DELETE FROM tmp WHERE id_tmp='" . $id . "'");
}
?>
<table class="table table-bordered table-hover table-responsive">
    <thead class="table-warning">
        <tr>
            <th>Código</th>
            <th>Tipo de Producto</th>
            <th>Producto</th>
            <th class="text-end">Cantidad</th>
            <th style="width: 36px;">Acción</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $sql = mysqli_query($mysqli, "SELECT * FROM producto, tmp WHERE producto.cod_producto=tmp.id_producto AND tmp.session_id='$session_id'");
        while($row = mysqli_fetch_array($sql)) {
            $id_tmp = $row['id_tmp'];
            $codigo_producto = $row['cod_producto'];
            $descrip_producto = $row['p_descrip'];
            $cantidad = $row['cantidad_tmp'];

            $codigo_tproducto = $row['cod_tipo_prod'];
            $sql_tproducto = mysqli_query($mysqli, "SELECT t_p_descrip FROM tipo_producto WHERE cod_tipo_prod='$codigo_tproducto'");
            $rw_tproducto = mysqli_fetch_array($sql_tproducto);
            $tproducto_nombre = $rw_tproducto['t_p_descrip'];
        ?>
        <tr>
            <td><?php echo $codigo_producto; ?></td>
            <td><?php echo $tproducto_nombre; ?></td>
            <td><?php echo $descrip_producto; ?></td>
            <td class="text-end"><?php echo $cantidad; ?></td>
            <td class="text-end">
                <a href="#" onclick="eliminar('<?php echo $id_tmp; ?>')" class="btn btn-sm btn-danger">
                    <i class="bx bx-trash"></i>
                </a>
            </td>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="5">
                <input type="hidden" name="cantidad" value="<?php echo !empty($cantidad) ? $cantidad : 0; ?>">
            </td>
        </tr>
    </tbody>
</table>
