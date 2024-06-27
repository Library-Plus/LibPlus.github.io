<?php
	include('conexao.php');
	include('validar.php');
	include('restrito.php');
	$id = $_GET['id'];
	$sql = "SELECT * FROM livro WHERE id = {$id}";
	$query = mysqli_query($conexao, $sql);
	$item = mysqli_fetch_array($query, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Alterar Livros</title>
		<script>
			$(document).ready(function() {
			var statusFromPHP = "<?php echo $item['status']; ?>";
			$("#status").val(statusFromPHP);
			$("#id_tipo").val($('#id_tipo_select').val());
		});
		</script>
	</head>
	<body>
		<?php include('menu.php'); ?>
		<form class="cadastro" action="alterar_livros_db.php" method="post">
			<label>Código</label><br>
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type="hidden" id="id_tipo_select" value="<?php echo $item['id_tipo']; ?>">
			
			<?php echo $id; ?><br><br>
			
			<label for="id_tipo">Tipo</label><br>
			<select name="id_tipo" id="id_tipo">
				<?php
					$sql = 'SELECT id, genero FROM tipo';
					$query = mysqli_query($conexao, $sql);
					while ($subitem = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
				?>
				<option value="<?php echo $subitem['id']; ?>"<?php if ($item['id_tipo'] == $subitem['id']) { ?> selected="selected"<?php } ?>><?php echo "{$subitem['genero']}" ?></option>
				<?php
					}
				?>
			</select><br><br>
		
			<label for="titulo">Título</label><br>
			<input type="text" name="titulo" id="titulo" maxlength="100" value="<?php echo $item['titulo']; ?>"><br><br>
			
			<label for="sinopse">Sinopse</label><br>
			<textarea name="sinopse" id="sinopse"><?php echo $item['sinopse']; ?></textarea><br><br>
			
			<label for="status">Status</label><br>
			<select name="status" id="status">
				<option value="A">Ativo</option>
				<option value="I">Inativo</option>
			</select><br><br>
			
			<button type="submit">Alterar</button>
		</form>
	</body>
</html>
<?php
	mysqli_close($conexao);
?>

