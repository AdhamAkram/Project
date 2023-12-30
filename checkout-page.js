document.addEventListener('DOMContentLoaded', function () {
    // Get references to elements
    const creditRadio = document.getElementById('credit');
    const cashRadio = document.getElementById('cash');
    const paymentDetails = document.getElementById('paymentDetails');
    const ccName = document.getElementById('cc-name');
    const ccNumber = document.getElementById('cc-number');
    const ccExpiration = document.getElementById('cc-expiration');
    const ccCVV = document.getElementById('cc-cvv');
  
    // Function to validate credit card inputs
    const validateCreditCardInputs = () => {
      let isValid = true;
      const inputs = [ccName, ccNumber, ccExpiration, ccCVV];
  
      if (creditRadio.checked) {
        // Reset error classes for all inputs
        inputs.forEach((input) => {
          input.classList.remove('is-invalid');
        });
  
        // Validation for credit card inputs
        inputs.forEach((input) => {
          isValid = isValid && validateField(input);
        });
      }
  
      return isValid;
    };
  
    // Function to validate a single input field
    const validateField = (input) => {
      const value = input.value.trim();
      const isValid = value !== '';
  
      if (!isValid) {
        input.classList.add('is-invalid');
      } else {
        input.classList.remove('is-invalid');
      }
  
      return isValid;
    };
  
    // Function to handle form submission
    const handleSubmit = (event) => {
      if (!validateCreditCardInputs()) {
        event.preventDefault();
        event.stopPropagation();
  
        
      }
    };
  
    // Function to toggle payment details based on the selected payment method
    const togglePaymentDetails = () => {
      if (cashRadio.checked) {
        paymentDetails.classList.add('d-none'); // Hide payment details for cash
      } else {
        paymentDetails.classList.remove('d-none'); // Show payment details for credit
      }
    };
  
    // Add event listeners
    creditRadio.addEventListener('change', togglePaymentDetails);
    cashRadio.addEventListener('change', togglePaymentDetails);
    document.querySelector('form.needs-validation').addEventListener('submit', handleSubmit);
  
    // Additional event listeners for real-time validation on input change
    [ccName, ccNumber, ccExpiration, ccCVV].forEach((input) => {
      input.addEventListener('input', () => validateField(input));
    });
  });

  