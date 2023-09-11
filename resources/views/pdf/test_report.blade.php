
{{-- @extends('main')
@section('main') --}}
<!doctype html>
<html lang="en">

<head>
  <title></title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<style>
    td{
        border:1px solid black; 
    }
    th{
        font-weight: bold;
        border:1px solid black; 
    }
</style>
</head>

<body>
  <header>
    <!-- place navbar here -->
  </header>
  <main><div class="container">
    {{-- <h1 class="display-1">Heading</h1> --}}
    <div class="row">

        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">ID </th>
                        <th scope="col">Pateint Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Vaccination</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($testReports as $r)
                    <tr class="">
                        <td scope="row">{{$r->id}}</td>
                        <td>{{$r->user->name}}</td>
                        <td>{{$r->status}}</td>
                        <td>{{$r->vaccination}}</td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    
    </div>
  </div>

  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>


{{-- @endsection --}}