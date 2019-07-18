<div class="col-lg-12" style="margin-top: 50px;">
    <h4 class="text-center">Attendence Sheet</h4>
</div>
<div class="col-lg-12" style="margin-top: 20px;">
      <center>
        <a class="btn btn-success all_present"><i class="fa fa-check-square-o" aria-hidden="true"></i> Mark All Present</a>
        <a class="btn btn-danger all_absence"><i class="fa fa-times" aria-hidden="true"></i> Mark All Absent</a>
      </center>
</div>
<div class="col-lg-1"></div>
    <div class="col-lg-10">
          <table class="table table-striped" style="border: 1px solid #ddd; margin-top: 20px;">
            <thead>
              <tr style="background: #263544; color: white">
                <th>Check For Attendence</th>
                <th>Employe Name</th>
                <th>Employe Code</th>
              </tr>
            </thead>
            <tbody>
              @foreach($department_data as $department_data_value)
              <tr>
                <td>
                  <input type="checkbox" class="checkbox" name="employe_basic_info_id[]" value="{{$department_data_value->employe_basic_info_id}}">
                </td>
                <td>{{$department_data_value->employe_name}}</td>
                <td>{{$department_data_value->employe_code}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <center>
            <button class="btn btn-success">Submit</button>
          </center>
    </div>
<div class="col-lg-1"></div>
<script type="text/javascript">
  $(document).ready(function(){
    $(".all_present").click(function(){
      
          $("input:checkbox[class=checkbox]").each(function() {
              // alert("set checked");
              $(this).attr('checked', "checked");
          });
   
    });
    $(".all_absence").click(function(){
      
          $("input:checkbox[class=checkbox]").each(function() {
              // alert("set checked");
              $(this).attr('checked', false);
          });
   
    });
  });
</script>