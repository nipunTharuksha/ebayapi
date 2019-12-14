<html>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <body class="bg bg-light">
        <div class="container">
            <div class="row">
                @foreach ( $variableForFrontEnd as $item)

                <div class="col-sm-3 p-3 my-2 bg bg-white border ">

                    <img src="{{ $item['PictureURL'][0]}}" class="img-fluid">
                    <h6 class="mt-3"> {{$item['Title']}}</h6>
                    <br>
                    <p>Price $ <span class="text-dark h3"> {{$item['ConvertedCurrentPrice']}}</span></p>

                </div>

                @endforeach
            </div>
        </div>
    </body>
</html>
