<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title>Pasar20</title>
  </head>
  <body>
    <div class="card">
        <h5 class="card-header text-center">Input jumlah perulangan</h5>
        <div class="card-body">
            <form class="row justify-content-center g-3"onSubmit="return false;">
                @csrf
                <div class="col-auto">
                    <label for="input_perulangan" class="visually-hidden">Password</label>
                    <input type="text" class="form-control" id="input_perulangan" name="input_perulangan" placeholder="Input perulangan">
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary mb-3" id="btn-submit">Submit</button>
                </div>
            </form>
            <div class="row">
                <div class="col-auto">
                    <span id="content_result"></span>
                </div>
            </div>
        </div>
    </div>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#btn-submit").click(function(e){

        e.preventDefault();

        var input_perulangan = $("input[name=input_perulangan]").val();

        $.ajax({
           type:'POST',
           url:"{{ url('proses') }}",
           data:{input_perulangan:input_perulangan},
           success:function(data){
              $('#content_result').html(data.hasil);
           }
        });

    });
    </script>
  </body>
</html>
