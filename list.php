<?php session_start();
include 'dbconfig.php';
  date_default_timezone_set("ASIA/DHAKA");
  $date = date("D, d-m-Y ");
  $time = date("h:i:s A");

  //echo $date." // ".$time;

 ?>


<!-- PHP Code Starts -->
<?php 
//Ticket NO
if (isset($_POST['ticketno'])) {
  $visitor_ticket_no="";
}

//Logout
if(isset($_POST['logout']))
{
  $visitor_logout_date=$date;
  $visitor_logout_time=$time;
  $visitor_log_status=$_POST['visitor_log_status'];
  $visitor_ticket_no=$_POST['visitor_ticket_no'];
 //<!-- INSERT INTO `visitors`(`visitor_id`, `visitor_name`, `visitor_gender`, `visitor_email`, `visitor_mobile`, `visitor_purpose`, `visitor_login_date`, `visitor_login_time`, `visitor_logout_date`, `visitor_logout_time`, `visitor_log_status`, `visitor_ticket_no`) VALUES -->
   $insertdb="UPDATE visitors SET visitor_logout_date='$visitor_logout_date',visitor_logout_time='$visitor_logout_time',visitor_log_status='$visitor_log_status' WHERE visitor_ticket_no='$visitor_ticket_no'";

  if(mysqli_query($con, $insertdb))
  {
    echo "<script type='text/javascript'>alert('Logged Out successfully!!! ".$visitor_ticket_no."')</script>";
    //$visitor_ticket_no="";
  
  }
  else {
    echo " Error!!Logged Out NOT inserted! ! !";
  }
}

//Visitor LOG In
if(isset($_POST['login']))
{
  
  $visitor_name=$_POST['visitor_name'];
  $visitor_gender=$_POST['visitor_gender'];
  $visitor_email=$_POST['visitor_email'];
  $visitor_mobile=$_POST['visitor_mobile'];
  $visitor_purpose=$_POST['visitor_purpose'];
  $visitor_login_date=$date;
  $visitor_login_time=$time;
  // $visitor_login_date=$_POST['visitor_login_date'];
  // $visitor_login_time=$_POST['visitor_login_time'];
  $visitor_log_status=$_POST['visitor_log_status'];

  //Visitor Ticket no 
  $visitor_ticket_no= date("dmyhis")."00".mt_rand(1,99);
   
    
  $insertdb="INSERT INTO visitors (visitor_name,visitor_gender,visitor_email,visitor_mobile,visitor_purpose,visitor_login_date, visitor_login_time,visitor_log_status,visitor_ticket_no)VALUES('$visitor_name', '$visitor_gender', '$visitor_email', '$visitor_mobile', '$visitor_purpose', '$visitor_login_date', '$visitor_login_time', '$visitor_log_status','$visitor_ticket_no')";

  if(mysqli_query($con, $insertdb))
  {
echo "<script type='text/javascript'>alert('Logged in successfully!!! ".$visitor_ticket_no."')</script>";
  
  }
  else {
    echo " Error!!NOT inserted! ! !";
  }

}

?>
<!-- PHP Code ends -->
<!--==============================================  Header ==================================== -->
<?php include 'header.php'; ?>
<!-- =============================================  Header   ======================================  -->


<!-- 
=======================================================Body=======================================================
-->

<div class="row bg-dark">
  <div class="col-md-12 col-sm-12">
    <div class="bg-dark p-4">


      <h1 class="my-1 mx-auto pt-3 pb-1 display-1 text-success text-center "><em>Log Manager List</em></h1>
      <hr class="my-4 mx-auto bg-success" width="50%">


      <p class="m-1 pt-2 pb-1 lead text-light text-center">
       The list below Displays all the visitors ordered by date:
      </p>

      <hr class="my-1 mx-1 bg-light">

     <div class="row">
      <div class="col-md-6 offset-md-3  p-2 lead text-success text-center">
        <a class="btn btn-success btn-lg btn-block m-3" href="#" role="button" data-toggle="modal" data-target="#ModalVisitor">Visitor Login</a>
        <a class="btn btn-success btn-lg btn-block m-3" href="#" role="button"  data-toggle="modal" data-target="#ModalVisitorLogout">Visitor Logout</a>
      </div>
     <!--  <div class="col-md-6   p-2 lead text-success text-center">
        <a class="btn btn-success btn-lg btn-block m-3" href="#" role="button">Staff Login</a>
        <a class="btn btn-success btn-lg btn-block m-3" href="#" role="button">Staff Logout</a>
      </div> -->
    </div>
