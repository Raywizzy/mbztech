<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add News</title>
  <link rel="icon" href="WhatsApp Image 2023-03-13 at 15.14.46_auto_x2 (1).png">
  <link rel="stylesheet" href="upload_news.css">
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
      <h2>Add News <i class="fa-solid fa-plus"></i></h2>

      <form id="newsForm" enctype="multipart/form-data">
        <div class="slider-item">
          <div class="image-container">
            <input type="file" accept="image/*" class="image-input" onchange="handleImageChange(event)">
            <img src="WhatsApp Image 2023-03-13 at 15.14.46_auto_x2.png" alt="Slider Image 1">
            <div class="image-caption">
              <i class="fa-solid fa-image"></i>
              <span>Change Image</span>
            </div>
          </div>
          <div class="caption-content">
            <input type="text" class="slider-title" placeholder="Title ">
            <textarea class="slider-subtitle-textarea" placeholder="Subtitle "></textarea>
            <button type="button" class="save-button" onclick="saveToPreview()">Save To Preview</button>
          </div>
        </div>
      </form>

      <button class="go-to-preview-button" onclick="goToPreview()">Go To Preview </button>

      <div class="preview">
        <div class="pre">
          <div class="title">Page Title</div>
          <div class="image-container">
            <img class="image" src="WhatsApp Image 2023-03-13 at 15.14.46_auto_x2.png" alt="Image">
          </div>
          <div class="subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima distinctio impedit
            officiis earum, consectetur molestiae fugiat ipsam excepturi ex ab debitis asperiores. Quasi nisi iste,
            eaque animi architecto aspernatur.</div>
        </div>

        <div class="message"></div>
        <button class="upload-button" onclick="uploadToDatabase()">Upload News</button>
      </div>

      <?php include 'nav.php'; ?>
    </div>

    <script src="upload_news.js"></script>
</body>

</html>
