<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel = "stylesheet" type = "text/css" href = "http://3.95.222.181/crudmysqlcodeigniter/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <style>body{font-family:"Roboto" !important;}</style>
    
    <title>Editar usuario</title>
  </head>
  <body style="background-color: #EAF2F8;">

    <div class="container">
        <h1 class="mt-5">Editar los datos del usuario: <?php echo $nombre; ?></h1>
        <form action="<?php echo base_url(); ?>usuario/update/<?php echo $id; ?>" class="mt-4" method="POST">
        <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" name="nombre" class="form-control <?php echo form_error('nombre') ? 'is-invalid' : ''; ?>" placeholder="Nombre" value="<?php echo $nombre; ?>">
                        <div class="invalid-feedback">
                            <?php echo form_error('nombre'); ?>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Primer Apellido</label>
                        <input type="text" name="ap" class="form-control <?php echo form_error('ap') ? 'is-invalid' : ''; ?>" placeholder="Primer Apellido" value="<?php echo $ap; ?>">
                        <div class="invalid-feedback">
                            <?php echo form_error('ap'); ?>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Segundo Apellido</label>
                        <input type="text" name="am" class="form-control <?php echo form_error('am') ? 'is-invalid' : ''; ?>" placeholder="Segundo Apellido" value="<?php echo $am; ?>">
                        <div class="invalid-feedback">
                            <?php echo form_error('am'); ?>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Fecha</label>
                        <input type="date" name="fn" class="form-control <?php echo form_error('fn') ? 'is-invalid' : ''; ?>" placeholder="Fecha" value="<?php echo $fn; ?>">
                        <div class="invalid-feedback">
                            <?php echo form_error('fn'); ?>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="exampleInputEmail1">Genero</label>
                            <select class="form-select" aria-label="Default select example" name="genero">
                                <option 
                                <?php if($genero == 'M') {echo 'selected';} ?>
                                value="M">Masculino</option>
                                <option 
                                <?php if($genero == 'F') {echo 'selected';} ?>
                                value="F">Femenino</option>
                                <option 
                                <?php if($genero == 'N') {echo 'selected';} ?>
                                value="N">No Binario</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="exampleInputEmail1">DPI</label>
                            <input type="text" name="DPI" pattern="[0-9]{4}-[0-9]{5}-[0-9]{4}" class="form-control <?php echo form_error('DPI') ? 'is-invalid' : ''; ?>" placeholder="XXXX-XXXXX-XXXX" value="<?php echo $DPI; ?>" maxlength="15">
                            <div class="invalid-feedback">
                                <?php echo form_error('DPI'); ?>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="exampleInputEmail1">Teléfono</label>
                            <input type="tel" name="Telefono" class="form-control <?php echo form_error('Telefono') ? 'is-invalid' : ''; ?>" aria-describedby="Correo Electrónico" placeholder="Teléfono" value="<?php echo $Telefono; ?>" maxlength="8">
                            <div class="invalid-feedback">
                                <?php echo form_error('Telefono'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Correo Electrónico</label>
                        <input type="email" name="correo_electronico" class="form-control <?php echo form_error('correo_electronico') ? 'is-invalid' : ''; ?>" placeholder="example@correo.com" value="<?php echo $correo_electronico; ?>">
                        <div class="invalid-feedback">
                            <?php echo form_error('correo_electronico'); ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <br><br>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form> 	
    </div>

    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
  </body>
</html>