<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyFlix</title>
    <link rel="stylesheet" href="dist/app.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
                           integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
                           crossorigin="anonymous">

</head>
<body>
  <div style="padding-top:15px;"></div>
  <nav class="navbar navbar-expand  text-white" style="background-color: #B50404; border:8px solid white;">
     <div class="h1 pl-5 ml-5" style="border-left:14px solid white;" ><strong>MyFlix</strong></div>
     <div id="app">
       <div class=" my-5 ml-5 px-5">
        <div class="h2 pl-5 pt-2 pb-2" style="border-left:14px solid white;">"Select one microservice"</div>
      </div>
     </div>
  </nav>

  <div class="pt-4 text-center">
    <div style="border-left:500px solid #9999; border-right:500px solid #9999;">
      <div style="padding-top:100px;"></div>
      <div class="btn" style="font-size:130%;"><a href="/logins1"><strong> Get Started </strong></a></div><br>
      <div class="pb-1 pt-2" style="font-size:130%;">Or</div>
      <div class="btn" style="font-size:125%;"><a href="/billings1">Go to <strong>Billing</strong> Microservice</a></div><br>
      <div class="btn" style="font-size:125%;"><a href="/catalogues1/1">Go to <strong>Catalogue</strong> Microservice</a></div><br>
      <div class="btn" style="font-size:125%;"><a href="/videos1/1">Use <strong>Video</strong> Microservice</a></div>
      <div style="padding-bottom:270px;"></div>
    </div>
  </div><hr>

  <div class="p-3 mb-2 bg-dark text-white text-center"
       style="border:10px solid white;">University of Dundee
  </div>

<script src="dist/app.js"></script>
</body>
</html>
