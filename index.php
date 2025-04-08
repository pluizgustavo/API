<?php
use PhpParser\Node\Stmt\While_;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Factory\AppFactory;
require __DIR__ . '/vendor/autoload.php';
$app = AppFactory::create();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setErrorHandler(HttpNotFoundException::class, function (
Request $request,
Throwable $exception,
bool $displayErrorDetails,
bool $logErrors,
bool $logErrorDetails
) use ($app) {
$response = $app->getResponseFactory()->createResponse();
$response->getBody()->write('{"error": "voce ser bobo!"}');
return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
});

$app->post('/usuarios', function(Request $request, Response $response, array $args) {
$parametros = (array) $request->getParsedBody();
if (!array_key_exists('login', $parametros) || empty($parametros['login'])) {
$response->getBody()->write(json_encode([
"mensagem" => "Login obrigatorio"
]));
return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
}
if (!array_key_exists('senha', $parametros) || empty($parametros['senha'])) {
$response->getBody()->write(json_encode([
"mensagem" => "Senha obrigatoria"
]));
return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
}
return $response->withStatus(201);
});
$app->get('/usuarios', function (Request $request, Response $response, array $args) {
$usuarios = [
["nome" => "Usuario 1", "login" => "user1", "perfil_adm" => false],
["nome" => "Usuario 2", "login" => "user2", "perfil_adm" => false],
["nome" => "Usuario 3", "login" => "user3", "perfil_adm" => false],
["nome" => "Admin", "login" => "admin", "perfil_adm" => true],
["nome" => "Usuario 5", "login" => "user5", "perfil_adm" => false],
];
$response->getBody()->write(json_encode($usuarios));
return $response->withHeader('Content-Type', 'application/json');
});
$app->delete('/usuarios/{id}', function(Request $request, Response $response, array $args) {
$id = $args['id'];
return $response->withStatus(204);
});
$app->put('/usuarios', function(Request $request, Response $response, array $args) {
$resposta = "Users, atualizados com sucesso";
$response->getBody()->write(json_encode($resposta));
return $response->withHeader('Content-Type', 'application/json');
});
$app->run();