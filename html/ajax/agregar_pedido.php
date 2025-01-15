<?php 
session_start();
$session_id=session_id();
if(isset($_POST['id'])){$id=$_POST['id'];}
if(isset($_POST['cantidad'])){$cantidad = $_POST['cantidad'];}
if(isset($_POST['precio_compra_'])){$precio_compra_ = $_POST['precio_compra_'];}

require_once '../config/database.php';

if(!empty($id) and !empty($cantidad) and !empty($precio_compra_)){
    $insert_tmp = mysqli_query($mysqli, "INSERT INTO tmp (id_producto, cantidad_tmp, precio_tmp, session_id) 
    VALUES('$id', '$cantidad', '$precio_compra_','$session_id')");
}
if(isset($_GET['id'])){
    $id= intval($_GET['id']);
    $delete = mysqli_query($mysqli, "DELETE FROM tmp WHERE id_tmp='".$id."'");
}
?>

<table class="table table-bordered table-striped table-hover">
    <tr class="warning">
        <th>Código:</th>
        <th>Tipo Producto:</th>
        <th>Unidad Medida:</th>
        <th>Producto:</th>
        <th><span class="pull-right">Cantidad:</span></th>
        <th><span class="pull-right">Precio:</span></th>
        <th style="width: 36px;">Eliminar:</th>
    </tr>

    <?php 
    $suma_total = 0;

    // Consulta para obtener los datos de producto y temporales
    $sql = mysqli_query($mysqli, "
        SELECT 
            tmp.id_tmp, tmp.id_producto AS cod_producto, tmp.cantidad_tmp, tmp.precio_tmp,
            producto.p_descrip, producto.cod_tipo_prod, producto.id_u_medida
        FROM 
            producto, tmp 
        WHERE 
            producto.cod_producto = tmp.id_producto 
            AND tmp.session_id = '".$session_id."'"
    );

    while ($row = mysqli_fetch_array($sql)) {
        $id_tmp = $row['id_tmp'];
        $codigo_producto = $row['cod_producto'];
        $descrip_producto = $row['p_descrip'];
        $cantidad = $row['cantidad_tmp'];

        // Obtener descripción del tipo de producto
        $codigo_tproducto = $row['cod_tipo_prod'];
        $sql_tproducto = mysqli_query($mysqli, "SELECT t_p_descrip FROM tipo_producto WHERE cod_tipo_prod = '$codigo_tproducto'");
        $rw_tproducto = mysqli_fetch_array($sql_tproducto);
        $tproducto_nombre = $rw_tproducto['t_p_descrip'];

        // Obtener unidad de medida
        $id_u_medida = $row['id_u_medida'];
        $sql_umedida = mysqli_query($mysqli, "SELECT u_descrip FROM u_medida WHERE id_u_medida = '$id_u_medida'");
        $rw_umedida = mysqli_fetch_array($sql_umedida);
        $u_medida_nombre = $rw_umedida['u_descrip'];

        // Calcular precios
        $precio_compra_ = $row['precio_tmp'];
        $precio_total = $precio_compra_ * $cantidad;

        // Formatear valores
        $precio_total_f = number_format($precio_total, 0, ',', '.');
        $suma_total += $precio_total; // Acumulador total
        ?>

        <tr>
            <td><?php echo htmlspecialchars($codigo_producto); ?></td>
            <td><?php echo htmlspecialchars($tproducto_nombre); ?></td>
            <td><?php echo htmlspecialchars($u_medida_nombre); ?></td>
            <td><?php echo htmlspecialchars($descrip_producto); ?></td>
            <td class="text-center"><?php echo htmlspecialchars($cantidad); ?></td>
            <td class="text-end"><?php echo htmlspecialchars($precio_total_f); ?></td>
            <td class="text-center">
                <a href="#" onclick="eliminar('<?php echo $id_tmp; ?>')" class="btn btn-sm btn-danger">
                    <i class="bi bi-trash"></i>
                </a>
            </td>
        </tr>
    <?php 
    } 
    ?>
    <tr>
        <td colspan="5" class="text-end"><strong>Total Gs.</strong></td>
        <td class="text-end">
            <strong><?php echo number_format($suma_total, 0, ',', '.'); ?></strong>
            <input type="hidden" name="suma_total" value="<?php echo $suma_total; ?>">
        </td>
        <td></td>
    </tr>
</table>
