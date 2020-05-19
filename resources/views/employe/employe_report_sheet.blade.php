<div class="col-lg-12" style="margin-top: 50px;">
    <h4 class="text-center">Employee Report</h4>
</div>

<div class="col-lg-1"></div>
    <div class="col-lg-10">
          <table class="table table-striped" style="border: 1px solid #ddd; margin-top: 20px;">
            <thead>
              <tr style="background: #263544; color: white">
                <th>Employe Code</th>
                <th>Employe Name</th>
                <th>Branch</th>
                <th>Department</th>
                <th>Designation</th>
                <th>Gander</th>
                <th>Photo</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($employe_report as $employe_report_data)
              <tr>
                <td>{{$employe_report_data->employe_code}}</td>
                <td>{{$employe_report_data->employe_name}}</td>
                <td>{{$employe_report_data->branch_name}}</td>
                <td>
                  @php
                    $department_name=DB::table('department')->where('department_id','=',$employe_report_data->department_name)->first();
                  @endphp
                  {{$department_name->department_name}}
                </td>
                <td>
                  @php
                    $designation=DB::table('designation')->where('designation_id',$employe_report_data->designation_name)->first();
                  @endphp
                  {{$designation->designation_name}}
                </td>
                <td>{{$employe_report_data->employe_gender}}</td>
                <td>
                  <img style="width: 50px;" src="{{$employe_report_data->employe_photo}}">
                </td>
                <td style="display: inline-flex;">
                    {{Form::open(['url'=>"add_employe/$employe_report_data->id",'method'=>'DELETE'])}}
                        <button class="btn btn-danger delete"><i class="fas fa-trash" onclick="return confirm('Are You Sure?')"></i></button>
                    {{Form::close()}}

                    {{Form::open(['url'=>"add_employe/$employe_report_data->id/edit",'method'=>'GET'])}}
                    <button class="btn btn-primary" style="margin: 0px 3px 0px 4px;"><i class="fas fa-edit"></i></button>
                    {{Form::close()}}

                    <button type="button" class="btn btn-success view_bio" data-toggle="modal" data-target="#myModal" value="{{$employe_report_data->id}}"><i class="fas fa-vr-cardboard"></i></button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
    </div>
<div class="col-lg-1"></div>


<!-- Trigger the modal with a button -->


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="width: 189%;margin-left: -185px;">
      <div class="modal-header">
        <h4 class="modal-title">Employee Bio</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row" >
            <div class="col-lg-1"></div>
            <div class="col-lg-7">
              <h3 class="name">Name</h3>
              <b><u>Contact & Address</u></b><br>
              <span class="phone">Phone Number: </span><br>
              <span class="email">Email: </span><br>
              <span class="per_add">Permanent Address: </span><br>
              <span class="pre_add">Present Address: </span><br>
            </div>
            <div class="col-lg-3 image">
              
            </div>
            <div class="col-lg-1"></div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <center>
                <h5 style="margin: 15px;">Basic Info</h5>
              </center>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Employee Code</th>
                      <td class="code"></td>
                    </tr>
                    <tr>
                      <th >Branch</th>
                      <td  class="branch"></td>
                    </tr>
                    <tr>
                      <th>Depratment</th>
                      <td class="department"></td>
                    </tr>
                    <tr>
                      <th>Designation</th>
                      <td class="designation"></td>
                    </tr>
                    <tr>
                      <th>Father's Name </th>
                      <td class="f_name"></td>
                    </tr>
                    <tr>
                      <th>Mother's Name </th>
                      <td class="m_name"></td>
                    </tr>
                    <tr>
                      <th>Date Of Birth </th>
                      <td class="birth_date"></td>
                    </tr>
                    <tr>
                      <th>Gender  </th>
                      <td class="gender"></td>
                    </tr>
                    <tr>
                      <th>National Id </th>
                      <td class="nid"></td>
                    </tr>
                    <tr>
                      <th>Nationality</th>
                      <td class="nationality"></td>
                    </tr>
                    <tr>
                      <th>Blood Group </th>
                      <td class="blood_group"></td>
                    </tr>
                    <tr>
                      <th>Religion</th>
                      <td class="relagion"></td>
                    </tr>
                    <tr>
                      <th>Marital Status </th>
                      <td class="marital_status"></td>
                    </tr>
                  </thead>
                </table>
            </div>
            <div class="col-lg-1"></div>
          </div>
   
          <div class="row">
            <div class="col-lg-12">
              <center>
                <h5 style="margin: 15px;">Banking Info</h5>
              </center>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Account Number </th>
                      <td class="acc_name"></td>
                    </tr>
                    <tr>
                      <th>Bank Name </th>
                      <td class="bank_name"></td>
                    </tr>
                    <tr>
                      <th>Branch Name</th>
                      <td class="bank_branch"></td>
                    </tr>
                  </thead>
                </table>
            </div>
            <div class="col-lg-1"></div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <center>
                <h5 style="margin: 15px;">Joining Info</h5>
              </center>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Offer Date</th>
                      <td class="offer_date"></td>
                    </tr>
                    <tr>
                      <th>Confirmation Date </th>
                      <td class="con_date"></td>
                    </tr>
                    <tr>
                      <th>Date of Joining</th>
                      <td class="date_of_joining"></td>
                    </tr>
                  </thead>
                </table>
            </div>
            <div class="col-lg-1"></div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <center>
                  <button class="btn btn-link download">Click Here To Download CV</button>
              </center>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<input type="hidden" name="cv" class="cv">

<script type="text/javascript">
  $(document).ready(function(){
    $(document).on("click",".view_bio", function(){
      var id = $(".view_bio").val();
      $.ajax({
          url:'/get_bio',
          type:'post',
          data:{
                "_token":"{{ csrf_token() }}",
                'id':id,
          },
          success:function(data)
          {
            console.log(data);

            $(".name").text(data.employe_name); 
            $(".code").text(data.employe_code); 
            $(".phone").text(data.phone_number);
            $(".email").text(data.email);
            $(".per_add").text(data.parmanent_address);
            $(".pre_add").text(data.present_address);           
            $(".branch").text(data.branch_name);
            $(".department").text(data.department_name);
            $(".designation").text(data.designation_name);
            $(".f_name").text(data.father_name);
            $(".m_name").text(data.mother_name);
            $(".birth_date").text(data.date_of_birth);
            $(".gender").text(data.employe_gender);
            $(".nid").text(data.national_id);
            $(".nationality").text(data.nationality);
            $(".blood_group").text(data.blood_group);
            $(".relagion").text(data.relagion);
            $(".marital_status").text(data.marital_status);
            $(".acc_name").text(data.bank_account_number);
            $(".bank_name").text(data.bank_name);
            $(".bank_branch").text(data.bank_Branch_name);
            $(".offer_date").text(data.offer_date);
            $(".con_date").text(data.confirmation_date);
            $(".date_of_joining").text(data.joining_date);
            $(".cv").val(data.cv);
            $(".image").append('<img style="width: 110px;" src="' + data.employe_photo + '" />');

          }
      });
    });

    $(document).on("click",".download",function(){
      var cv = $(".cv").val();
      $.ajax({
          url:'/download_cv',
          type:'post',
          data:{
                "_token":"{{ csrf_token() }}",
                'cv':cv,
          },
          success:function(data)
          {
            console.log(data)
          },
      });
    });
  });
</script>