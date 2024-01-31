<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Form</title>
  <link rel="icon" href="assets/img/favicon.png">
  <link rel="stylesheet" href="contactform.css">
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
      
        <h2>Messages <i class="fa fa-envelope"></i></h2>

        <div class="table-container">
            <table>
              <thead>
                <tr>
                  <th>Full Name</th>
                  <th>Phone Number</th>
                  <th>Area of Interest</th>
                  <th>Email</th>
                  <th>Message</th>
                  <th>Date/Time</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>John Doe</td>
                  <td>(123) 456-7890</td>
                  <td>Web Development</td>
                  <td>john@example.com</td>
                  <td>Hello, I'm interested in your services.</td>
                  <td>2023-07-21 12:34:56</td>
                  <td>
                    <button class="reply-button" onclick="showReplyModal()">Reply</button>
                  </td>
                </tr>
                <tr>
                  <td>Jane Smith</td>
                  <td>(987) 654-3210</td>
                  <td>Graphic Design</td>
                  <td>jane@example.com</td>
                  <td>Can you send me more information?</td>
                  <td>2023-07-21 09:15:30</td>
                  <td>
                    <button class="reply-button" onclick="showReplyModal()">Reply </button>
                  </td>
                </tr>
                <!-- Add more rows as needed -->
              </tbody>
            </table>
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
