<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8 Datatables Tutorial - ItSolutionStuff.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
    
<div class="container">
    <h1>Laravel 8 Datatables Tutorial <br/> ItSolutionStuff.com</h1>
    <div class="container">
        <table class="table table-bordered">
            <tr>
                <th>Id</th>
                <th>Title</th>
            </tr>
            <?php 

                print_r($data);
            ?>

        </table>
</div>
</div>
   
</body>
   
</html>