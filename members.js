function enableEditRow(editButton) {
  const tableRow = editButton.parentNode.parentNode;
  tableRow.classList.add('edit-mode'); // Add a class to indicate edit mode

  const tableDataCells = tableRow.getElementsByTagName('td');

  // Iterate through each data cell (except the Date/Time and Amount Owed cells) and replace the content with input fields
  for (let i = 1; i < tableDataCells.length - 3; i++) {
    const cellText = tableDataCells[i].innerText;
    tableDataCells[i].innerHTML = `<input type="text" value="${cellText}" ${i === 1 ? '' : 'oninput="addCommas(event)"'}>`;
  }
}

function addCommas(event) {
  const input = event.target;
  const value = input.value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  input.value = value;
}

function saveEditRow(saveButton) {
  const tableRow = saveButton.parentNode.parentNode;
  tableRow.classList.remove('edit-mode'); // Remove the edit mode class

  const tableDataCells = tableRow.getElementsByTagName('td');

  // Iterate through each data cell (except the Date/Time and Amount Owed cells) and retrieve the input field value
  for (let i = 1; i < tableDataCells.length - 3; i++) {
    const inputValue = tableDataCells[i].querySelector('input').value;
    tableDataCells[i].innerText = inputValue;
  }

  // Calculate and update the Amount Owed cell after saving the edits
  const annualPaymentCell = tableRow.querySelector('.annual-payment');
  const amountPaidCell = tableRow.querySelector('.amount-paid');
  const amountOwedCell = tableRow.querySelector('.amount-owed');

  const annualPayment = parseFloat(annualPaymentCell.innerText.replace(',', ''));
  const amountPaid = parseFloat(amountPaidCell.innerText.replace(',', ''));

  const amountOwed = annualPayment - amountPaid;
  amountOwedCell.innerText = formatNumber(amountOwed);
}

// Function to format the number with commas
function formatNumber(number) {
  return number.toLocaleString('en-US');
}
