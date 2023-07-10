<?php

include 'head.php';
include 'db_connect.php';

session_start();
if (!isset($_SESSION['username'])) {
     header("location:login.php");
     die();
}



 ?>


<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">
  <head>

    <link rel="stylesheet" href="css\bootstrap.min.css">


    <script src="https://kit.fontawesome.com/26250a0a21.js" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.1/css/fontawesome.min.css" integrity="sha384-zIaWifL2YFF1qaDiAo0JFgsmasocJ/rqu7LKYH8CoBEXqGbb9eO+Xi3s6fQhgFWM" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0-beta1/css/bootstrap.min.css" />


    <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">

    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- Add jquery cdn -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <!--<title> Drop Down Sidebar Menu | CodingLab </title>-->
    <link rel="stylesheet" href="style.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <style>

     .submenu{
       font-size: 28px;

     }

     </style>
   </head>
<body>
  <div class="sidebar close">
    <div class="logo-details">
      <img src="logo.png" class="logo-img ms-1 mt-2 me-1" alt="" style="width:60px; height:60px; background-color:#fff; border-radius:15px;">

      <span class="logo_name ms-1" style="font-size: 18px;">Event planner dashboard</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="event_planner_dashboard.php?dashboard=<?php

        $username = $_SESSION['username'];
      $sql = "SELECT id FROM users WHERE email = '$username'";
      $result = mysqli_query($conn, $sql);

      if ($row = mysqli_fetch_assoc($result)) {
          echo $row['id'];
      }
       ?>">
          <i class='bx bx-grid-alt' ></i>
          <span class="link_name">Dashboard</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Dashboard</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class="fa fa-calendar-o"></i>
            <span class="link_name">Event</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu mt-1">
          <li><a class="link_name mt-1" href="#">Event</a></li>
          <li><a href="event_planner_dashboard.php?book_venue" style="font-size:20px;">Book Venue</a></li>
          <li><a href="event_planner_dashboard.php?create_event" style="font-size:20px;">Create Event</a></li>
          <li><a href="event_planner_dashboard.php?manage_event" style="font-size:20px;">Manage Event</a></li>

                 <!--in Service-->


               </ul>
             </li>


             <li>
               <div class="iocn-link">
                 <a href="#">
                   <i class="fa fa-cutlery"></i>
                   <span class="link_name">Vendors</span>
                 </a>
                 <i class='bx bxs-chevron-down arrow' ></i>
               </div>
               <ul class="sub-menu mt-1">
                 <li><a class="link_name mt-1" href="#">Vendors</a></li>
                 <li><a href="event_planner_dashboard.php?add_vendor" style="font-size:20px;">Add Vendor</a></li>

                 <li><a href="event_planner_dashboard.php?manage_vendor" style="font-size:20px;">Manage Vendor</a></li>

                        <!--in Service-->


                      </ul>
                    </li>


             <!--hdhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh-->
             <li>
               <div class="iocn-link">
                 <a href="#">
                   <i class="fa-solid fa-file"></i>
                   <span class="link_name">Reports</span>
                 </a>
                 <i class='bx bxs-chevron-down arrow' ></i>
               </div>
               <ul class="sub-menu mt-1">


                 <li><a href="event_planner_dashboard.php?event_reports" style="font-size:20px" >Event Reports</a></li>
                




                      </ul>
                    </li>




<li>
        <a href="staff_logout.php">
          <i class='bx bx-log-out'></i>
          <span class="link_name">Log Out</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="staff_logout.php">Log Out</a></li>
        </ul>
      </li>
  </div>
  <section class="home-section mt-2" id="dash_section" >
    <div class="home-content">
      <i class='bx bx-menu' ></i>
      <span class="text">Event Planner Dashboard</span>
    </div>
  </section>
  <div class="row">


  <div class="col-6">

  </div>

  <div class="col-sm-5 my-2 col-md-9 offset-md-0 mt-3">


    <?php

    if (isset($_GET['dashboard'])) {

      include ('events_planner.php');
      // code...
    }



    if (isset($_GET['manage_event'])) {

      include ('manage_events.php');
      // code...
    }


    if (isset($_GET['book_venue'])) {

      include ('book_event.php');
      // code...
    }

    if (isset($_GET['create_event'])) {

      include ('create_event.php');
      // code...
    }

    if (isset($_GET['add_vendor'])) {

      include ('add_vendor.php');
      // code...
    }

    if (isset($_GET['manage_vendor'])) {

      include ('manage_vendor.php');
      // code...
    }



    //if (isset($_GET['manage_staff'])) {

    //  include ('manage_staff.php');
      // code...
  //  }

    if (isset($_GET['event_reports'])) {

      include ('event_reports.php');
      // code...
    }

    //sub menus









     ?>
       </div>
         </div>

  <script>
  let arrow = document.querySelectorAll(".arrow");
  for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e)=>{
   let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
   arrowParent.classList.toggle("showMenu");
    });
  }
  let sidebar = document.querySelector(".sidebar");
  let sidebarBtn = document.querySelector(".bx-menu");
  console.log(sidebarBtn);
  sidebarBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("close");
  });
  </script>


  <script type="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>



      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>

</body>
</html>
