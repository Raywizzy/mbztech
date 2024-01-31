<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Theme Setting</title>
  <link rel="icon" href="WhatsApp Image 2023-03-13 at 15.14.46_auto_x2 (1).png">
  <link rel="stylesheet" href="theme.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


</head>

<body>
  <?php include 'dashboard_header.php'; ?>

  <div class="container">
    <?php include 'sidebar.php'; ?>

    <div class="content" id="content">
      
        <h2>Theme Settings <i class="fa-solid fa-gears"></i>  </h2>
        <div class="theme-section">
      
            <label>
                <input type="radio" name="theme" value="light" checked>
                <i class="fa-solid fa-sun"></i> Light Theme
            </label>
            <label>
                <input type="radio" name="theme" value="dark">
                <i class="fa-solid fa-moon"></i> Dark Theme
            </label>
        </div>


        <?php include 'nav.php'; ?>
  </div>

  <script src="theme.js"></script>
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
