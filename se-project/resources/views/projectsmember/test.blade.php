
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    
<nav class="navbar navbar-expand-lg" style=" background-color: #92C7CF;">
    <div class="container-fluid">
    <a  class="navbar-brand" style="font-size: 32px;"  >รายชื่อโครงการ </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"> <span class="navbar-toggler-icon"></span>
    </button>
    </div>
    </nav>
    <div class="container-fluid p-4" >
        <div class="bg" 
            style="height:840px; background: #92C7CF; border-radius: 20px; overflow: hidden;">
            <div class="manage p-1" 
                style="height:70px; text-align: center; font-size: 36px; ">
                <p>เลือกทีมสำหรับโครงการ</p>
            </div>
    
            <div class="bg2" 
            style="margin-left:1.25%;max-width: 97.5%; height:750px; background: #ffffff; border-radius: 20px; overflow: hidden;">
            <div class="detail-fluid" style=" height:710px; overflow: auto;">
               
              @foreach ($projectId as $item)
    <div class="Submit px-4 pb-2">
        <a href="{{ route('manage', ['projectId' => $item->id]) }}" class="btn custom-button" style="background-color: #FBF9F1; border: 1px solid #E5E1DA;">{{$item->id}}</a>
    </div> 
@endforeach
            </div>
            
             </div>
        </div>
        
    </div>
</body>
</html>




