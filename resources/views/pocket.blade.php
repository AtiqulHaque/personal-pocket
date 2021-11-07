<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    </head>
    <body>
        <div>
            <div class="container">
                <div class="content">
                    <div class="row" style="margin-top : 10px; float: right;">
                        <div class="col-md-12">
                            {{ $contents['data']->links()}}
                        </div>
                    </div>
                    @if(!empty($contents['data']))
                        <div class="row">
                            @foreach( $contents['data']->items() as $eachContent)
                                <div class="col-md-3">
                                    <div class="card" style="width: 18rem;">
                                        <div class="card-body">
                                            <h5 class="card-title"> {{$eachContent->title}}</h5>
                                            <a href="{{route('pocket_details',["pocket_id" => $eachContent->id] )}}" class="btn btn-primary">Show details</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row" style="margin-top : 10px; float: right;">
                            <div class="col-md-12">
                                {{ $contents['data']->links()}}
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </body>
</html>