<hr class="my-1 mx-1 bg-light">



<div class="row bg-dark">
  <div class="col-md-12 col-sm-12">
    <div class="bg-dark p-4">


      <h1 class="my-1 mx-auto pt-2 pb-1 text-success text-center "><em>Log Manager List</em></h1>
		<hr class="my-1 mx-1 bg-light">
		<!-- Table of Visitors -->
		<table class="text-success table table-bordered-light">
		  <thead>
		    <tr>
		      <th scope="col">Date</th>
		      <th scope="col">Log Status</th>
		      <th scope="col">Login Time | Logout Time</th>
		      <th scope="col">Name </th>
		      <th scope="col">Details</th>
		      
		    </tr>
		  </thead>
		  <tbody>
		    
		  
		<?php 
			//<!-- INSERT INTO `visitors`(`visitor_id`, `visitor_name`, `visitor_gender`, `visitor_email`, `visitor_mobile`, `visitor_purpose`, `visitor_login_date`, `visitor_login_time`, `visitor_logout_date`, `visitor_logout_time`, `visitor_log_status`, `visitor_ticket_no`) VALUES -->

			$query= "SELECT*FROM visitors ORDER BY visitor_login_date DESC";
					            $result= mysqli_query($con, $query);
					            $num_rows=mysqli_num_rows($result);
					            
					            if ($num_rows > 0){
              						while ($row = mysqli_fetch_assoc($result)){
		 ?>

		 				<tr>
					      <th scope="row"><?php echo $row['visitor_login_date']; ?></th>
					      <td>
					      	<p class="m-1">Status  :<?php echo $row['visitor_log_status']; ?> </p> 
					      	<p class="m-1">Ticket no. :<?php echo $row['visitor_ticket_no']; ?> </p> 
					      	
					      	
					      </td>
					      <td><?php echo "From  ".$row['visitor_login_time']."  to ".$row['visitor_logout_time']; ?></td>
					      <td><?php echo $row['visitor_name']; ?></td>
					      <td>
					      	<p class="m-1 lead ">Gender  :<?php echo $row['visitor_gender']; ?> </p> 
					      	<p class="m-1 lead ">Mobile  :<?php echo $row['visitor_mobile']; ?> </p> 
					      	<p class="m-1 lead ">Email   :<?php echo $row['visitor_email']; ?> </p>
 					      	<p class="m-1 lead ">Purpose :<?php echo $row['visitor_purpose']; ?> </p>
					      	
					      </td>
					    </tr>


		 <?php 
		 							}
		 						}

		  ?>
		   </tbody>
		</table>
		<!-- Table of Visitors -->

		<hr class="my-1 mx-1 bg-light">
	</div>
  </div>
</div>
























<!-- Visitor Logout form -->
<div class="row bg-dark">
  <div class="col-md-12">
    <!-- Modal -->
          <div class="modal fade " id="ModalVisitorLogout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg bg-dark" role="document">
              
              <form method="POST" enctype="multipart/form-data" class="form form-lg">
                <!-- Form -->
              <div class="modal-content bg-dark">
                <div class="modal-header">
                  <h3 class="modal-title text-success text-center" id="exampleModalLongTitle">Visitor Login Form</h3>
                  <button type="button" class="close text-success" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                
                <div class="modal-body text-success bg-dark">

                      <!-- INSERT INTO `visitors`(`visitor_id`, `visitor_name`, `visitor_gender`, `visitor_email`, `visitor_mobile`, `visitor_purpose`, `visitor_login_date`, `visitor_login_time`, `visitor_logout_date`, `visitor_logout_time`, `visitor_log_status`, `visitor_ticket_no`) VALUES -->

                      <div class="form-group row">
                        <label for="Name" class="col-md-2 col-form-label"><?php echo "Date | Time "; ?></label>
                        <label for="Name" class="col-md-6 col-form-label"><?php echo $date."| ".$time; ?></label>
                        <input type="hidden" class="form-control" name="visitor_log_status" value="Logged Out ">

                      </div>
                      <div class="form-group row">
                        <label for="Name" class="col-md-2 col-form-label">Your Ticket no</label>
                        <div class="col-md-10">
                          <input type="text" name="visitor_ticket_no" class="form-control" id="Name"  placeholder="Ticket no #0232280820">
                        </div>
                      </div>   
                     
                </div>
                <div class="modal-footer">
                  <button type="submit" name="logout" class="btn btn-lg btn-block btn-outline-success" > Log Out </button>

                  <button type="button" class="btn btn-lg btn-outline-success" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
              <!-- Form -->
            </form>
          </div>
  </div>
