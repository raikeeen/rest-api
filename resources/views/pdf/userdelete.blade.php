<!DOCTYPE html>
<html>
<head>
    <title>It's me tap tap?</title>
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <h1>Is this goodbye?</h1>
    <p>Are you sure you don't want to reconsider? Was it something we said? <a href="">Tell us</a></p>
    <hr>
    <h3>Before you deactivate {{$email}}, know this:</h3>
    <ul>
        <li><strong>We will only retain your user data for 30 days</strong> and then it will be permanently deleted now {{$date}}</li>
        <li>You don't need to deactivate your account <a href="">to change your username</a></li>
        <li>If you want to use the account's username or email address on another account, <a href="">change it</a> before you deactivate.</li>
    </ul>
    <label for=""> Funny video about difference unit and feature tests</label>
    <video src="{{asset('video/test.mp4')}}" autoplay></video>
    <div class="row"></div>

    <div style="padding-bottom: 20px">
        <button class="btn btn-primary">Deactivate</button>
        <button class="btn btn-secondary">Cancel</button>
    </div>

</div>

</body>
</html>
