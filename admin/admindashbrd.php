<?php
include './adminsidebar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <div style="width:100%;margin-left:17%;margin-top:5%;">
        <div class="justify-content-center">
            <blockquote class="blockquote text-center">
                <h2 class="mb-0 mt-4">WELCOME Admin!!</h2>
            </blockquote>
        </div>
        <div class="justify-content-end">
            <p>Date/Time: <span id="datetime"></span></p>

            <script>
                var dt = new Date();
                document.getElementById("datetime").innerHTML = dt.toDateString();
            </script>
        </div>

        <div class="field field-name-body field-type-text-with-summary field-label-hidden">
        <div class="field-items"><div class="field-item even" property="content:encoded">
            <div id="karnataka-map"><img alt="karnataka-map" src="https://www.kmfnandini.coop/sites/default/files/Milk-Unions-map.jpg" usemap="#Map">
        </div>
        
    </div>
</body>

</html>
<?php include '../incl/footer.incl.php'; ?>