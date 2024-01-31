
// Function to handle image change when the "Change Image" caption is clicked
function handleImageChange(event) {
const fileInput = event.target;
const imageContainer = fileInput.parentElement;
const imageCaption = imageContainer.querySelector('.image-caption');
const imagePreview = imageContainer.querySelector('img');

const file = fileInput.files[0];
if (file) {
  const reader = new FileReader();
  reader.onload = function() {
    imagePreview.src = reader.result;
  };
  reader.readAsDataURL(file);
}
}

// Add event listeners to "Change Image" captions
const changeImageCaptions = document.querySelectorAll('.image-caption');
changeImageCaptions.forEach(caption => {
caption.addEventListener('click', function() {
  // Trigger the file input click event
  const fileInput = caption.parentElement.querySelector('.image-input');
  fileInput.click();
});
});


function saveToPreview() {
  console.log("Save to Preview button clicked");

  const imageElement = document.querySelector('.image-container img');
  const titleElement = document.querySelector('.slider-title');
  const subtitleElement = document.querySelector('.slider-subtitle-textarea');

  const formData = new FormData();
  formData.append('image_url', imageElement.src);
  formData.append('title', titleElement.value);
  formData.append('subtitle', subtitleElement.value);

  // Send data to the server using AJAX
  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'uploadd_news.php', true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      console.log(xhr.responseText);
      if (xhr.status === 200) {
        // Handle success response, if needed
      } else {
        // Handle error response, if needed
      }
    }
  };
  xhr.send(formData);
}


const uploadButtonElement = document.querySelector('.upload-button');

function goToPreview() {
  // Show the preview and upload button elements
  const previewElement = document.querySelector('.preview');
  previewElement.style.display = 'block';

  uploadButtonElement.style.display = 'block'; // Add this line
}


function populatePreview() {
  const imageElement = document.querySelector('.image-container img');
  const titleElement = document.querySelector('.slider-title');
  const subtitleElement = document.querySelector('.slider-subtitle-textarea');

  const preImageElement = document.querySelector('.pre .image');
  const preTitleElement = document.querySelector('.pre .title');
  const preSubtitleElement = document.querySelector('.pre .subtitle');

  preImageElement.src = imageElement.src;
  preTitleElement.textContent = titleElement.value;
  preSubtitleElement.textContent = subtitleElement.value;
}

function saveToPreview() {
  console.log("Save to Preview button clicked");
  populatePreview();
}

function uploadToDatabase() {
  const preImageElement = document.querySelector('.pre .image');
  const preTitleElement = document.querySelector('.pre .title');
  const preSubtitleElement = document.querySelector('.pre .subtitle');

  // Create a Blob object from the image URL
  fetch(preImageElement.src)
    .then(response => response.blob())
    .then(imageBlob => {
      const formData = new FormData();
      formData.append('image', imageBlob, 'image/jpeg'); // 'image.jpg' is a placeholder filename
      formData.append('title', preTitleElement.textContent);
      formData.append('subtitle', preSubtitleElement.textContent);

      // Send data to the server using AJAX
      const xhr = new XMLHttpRequest();
      xhr.open('POST', 'uploadd_news.php', true);
      xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          console.log(xhr.responseText);
          if (xhr.status === 200) {
            // Handle success response, if needed
          } else {
            // Handle error response, if needed
          }
        }
      };
      xhr.send(formData);
    })
    .catch(error => {
      console.error('Error fetching or processing the image:', error);
    });
}



function showMessage(message, type) {
  const messageElement = document.querySelector('.message');
  messageElement.textContent = message;

  if (type === 'success') {
    messageElement.classList.remove('error');
    messageElement.classList.add('success');
  } else {
    messageElement.classList.remove('success');
    messageElement.classList.add('error');
  }

  messageElement.style.display = 'block';

  // Hide the message after a certain period
  setTimeout(function () {
    messageElement.style.display = 'none';
  }, 3000); // Display for 3 seconds
}


