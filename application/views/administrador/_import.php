<html>
<head>
<title>Importar excel a mysql</title>
</head>
  <body>

    <?php echo form_open_multipart('import/to_mysql');?>

      <input type="file" name="excel" size="20" />

      <br /><br />

      <label>Escribe el nombre de la tabla.</label><br />
      <input type="text" name="table" /><br /><br />

      <label>Escribe, separados por una coma, los campos de tu tabla excepto los autoincrementales, ejemplo id etc.</label><br />
      <input type="text" name="fields" style="width:600px" />

      <input type="submit" value="Importar" />

    <?php echo form_close() ?>

  </body>
</html>