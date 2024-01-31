document.addEventListener("DOMContentLoaded", function() {
  var dropdownItems = document.querySelectorAll(".dropdown");

  dropdownItems.forEach(function(item) {
    item.addEventListener("click", function() {
      // Toggle active class on clicked dropdown
      this.classList.toggle("act");

      // Rotate the caret icon when dropdown is clicked
      var caretIcon = this.querySelector(".caret");
      if (caretIcon) {
        caretIcon.style.transform = this.classList.contains("act") ? "rotate(180deg)" : "rotate(0deg)";
      }
    });
  });
});

function toggleDropdown(item) {
  var dropdownMenu = item.nextElementSibling;
  var caret = item.querySelector('.caret'); // Get the caret element

  if (dropdownMenu.style.display === 'block') {
    dropdownMenu.style.display = 'none';
    caret.classList.remove('act'); // Remove the active class to reset the caret
  } else {
    dropdownMenu.style.display = 'block';
    caret.classList.add('act'); // Add the active class to rotate the caret
  }
}

