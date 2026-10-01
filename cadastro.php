<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Arandu</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main class="container">
        <img src="" alt="Arandu" class="logo">

        <div class="caixa-login">
            <h1>Crie sua conta<br>na Arandu!</h1>

            <form>
                <label for="nome">Nome completo:</label>
                <input type="text" id="nome" name="nome" placeholder="Seu nome" required>

                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" required>

                <label for="telefone">Telefone:</label>
                <input type="tel" id="telefone" name="telefone" placeholder="(00) 00000-0000" required>

                <label for="cep">CEP:</label>
                <input type="text" id="cep" name="cep" placeholder="00000-000" required>

                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" placeholder="seu@email.com" required>

                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" placeholder="••••••••" required>

                <label for="confirmar">Confirmar senha:</label>
                <input type="password" id="confirmar" name="confirmar" placeholder="••••••••" required>

                <button type="submit">Cadastrar</button>
            </form>

            <p class="cadastro">
                Já tem uma conta?
                <a href="login.php">Entrar</a>
            </p>
        </div>
    </main>
</body>
</html>