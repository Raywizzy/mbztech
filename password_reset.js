document.addEventListener('DOMContentLoaded', function () {
    const resetForm = document.getElementById('resetForm');
    const resetMessage = document.getElementById('resetMessage');
  
    resetForm.addEventListener('submit', function (event) {
      event.preventDefault();
      const email = resetForm.elements.email.value;
      // Perform your password reset logic here
      // For this example, we'll just display a success message
      resetMessage.textContent = `Password reset link sent to ${email}.`;
      resetForm.reset();
    });
  });
  