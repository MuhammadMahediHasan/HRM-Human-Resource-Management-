<div class="col-lg-12">
    <h3 class="text-center">Attendence Sheet</h3>
</div>
<div class="col-lg-12">
      <center>
 <!--        <a class="btn btn-success all_present"><i class="fa fa-check-square-o" aria-hidden="true"></i> Mark All Present</a>
        <a class="btn btn-danger all_absence"><i class="fa fa-times" aria-hidden="true"></i> Mark All Absent</a> -->
      </center>
</div>
<div class="col-lg-1"></div>
    <div class="col-lg-10">
          <table class="custom_table table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Employe Name</th>
                <th>Employe Code</th>
                <th>Branch</th>
                <th>Department</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Attendence Status</th>
              </tr>
            </thead>
            <tbody>
            @foreach($employee as $key=> $employee_data)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$employee_data->employe_name}}</td>
                <td>{{$employee_data->employe_code}}</td>
                <td>{{$employee_data->branch_name}}</td>
                <td>{{$employee_data->department_name}}</td>
                <td>{{$employee_data->phone}}</td>
                <td>{{$employee_data->email}}</td>
                @php
                    $status = collect($attendence)->where('user_id',$employee_data->id);
                @endphp
                <td>
                    @if(count($status) > 0)
                      Present
                    @else
                      Absense
                    @endif
                </td>
              </tr>
            @endforeach  
            </tbody>
          </table>
    </div>
<div class="col-lg-1"></div>
