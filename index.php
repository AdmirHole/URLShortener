<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <title>Mojlink</title>
</head>

<body>
    <div class="container-fluid min-vh-100 min-vw-100 d-flex justify-content-center align-items-start">
        <div class="col-8 d-flex flex-column justify-content-start align-items-center min-vh-100" id="header" style="border-left: 1px solid #e0e1e3; border-right: 1px solid #e0e1e3;">
            <div class="col-md-8 d-flex justify-content-center py-3" style="border-bottom: 1px solid #262626;">
                <h1>Mojlink</h1>
            </div>
            <div class="col-md-8 d-flex justify-content-center flex-column pt-5 content">
                    <div class="form-group">
                        <label for="longUrl">Long URL</label>
                        <input type="text" class="form-control" id="longUrl" name="longUrl" >
                    </div>
                        <button type="submit" class="btn btn-secondary col-3">Shorten URL</button>
            </div>
        </div>
    </div>
    <script src="../node_modules/clipboard/dist/clipboard.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="script.js"></script>

</body>

</html>