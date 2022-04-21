<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <style>
      *
      {
        font-family: 'Courier New', Courier, monospace;
      }
    </style>
    <div class="container-fluid">
      <div class="container">
        <center class="h2 text-center text-danger">
        Message d'un utilisateur
      </center>
      </div>
      <h5>Nom : {{ $contact['nom'] }}</h5>
      <h5>Numero : {{ $contact['tel'] }}</h5>
      <h5>Email : {{ $contact['email'] }}</h5>
      <h5>Objet : {{ $contact['objet'] }}</h5>
      <h5>Message :</h5>
      <div class="container justify-content-lg-center">
        {{ $contact['message'] }}
      </div>

    </div>
  </body>
</html>