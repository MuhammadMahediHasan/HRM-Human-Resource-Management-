<div class="col-lg-12" style="margin-top: 50px;">
    <h3 class="text-center">Attendence Report</h3>
</div>
<div class="col-lg-12" style="margin-top: 20px;">
      <center>
 <!--        <a class="btn btn-success all_present"><i class="fa fa-check-square-o" aria-hidden="true"></i> Mark All Present</a>
        <a class="btn btn-danger all_absence"><i class="fa fa-times" aria-hidden="true"></i> Mark All Absent</a> -->
      </center>
</div>
<div class="col-lg-1"></div>
    <div class="col-lg-10">
          <table class="table table-striped" style="border: 1px solid #ddd; margin-top: 20px;">
            <thead>
              <tr style="background: #263544; color: white">
                <th>#</th>
                <th>Employe Name</th>
                <th>Employe Code</th>
                <th>Attendence</th>
              </tr>
            </thead>
            <tbody>
            @foreach($attendence_report as $key=> $attendence_report_data)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$attendence_report_data->employe_code}}</td>
                <td>{{$attendence_report_data->employe_name}}</td>
                <td>{{$attendence_report_data->attendence_child_status}}</td>
              </tr>
            @endforeach  
            </tbody>
          </table>
    </div>
<div class="col-lg-1"></div>
