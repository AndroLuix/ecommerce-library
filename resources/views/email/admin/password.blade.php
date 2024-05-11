<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Invio Email</h1>
        <div class="row">
            <div class="col-md-6 offset-md-3">
               <div class="card">
                <card class="card-header">Richiesta di reset password</card>
               </div>

               <div class="card-body">
                Apri il seguente link per modificare la password
               </div>
               
               <a class="btn btn-primary" href="{{route('admin.password.reset',$admin->remember_token)}}">Modifica Password</a>
            </div>
        </div>
    </div>
</body>
</html>