</div>
<!-- Visitor Logout form -->


<!-- //Login Form// -->
<div class="row bg-dark">
  <div class="col-md-12">
    <!-- Visitor form -->
      <div class="row bg-dark">
        <div class="col-md-12">
          <!-- Visitorform -->
          <!-- Button trigger modal -->
         <!--  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalVisitor">
            Launch demo modal
          </button>
 -->
          <!-- Modal -->
          <div class="modal fade " id="ModalVisitor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg bg-dark" role="document">
              
              <form method="POST" enctype="multipart/form-data" class="form form-lg">
                <!-- Form -->
              <div class="modal-content bg-dark">
                <div class="modal-header">
                  <h3 class="modal-title text-success text-center" id="exampleModalLongTitle">Visitor Login Form</h3>
                  <button type="button" class="close text-success" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                
                <div class="modal-body text-success bg-dark">

                  <!-- INSERT INTO `visitors`(`visitor_id`, `visitor_name`, `visitor_gender`, `visitor_email`, `visitor_mobile`, `visitor_purpose`, `visitor_login_date`, `visitor_login_time`, `visitor_logout_date`, `visitor_logout_time`, `visitor_log_status`, `visitor_ticket_no`) VALUES -->

                

                   
                      <div class="form-group row">
                        <label for="Name" class="col-md-2 col-form-label"><?php echo "Date | Time "; ?></label>
                        <label for="Name" class="col-md-6 col-form-label"><?php echo $date."| ".$time; ?></label>
                  <!--       <input type="hidden" class="form-control" name="visitor_login_date" value="<?php echo $date; ?>">
                        <input type="hidden" class="form-control" name="visitor_login_time" value="<?php echo $time; ?>"> -->
                        <input type="hidden" class="form-control" name="visitor_log_status" value="Logged in">

                      </div>
                      <div class="form-group row">
                        <label for="Name" class="col-md-2 col-form-label">Name</label>
                        <div class="col-md-10">
                          <input type="text" name="visitor_name" class="form-control" id="Name"  placeholder="Your Name ">
                        </div>
                      </div>   
                      <div class="form-group row">
                        <label for="Email" class="col-md-2 col-form-label">Email</label>
                        <div class="col-md-10">
                          <input type="email" name="visitor_email" class="form-control" id="Email" placeholder="Your Email">
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="mobile" class="col-md-2 col-form-label">Mobile</label>
                        <div class="col-md-6">
                          <input type="text" name="visitor_mobile" class="form-control" id="mobile" placeholder="Your Mobile">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="Gender" class="col-md-2 col-form-label">Gender</label>
                        <div class="col-md-6">
                          <select type="text" class="custom-select" id="Gender" name="visitor_gender">
                            <option selected>Gender</option>
                            <option value="Male">Male </option>
                            <option value="Female">Female</option>
                            <option value="Others">Others</option>
                          </select>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="purpose" class="col-md-2 col-form-label">Purpose of visit</label>
                        <div class="col-md-10">
                          <textarea type="text" name="visitor_purpose" class="form-control" id="purpose" placeholder="Purpose of your visit"></textarea>
                        </div>
                      </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" name="login" class="btn btn-lg btn-block btn-outline-success" data-toggle="modal" data-target="#TicketNo">Get Ticket NO & Login </button>

                  <button type="button" class="btn btn-lg btn-outline-success" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
              <!-- Form -->
            </form>
          </div>
          <!-- Visitorform -->



        </div>
      </div>
    <!-- Visitor form -->
  </div>
</div>
<!-- //Login Form// -->


<!-- 
========================================================Body=======================================================
-->


<!--==============================================  footer  ==================================== -->
<?php include 'footer.php'; ?>
<!-- =============================================  footer  ======================================  -->
   
