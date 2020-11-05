<?php
include('../includes/header.php');
include('../includes/navbar.php');


require_once  '../controller/OfficeController.php';
$APIController = new OfficeController();
$response = $APIController->List();
$responseData = json_decode($response, true);

$list = $responseData["list"];

if(isset($_GET['delid']))
{
  $id = $_GET['delid'];
$response = $APIController->Delete($id);
$responseData = json_decode($response, true);
 header('Location: office_list.php');
  } else {
    //echo $responseData["message"];
  }

?>

<div id="content-wrapper" class="d-flex flex-column">        
    
  <!-- Main Content -->
    
  <div id="content" class="bg-colour-f8f9fc">
    
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->


            <!-- Topbar Search -->


            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                    </div>
                </form>
                </div>
            </li>

            <!-- Nav Item - Alerts -->
            
            <!-- Nav Item - Messages -->
            

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                <?php
                      echo $_SESSION['username'];
                ?>
                </span>
                <img class="img-profile rounded-circle"  src="img/userprof.jpg" style="width:50px; height:40px;">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="Logout.php" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>


            </ul>

        </nav>     
     <div class="container-fluid">
       <div class="card shadow mb-4">
          <div class="card-body">
            <div class="table-responsive">
              
                <div class="card-header py-3 btn btn-block btn-primary active">
                <h6 class="m-0 font-weight-bold text-white" align="left">Officers Details</h6>
                </div>
                 
             
                  <br />
                  <table class="table table-striped table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>SI NO</th>
                            <th>Name</th>                       
                            <th>Designation</th>
                            <th>City Name</th>
                            <th>Mobile Number</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    
                    if(!$responseData["error"]){ 
                      $cnt=1;
                      foreach($list  as $key=>$value){
                        
                    ?>
                      <tr>
                          <td><?php echo $cnt;?></td>
                          <td><?php echo $list[$key]["name"];?></td>                       
                          <td><?php echo $list[$key]["designation"];?></td>
                          <td><?php echo $list[$key]["city_name"];?></td>                       
                          <td><?php echo $list[$key]["mobile"];?></td>
                          <td><?php echo $list[$key]["email"];?></td>
                          <td>&nbsp;&nbsp;<a href="office_update.php?id=<?php echo $list[$key]["id"];?>"><p class="fa fa-edit"></p></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <a href="office_list.php?delid=<?php echo $list[$key]["id"];?>"> <i class='fas fa-trash-alt' style='font-size:20px;color:red'></i></td>
                        </tr>

                     <?php 
                        $cnt=$cnt+1;
                        } } else {?>
                        <tr>
                        <th style="text-align:center; color:red;" colspan="6">No Record Found</th>
                        </tr>
                        <?php } ?>   

                    </tbody>
                  </table>
           
        
          </div>
       </div>

    </div>
</div>   

<?php
include('../includes/footer.php');
include('../includes/scripts.php');
?>            
