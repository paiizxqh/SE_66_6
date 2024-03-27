
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Team manage</title>
<link rel="style.net" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    
<nav class="navbar navbar-expand-lg" style=" background-color: #92C7CF;">
    <div class="container-fluid">
    <a  class="navbar-brand" style="font-size: 32px;"  >รายชื่อโครงการ </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"> <span class="navbar-toggler-icon"></span>
    </button>
    {{-- <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
    <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#">Home</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="#">Features</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="#">Pricing</a>
    </li>
    <li class="nav-item">
    <a class="nav-link disabled" aria-disabled="true">Disabled</a>
    </li>
    </ul>
    </div> --}}
    </div>
    </nav>
    <div class="container-fluid p-4" >
        <div class="bg" 
            style="height:840px; background: #92C7CF; border-radius: 20px; overflow: hidden;">
            <div class="manage p-1" 
                style="height:100px; display: flex; align-items: center; justify-content: center; text-align: center; font-size: 36px; ">
                <p>จัดการข้อมูลทีม</p>
            </div>
    
            <div class="bg2" 
            style="margin-left:1.25%;max-width: 97.5%; height:710px; background: #ffffff; border-radius: 20px; overflow: hidden;">
            <div class="detail-fluid" style=" height:660px; overflow: auto;">
                <div class="Sales" 
                style="margin-left:1%; margin-top: 10px; font-size: 32px; ">
                <a>Sales</a>
                <button id="salesButton" type="button" class="btn custom-button" data-toggle="modal" data-target="#Sales-manage" style="background-color: #FBF9F1; border: 1px solid #E5E1DA;">จัดการสมาชิก</button>
                    </div>
                <div class="Sales-mem" 
                style="margin-left:1%; margin-top: 10px; font-size: 24px; ">
                @include('projectsmember.member', ['role' => 'Sales'])
              </div>
                <div class="Assist" 
                style="margin-left:1%; margin-top: 10px; font-size: 32px; ">
                <a>Assistant</a>
                <button id="assistButton" type="button" class="btn custom-button" data-toggle="modal" data-target="#Assistant-manage" style="background-color: #FBF9F1; border: 1px solid #E5E1DA;">จัดการสมาชิก</button>
                    </div>
                <div class="Assist-mem" 
                style="margin-left:1%; margin-top: 10px; font-size: 24px; ">
                @include('projectsmember.member', ['role' => 'Assistant'])
     
                    </div>
                <div class="Academic" 
                style="margin-left:1%; margin-top: 10px; font-size: 32px; ">
                <a>Academician</a>
                <button id="academicButton" type="button" class="btn custom-button" data-toggle="modal" data-target="#Academician-manage" style="background-color: #FBF9F1; border: 1px solid #E5E1DA;" >จัดการสมาชิก</button>
                    </div>
                <div class="Academic-mem" 
                style="margin-left:1%; margin-top: 10px; font-size: 24px; ">
                @include('projectsmember.member', ['role' => 'Academician'])
     
                    </div>
                <div class="Survey" 
                style="margin-left:1%; margin-top: 10px; font-size: 32px; ">
                <a>Surveyor</a>
                <button id="surveyorButton" type="button"  class="btn custom-button" data-toggle="modal" data-target="#Surveyor-manage"  style="background-color: #FBF9F1; border: 1px solid #E5E1DA;">จัดการสมาชิก</button>
                    </div>
                <div class="Survey-mem" 
                style="margin-left:1%; margin-top: 10px; font-size: 24px; ">
                @include('projectsmember.member', ['role' => 'Surveyor'])
                    </div>
                    
            </div>
            <div class="Submit d-flex justify-content-end px-4 pb-2">
              <a href="{{ route('test') }}">
                <button type="button" class="btn btn-primary"><span>submit</span>
                </button>
              </a>
                  </div>
             </div>
        </div>
        
    </div>
    @include('projectsmember.modal', ['role' => 'Sales'])
    @include('projectsmember.modal', ['role' => 'Academician'])
    @include('projectsmember.modal', ['role' => 'Assistant'])
    @include('projectsmember.modal', ['role' => 'Surveyor'])
    
     

</body>
</html>



