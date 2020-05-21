<div class="col-lg-12 attendence_check_button">
      <center>
        <h4 class="text-center">Attendence Sheet</h4>
        <br>
        <a class="btn btn-success btn-sm all_present"><i class="fa fa-check-square-o" aria-hidden="true"></i> Mark All Present</a>
        <a class="btn btn-danger btn-sm all_absence"><i class="fa fa-times" aria-hidden="true"></i> Mark All Absent</a>
      </center>
</div>
<div class="col-lg-1"></div>
<div class="col-lg-10">
    <table class="custom_table table-bordered table-striped">
      <thead>
        <tr>
          <th>Check For Attendence</th>
          <th>Employe Name</th>
          <th>Employe Code</th>
        </tr>
      </thead>
      <tbody>
        @foreach($department_data as $department_data_value)
        <tr>
          <td>
            <input type="checkbox" class="checkbox" name="id[]" value="{{$department_data_value->id}}">
          </td>
          <td>{{$department_data_value->employe_name}}</td>
          <td>{{$department_data_value->employe_code}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
</div>
<div class="col-lg-1"></div>
<div class="col-lg-12 attendence_check_button">
    <center>
      <button class="btn btn-success btn-sm">Submit</button>
    </center>
</div>
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