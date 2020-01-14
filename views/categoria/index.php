<h1>Gestionar categorías</h1>

<a href="<?=base_url?>categoria/crear" class="button button-small">
    Crear categoria
</a>

<table>
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>       
    </tr>   
    <?php while($pro = $categorias->fetch_Object()): ?>
    <tr>
        <td><?=$pro->id;?></td>
        <td><?=$pro->nombre;?></td>       
    </tr>
    <?php endwhile; ?>
</table>






