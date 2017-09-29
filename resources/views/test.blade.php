<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/timeline.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">


    <!-- jQuery -->
    <script src="{{ asset("js/app.js") }}"></script>
    <script src="{{ asset("js/admin.js") }}"></script>

    <!--<script type="text/javascript" src="{{ asset('js/jquery-3.2.1.js') }}"></script> -->

    <!-- Datatables -->
    <link rel="stylesheet" href="{{ asset('/css/jquery.dataTables.min.css') }}">
    <script type="text/javascript" src="{{ asset('/js/jquery.dataTables.js') }}"></script>
</head>
<body>
    <table id="tblContacts" class="table table-striped">
        <thead>
            <tr>
                <th>Phone Num</th>
                <th>Name</th>
                <th>Msg Sent</th>
                <th>Msg Rec</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>+64 210 1125 4587</td>
                <td>George Smith</td>
                <td>265</td>
                <td>178</td>
            </tr>
            <tr>
                <td>+64 210 1125 4587</td>
                <td>George Smith</td>
                <td>265</td>
                <td>178</td>
            </tr>
        </tbody>
    </table>

    <script>
    $( document ).ready(function() {
        $('#tblContacts').DataTable();
    });
    </script>


  </body>
    

</html>