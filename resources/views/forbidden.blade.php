<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>403 Forbidden</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Forbidden page" name="description" />
        <meta content="Milena Brankovic" name="author" />
        @include('partials.css')

    <body class=" page-500-full-page">
        <div class="row">
            <div class="col-md-12 page-500">
                <div class=" number font-red"> 403 </div>
                <div class=" details">
                    <h3>Oops! Forbidden content.</h3>
                    <p> @if (session('message'))
                            {{session('message')}}
                        @endif
                        <br/> </p>
                    <p>
                            <a href="/login" class="btn red btn-outline">Return to login page </a>
                        <br> </p>
                </div>
            </div>
        </div>
         @include('partials.scripts')
    </body>

</html>