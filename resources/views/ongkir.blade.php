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
        <h5 class="card-header text-center">Cek Ongkir</h5>
        <div class="card-body">
            <form class="row justify-content-center g-3"onSubmit="return false;">
                @csrf
                <div class="col-3">
                    <div class="row">
                        <label for="kota_asal" class="col-md-4 col-form-label">Kota asal</label>
                        <div class="col-md-8">
                            <select class="form-control" id="kota_asal" name="kota_asal">
                                <option value=''>--Pilih--</option>
                                @if($kota)
                                    @foreach($kota as $row)
                                        <option value="{{ $row['city_id'] }}">{{ $row['city_name'] }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row">
                        <label for="kota_tujuan" class="col-md-4 col-form-label">Kota tujuan</label>
                        <div class="col-md-8">
                            <select class="form-control" id="kota_tujuan" name="kota_tujuan">
                                <option value=''>--Pilih--</option>
                                @if($kota)
                                    @foreach($kota as $row)
                                        <option value="{{ $row['city_id'] }}">{{ $row['city_name'] }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="row">
                        <label for="berat" class="col-md-5 col-form-label">Berat (gr)</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" id="berat" name="berat" placeholder="ex: 1000">
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="row">
                        <label for="kota_tujuan" class="col-md-4 col-form-label">Kurir</label>
                        <div class="col-md-8">
                            <select class="form-select" id="kurir" name="kurir">
                                <option value=''>--Pilih--</option>
                                <option value="jne">JNE</option>
                                <option value="pos">POS</option>
                                <option value="tiki">TIKI</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-primary mb-3" id="btn-submit">Submit</button>
                </div>
            </form>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table_estimasi" style="display:none">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kurir</th>
                                    <th>Service</th>
                                    <th>Estimasi</th>
                                    <th>Biaya</th>
                                </tr>
                            </thead>
                            <tbody id="content_result">
                            </tbodY>
                        </table>
                    </div>
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

        var kota_asal = $("[name=kota_asal]").val();
        var kota_tujuan = $("[name=kota_tujuan]").val();
        var berat = $("input[name=berat]").val();
        var kurir = $("[name=kurir]").val();

        $.ajax({
           type:'POST',
           url:"{{ url('proses-ongkir') }}",
           data:{kota_asal:kota_asal,kota_tujuan:kota_tujuan,berat:berat,kurir:kurir},
           success:function(data){
              $('#content_result').html(data.hasil);
              $('#table_estimasi').show();
           }
        });

    });
    </script>
  </body>
</html>
