<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Horizontal form</h2>
        <form class="form-horizontal" action="/action_page.php">
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" placeholder="Enter email" name="email" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">User Name:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" placeholder="Enter username" name="username" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Gender:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" placeholder="Enter genre" name="gender" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Password:</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" placeholder="Enter password" name="password" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Place of Origin:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" placeholder="Enter place of origin" name="place_of_origin" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">A Phone Number:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" placeholder="Enter a phone number" name="a_phone_number" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>
        </form>
    </div>

</body>

</html>