<!DOCTYPE html>
<html>
<head>
    <title>Redefinição de Senha</title>
</head>
<body>
    <h1>Olá, {{ $name }}!</h1>
    <p>Você solicitou a redefinição de senha. Clique no link abaixo para continuar:</p>
    <a href="{{ $reset_link }}">Redefinir Senha</a>
</body>
</html>
