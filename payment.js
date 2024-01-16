document.addEventListener('DOMContentLoaded', function () {
    let cardNumInput = document.querySelector('#cardNum');
    
    cardNumInput.addEventListener('keyup', () => {
      let cNumber = cardNumInput.value;
      cNumber = cNumber.replace(/\s/g, "");
  
      if (Number(cNumber)) {
        cNumber = cNumber.match(/.{1,4}/g);
        cNumber = cNumber.join(" ");
        cardNumInput.value = cNumber;
      }
    });
  
    var form = document.getElementById('paymentForm');
  
    form.addEventListener('submit', function (event) {
      // Prevent the default form submission behavior
      event.preventDefault();
  
      // You can add additional form validation logic here if needed
  
      // Redirect to the next page (replace 'nextPage.html' with your actual next page URL)
      window.location.href = 'receipt.html';
    });
  });
  