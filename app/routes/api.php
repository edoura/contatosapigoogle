<?php
if(!defined("SPECIALCONSTANT")) die ("Acesso negado!");

     /*
          Metodo GET
          Possibilita api oferecer pela url https://localhost/apigoogle/contacts
          Listagem de contatos
     */

     $app->get("/contacts", function() use($app)
     {
          try{

               $usuarioDao = "dudu";


               $app->response->headers->set("Content-type", "application/json;charset=utf-8");
               $app->response->status(200);
               $app->response->body(json_encode($usuarioDao));
          }
          catch(PDOException $e)
          {
               echo "Erro: " . $e->getMessage();
          }
     });

     /*
     Metodo GET - passando parâmetro.
     Possibilita a api oferecer um contato específico
     A url deve ser consumida passando um parâmetro para seleção. No caso, @codUser.
     */

     $app->get("/contatcts/:nome", function($nome) use($app)
     {
          try{
               $connection = getConnection();
               $dbh = $connection->prepare("SELECT * FROM usuario WHERE nome = ?");
               $dbh->bindParam(1, $nome);
               $dbh->execute();
               $usuario = $dbh->fetchObject();
               $connection = null;

               $app->response->headers->set("Content-type", "application/json;charset=utf-8");
               $app->response->status(200);
               $app->response->body(json_encode($usuario));
          }
          catch(PDOException $e)
          {
               echo "Erro: " . $e->getMessage();
          }
     });