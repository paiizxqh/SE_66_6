<div /*popup-sales*/ class="modal fade" id="{{$role}}-manage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width:55%;"  role="document">
    <div class="modal-content " style=" background: #92C7CF; ">
      <div class="model-close">
        <button type="button mb-0" class="close d-flex justify-content-end px-2" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-header d-flex justify-content-center mt-0">
        <p class="modal-title" style="font-size: 32px;"  id="exampleModalLabel">จัดการสมาชิก</p>

      </div>
      <div class="modal-body" style=" max-width: 100%;">
        <form id="{{$role}}Form">
        <div class="modal-bg p-2" style="max-height:360px; max-width:100%;background: #ffffff; border-radius: 20px; overflow:auto;">
          
              <div class="gg" style=" border-radius: 20px;background: #FBF9F1;">
              <span class="mb-0 p-2 px-4" style=" max-width: 100%; font-size: 24px;white-space: pre; margin: 0;">  รหัสพนักงาน                   ชื่อ-สกุล  </span>
              </div>
   
              <div id="checkboxes">
              
                 
                  @foreach ($depart_em as $item)
                      @if($item->role==$role)
                          <div class="detail d-flex justify-content-start border-bottom px-3 align-items-center" style="display: flex; align-items: center;">
                            <input type="checkbox" name="selectedEmployees[]" value="{{$item->user_id}}" id="checkbox{{$item->user_id}}" data-department-name="{{$item->role}}">
                              <label for="checkbox{{$item->user_id}}" class="mb-0 px-2" style="display: flex; align-items: center;"></label>
                              <span  style="display: flex; align-items: center; font-size: 24px;white-space: pre; margin: 0;">{{$item->employee_id}}                         {{$item->username}}</span>
                            </div>
                      @endif
                      
                  @endforeach
              </div>
             
      
    </div>
    <div class="modal-footer">
      <div style="display: flex;justify-content: center;align-items: center;">
      @if($role=='Sales')
      <span style="font-size: 28px;color: red;">*ต้องการ {{$role}} 1 คน*</span>
      @elseif($role=='Surveyor')
      <span style="font-size: 28px;color: red;">*ต้องการ {{$role}} 2-3 คน*</span>
      @elseif($role=='Academician')
      <span style="font-size: 28px;color: red;">*ต้องการ {{$role}} 4 คน*</span>
      @elseif($role=='Assistant')
      <span style="font-size: 28px;color: red;">*ต้องการ {{$role}} 4 คน*</span>
      @endif
      </div>
      
      <div class="sub-but">
        <a href="{{ route('manage', ['projectId' => $projectId]) }}">
        <button type="button" class="btn btn-primary"><span>submit</span>
        </button>
      </a>
    </div>
    </div>
        </form>
  </div>
</div>
</div>
</div>

<script>
  $(document).ready(function(){
    $('#{{$role}}-manage').on('hide.bs.modal', function (e) {
        if ($(e.target).is(':checkbox')) {
            return;
        }
        // หา checkbox ที่ถูกเลือกใน modal
        $('#{{$role}}Form input[type=checkbox]:checked').prop('checked', false);
        
    });
  });
    $(document).ready(function(){
    $('#{{$role}}-manage').on('shown.bs.modal', function (e) {
        @foreach ($project_members as $pm)
            var checkbox = document.querySelector('input[name="selectedEmployees[]"][value="{{$pm->user_id}}"]');
            if (checkbox) {
                checkbox.checked = true;
            }
        @endforeach
    });
});
  var role = '{{$role}}';


  if(role=='Surveyor'){
  $('#Surveyor-manage').on('shown.bs.modal', function () {
$('#Surveyor-manage input[type="checkbox"]').on('change', function() {
 var checked = $('#Surveyor-manage input[type="checkbox"]:checked').length;
 if (checked > 3) {
     $(this).prop('checked', false);
 }

});
});
$('#Surveyor-manage .btn-primary').on('click', function() {
 var checked = $('#Surveyor-manage input[type="checkbox"]:checked').length;
 if (checked !== 3 && checked !== 2) {
 return false; // ไม่ส่งคำขอถ้า Checkbox ไม่มี 2 หรือ 3 ตัวที่ถูกเลือก
}
 // ส่งคำขอหาก Checkbox ครบ
 submitForm('Surveyor',"SurveyorForm");}
 );
}
else if(role=='Academician'){
 $('#Academician-manage').on('shown.bs.modal', function () {
$('#Academician-manage input[type="checkbox"]').on('change', function() {
 var checked = $('#Academician-manage input[type="checkbox"]:checked').length;
 if (checked > 4) {
     $(this).prop('checked', false);
 }

});
});
$('#Academician-manage .btn-primary').on('click', function() {
 var checked = $('#Academician-manage input[type="checkbox"]:checked').length;
 if (checked !== 4) {
     return false; // ไม่ส่งคำขอถ้า Checkbox ไม่ครบ
 }
 // ส่งคำขอหาก Checkbox ครบ
 submitForm('Academician',"AcademicianForm");}
 );}
 else if(role=='Assistant'){
 $('#Assistant-manage').on('shown.bs.modal', function () {
$('#Assistant-manage input[type="checkbox"]').on('change', function() {
 var checked = $('#Assistant-manage input[type="checkbox"]:checked').length;
 if (checked > 4) {
     $(this).prop('checked', false);
 }

});
});
$('#Assistant-manage .btn-primary').on('click', function() {
 var checked = $('#Assistant-manage input[type="checkbox"]:checked').length;
 if (checked !== 4) {
     return false; // ไม่ส่งคำขอถ้า Checkbox ไม่ครบ
 }
 // ส่งคำขอหาก Checkbox ครบ
 submitForm('Assistant',"AssistantForm");}
 );
}
else if(role=='Sales'){
  $('#Sales-manage').on('shown.bs.modal', function () {
  $('#Sales-manage input[type="checkbox"]').on('change', function() {
   var checked = $('#Sales-manage input[type="checkbox"]:checked').length;
   if (checked > 1) {
       $(this).prop('checked', false);
   }
  
  });
  });
  $('#Sales-manage .btn-primary').on('click', function() {
   var checked = $('#Sales-manage input[type="checkbox"]:checked').length;
   if (checked !== 1) {
       return false; // ไม่ส่งคำขอถ้า Checkbox ไม่ครบ
   }
   // ส่งคำขอหาก Checkbox ครบ
   submitForm('Sales',"SalesForm");}
   );
}
function submitForm(departments_name, sendfrom) {
  var projectId = "{{ $projectId }}";
  var form = document.getElementById(sendfrom);
  var checkboxes = form.querySelectorAll('input[name="selectedEmployees[]"]:checked');
  var selectedEmp = [];
  
  checkboxes.forEach(function(checkbox) {
    selectedEmp.push({
      employeeId: checkbox.value,
      departmentName: departments_name
    });
  });
  
  // ส่งข้อมูลไปยัง Laravel ด้วย fetch API
  fetch('/process', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: JSON.stringify({ selectedEmployees: selectedEmp,projectId: projectId })
  })
  .then(response => {
    // ทำสิ่งที่คุณต้องการหลังจากได้รับการตอบกลับจากเซิร์ฟเวอร์
    console.log(response);
  })
  .catch(error => {
    console.error('Error:', error);
  });
}
 </script>
  