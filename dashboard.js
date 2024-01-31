const tables = document.querySelectorAll('.scrollable');

window.onscroll = function() {
  const scrolledPixels = window.scrollY;

  tables.forEach(table => {
    if (scrolledPixels >= 200) {
      table.classList.add('scrollable');
    } else {
      table.classList.remove('scrollable');
    }
  });
};