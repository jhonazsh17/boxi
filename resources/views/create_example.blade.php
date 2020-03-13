<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>Crear Example</h1>
	<form action="{{ route('create') }}" method="POST">
		{{ csrf_field() }}
		<input type="text" name="contenido">
		<input type="submit">
	</form>
</body>
</html>