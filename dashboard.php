<?php
$servername = "localhost";
$db_username = "your_db_username";
$db_password = "your_db_password";
$dbname = "mbzstore";

$conn = mysqli_connect('localhost', 'root', '', 'mbzstore');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
};


session_start();

if (!isset($_SESSION['admin_username'])) {
    header("Location: admin_login.php"); // Redirect to login page if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="icon" href="assets/img/favicon.png">
  <link rel="stylesheet" href="dashboard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


</head>

<body>
  <?php include 'dashboard_header.php'; ?>

  <div class="container">
    <?php include 'sidebar.php'; ?>

    <div class="content">
    <h3>Welcome, <?php echo $_SESSION['admin_username']; ?>!</h3>

      <h2>Dashboard <i class="fa-solid fa-house-user"></i></h2>
      <div class="containe">
        <div class="card">
            <div class="row">
                 <h2><script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                  <lord-icon
                      src="https://cdn.lordicon.com/nrtdaiif.json"
                      trigger="loop"
                      delay="2000"
                      colors="primary:#646e78,secondary:#2ca58d,tertiary:#ebe6ef"
                      style="width:100px;height:100px">
                  </lord-icon></h2>
            <div class="column">
                <h1>5</h1>
                <p >Total Users</p>
            </div>
            </div>     
        </div>
        
        <div class="card">
            <div class="row">
                 <h2><script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                  <lord-icon
                      src="https://cdn.lordicon.com/qmcsqnle.json"
                      trigger="loop"
                      delay="2000"
                      colors="primary:#ffc738,secondary:#b26836"
                      style="width:100px;height:100px">
                  </lord-icon></h2>
            <div class="column">
                <h1>20</h1>
                <p >Today Payments</p>
            </div>
            </div>        
        </div>

        <div class="card">
            <div class="row">
                 <h2><script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                  <lord-icon
                      src="https://cdn.lordicon.com/hcowevpv.json"
                      trigger="loop"
                      delay="2000"
                      colors="primary:#ebe6ef,secondary:#08a88a"
                      style="width:100px;height:100px">
                  </lord-icon></h2>
            <div class="column">
                <h1>30</h1>
                <p >Total Payments</p>
            </div>
            </div>  
        </div>

        <div class="card">
            <div class="row">
                 <h2><script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                  <lord-icon
                      src="https://cdn.lordicon.com/flvisirw.json"
                      trigger="loop"
                      delay="2000"
                      colors="primary:#646e78,secondary:#4bb3fd,tertiary:#ebe6ef"
                      style="width:100px;height:100px">
                  </lord-icon></h2>
            <div class="column">
                <h1>50</h1>
                <p >Total Customers</p>
            </div>
            </div>        
        </div>

        <div class="card">
            <div class="row">
                 <h2><script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
<lord-icon
    src="https://cdn.lordicon.com/ckatldkn.json"
    trigger="loop"
    delay="2000"
    colors="primary:#646e78,secondary:#08a88a,tertiary:#ebe6ef"
    style="width:100px;height:100px">
</lord-icon></h2>
            <div class="column">
                <h1>15</h1>
                <p >Total Products</p>
            </div>
            </div>    
        </div>
        
        <div class="card">
          <div class="row">
               <h2><script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
          <lord-icon
              src="https://cdn.lordicon.com/iepbfivp.json"
              trigger="loop"
              delay="2000"
              colors="primary:#121331,secondary:#4bb3fd,tertiary:#ebe6ef"
              style="width:100px;height:100px">
          </lord-icon></h2>
          <div class="column">
              <h1>50</h1>
              <p >Total Subscribers</p>
          </div>
          </div>    
      </div>

      <div class="card">
        <div class="row">
             <h2><script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
              <lord-icon
                  src="https://cdn.lordicon.com/dxoycpzg.json"
                  trigger="loop"
                  delay="2900"
                  colors="primary:#f24c00,secondary:#646e78,tertiary:#4bb3fd,quaternary:#ebe6ef,quinary:#f9c9c0"
                  style="width:100px;height:100px">
              </lord-icon></h2>
        <div class="column">
            <h1>50</h1>
            <p >Total Contact Forms</p>
        </div>
        </div>    
    </div>

    <div class="card">
      <div class="row">
           <h2><script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
            <lord-icon
                src="https://cdn.lordicon.com/gkstbnbz.json"
                trigger="loop"
                delay="2900"
                colors="primary:#121331,secondary:#b26836,tertiary:#ffc738"
                style="width:100px;height:100px">
            </lord-icon></h2>
      <div class="column">
          <h1>50</h1>
          <p >Total Partners</p>
      </div>
      </div>    
  </div>
  
      </div>
      
      <div class="contai">
        <div class="car">
          <h3>MBZ Recent Agenda <i class="fa-solid fa-calendar-days"></i></h3>
          <div class="scroll-container">
            <div class="agenda">
                <h4>Topic</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, laboriosam quis unde doloremque, provident soluta voluptatibus itaque dignissimos, odio cum eos vel quidem similique explicabo. Fugit delectus tempora nulla dolore.</p>
            <div class="tems">
                <img src="blank-profile-picture-973460_640.png" alt="Agenda 1 Image">
              <div class="con">
              <p > John Doe </p>
              <p class="good two">CEO</p>          
              </div> 
              </div>
            </div>
    
          </div>
        </div>
        <div class="car">
          <h3>To-Do List <i class="fa-solid fa-list-check"></i></h3>
          <div class="scroll-container">
            <ul class="todo">
              <li>Finish project proposal</li>
              <li>Follow up with clients</li>
              <li>Send out status report</li>
              <li>Finish project proposal</li>
              <li>Follow up with clients</li>
              <li>Send out status report</li>
              <li>Finish project proposal</li>
              <li>Follow up with clients</li>
              <li>Send out status report</li>
              <!-- Add more to-do items here -->
            </ul>
          </div>
        </div>
      </div>

      <div class="both">
        <div class="crazy">
            <h3>Users <i class="fa-solid fa-users"></i></h3>
      <table>
        <tr>
          <th>Profile Picture</th>
          <th>Full Name</th>
          <th>Position</th>
          
        </tr>
        <tr>
          <td><img src="blank-profile-picture-973460_640.png" alt="John Doe"></td>
          <td>John Doe</td>
          <td>Admin</td>
          
        </tr>
        <tr>
          <td><img src="blank-profile-picture-973460_640.png" alt="Jane Smith"></td>
          <td>Jane Smith</td>
          <td>Users</td>
        </tr>
        <!-- Add more members and their profile pictures as needed -->
      </table>
        </div>
        <div class="cry">
            <h3>Services <i class="fa-solid fa-users-line"></i></h3>
      <table>
        <tr>
          <th>S/N</th>
          <th>Services</th>
          <th>Price</th>
        </tr>
        <tr>
          <td>1</td>
          <td>Web Development</td>
          <td>$1000</td>
        </tr>
        <tr>
          <td>2</td>
          <td>App Development</td>
          <td>$1000</td>
        </tr>
        
        <!-- Add more members and their profile pictures as needed -->
      </table>
        </div>
    </div>


    <?php include 'nav.php'; ?>
  </div>


  <script src="dashboard.js"></script>
  <script>
    function toggleSidebar() {
      var sidebar = document.getElementById("sidebar");
      sidebar.classList.toggle("sidebar-expanded");

      var navbar = document.getElementById("navbar");
      navbar.classList.toggle("navbar-expanded");

      var content = document.querySelector(".content");
      content.classList.toggle("content-shifted");
    }

  </script>
</body>

</html>
