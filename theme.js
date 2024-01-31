document.addEventListener('DOMContentLoaded', function () {
    // Get the theme radio buttons
    const themeRadios = document.getElementsByName('theme');
  
    // Function to set the theme
    function setTheme(theme) {
      document.#content.classList.remove('light', 'dark');
      document.#content.classList.add(theme);
      // Save the selected theme to local storage
      localStorage.setItem('theme', theme);
    }
  
    // Set the initial theme based on the user's preference (if available)
    const storedTheme = localStorage.getItem('theme');
    if (storedTheme) {
      setTheme(storedTheme);
      const selectedRadio = Array.from(themeRadios).find(radio => radio.value === storedTheme);
      if (selectedRadio) {
        selectedRadio.checked = true;
      }
    }
  
    // Add event listeners to the theme radio buttons
    themeRadios.forEach(radio => {
      radio.addEventListener('change', function () {
        if (this.checked) {
          const theme = this.value;
          setTheme(theme);
        }
      });
    });
  });
  