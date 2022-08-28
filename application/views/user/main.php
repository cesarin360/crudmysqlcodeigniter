<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel = "stylesheet" type = "text/css" href = "http://3.95.222.181/crudmysqlcodeigniter/css/style.css">
    <!-- Font Roboto CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <style>body{font-family:"Roboto" !important;}</style>

    <title>Lista de usuarios</title>
  </head>
  <body style="background-color: #EAF2F8;">

    <div class="container">

        <h1 class="mt-5">Lista de usuarios</h1>
        <div class="text-right">
        <a href="<?php echo base_url(); ?>nuevo-usuario" class="btn btn-info"><ion-icon name="add"></ion-icon></a> 
        </div>
        <table class="table mt-4">
            <thead class="thead-light">
                <tr>
                <th scope="col">N°</th>
                <th scope="col">Nombre</th>
                <th scope="col">Primer Apellido</th>
                <th scope="col">Segundo Apellido</th>
                <th scope="col">Fecha</th>
                <th scope="col">Genero</th>
                <th scope="col">DPI</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Correo Elctrónico</th>  
                <th scope="col">Eliminar</th>  
                <th scope="col">Editar</th>
                </tr>
            </thead>
            <tbody>
                <?php $number=0; foreach($data as $key => $value): ?>
                    <tr>
                        <th scope="row"><?php echo ++$number; ?></th>
                        <td><?php echo $value->nombre; ?></td>
                        <td><?php echo $value->ap; ?></td>
                        <td><?php echo $value->am; ?></td>
                        <td><?php echo $value->fn; ?></td>
                        <td><?php echo $value->genero; ?></td>
                        <td><?php echo $value->DPI; ?></td>
                        <td><?php echo $value->Telefono; ?></td>
                        <td><?php echo $value->correo_electronico; ?></td>
                        <td>
                            <button onclick="clicked(<?php echo $value->id; ?>)"  class="btn btn-danger"><ion-icon name="remove"></ion-icon></button>
                        </td>
                        <td>
                            <a href="<?php echo base_url(); ?>usuario/<?php echo $value->id; ?>" class="btn btn-primary"><ion-icon name="pencil"></ion-icon></a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>

    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="http://3.95.222.181/crudmysqlcodeigniter/js/sw.js"></script>
    <script>
		const clicked = (id) => {
			swal({
				title: "¿Estas seguro?",
				text: "Una vez eliminado, no podras recuperar este elemento...",
				icon: "warning",
				buttons: true,
				dangerMode: true,
				})
				.then((willDelete) => {
				if (willDelete) {
					swal("Presiones OK para proceder.", {
					icon: "success",
					}).then((willDelete1) => {
						if (willDelete1) {
							location.replace("<?php echo base_url(); ?>usuario/delete/<?php echo $value->id; ?>");
						}
					});
				} else {
					swal("No se ha eliminado nada.");
				}
				});
		}
	</script>
  </body>
</html>