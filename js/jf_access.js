document.addEventListener("DOMContentLoaded", function () {
    // Select all elements with the .form-line class
    var elements = document.querySelectorAll(".form-line");
    // Flag to track if the submit button has been clicked
    var submitClicked = false;
    // Flag to track if there are any .form-line-error elements
    var hasFormLineError = false;
   
    // Define the configuration for the observer
    var config = { attributes: true, childList: true, subtree: true, attributeFilter: ['class'] };
   
    // Error container appended field title message and move next to field label
    var errorObserver = new MutationObserver(function(mutations) {
      mutations.forEach(function(mutation) {
        // Check if the mutation is an attribute mutation and the attribute name is 'class'
        if (mutation.type === "attributes" && mutation.attributeName === "class") {
          // Check if the mutation target contains a .form-error-message
          var errorMessageContainer = mutation.target.querySelector(".form-error-message");
          if (errorMessageContainer) {
            // If it does, find the .form-label within the same element
            var label = mutation.target.querySelector(".form-label");
            if (label) {
              // Only update the error message if it hasn't been updated yet
              var errorMessage = errorMessageContainer.querySelector(".error-navigation-message");
              if (!errorMessageContainer.dataset.updated) {
                // Trim the label text and remove the '*' character
                var labelText = label.textContent.trim().replace("*", "");
                // Update the error message
                errorMessage.textContent = labelText + " is required.";
                // Mark the error message container as updated
                errorMessageContainer.dataset.updated = 'true';
                
                // Assign a unique ID to the error message container
                errorMessageContainer.id = "errormsg_" + label.id.replace("label_", "");
                
                // Update the aria-labelledby attribute of the input to reference the error message container ID
                var input = mutation.target.querySelector("input");
                if (input) {
                  input.setAttribute('aria-labelledby', errorMessageContainer.id);
                }
                
                // Add aria-live="assertive" to the .error-navigation-message element
                errorMessage.setAttribute('aria-live', 'assertive');
              }
              // Move the error message container next to the label only if it hasn't been moved before
              if (!errorMessageContainer.dataset.moved) {
                label.appendChild(errorMessageContainer);
                errorMessageContainer.dataset.moved = 'true';
              }
            }
          }
          // Check if the .form-line-error class was added
          if (mutation.target.classList.contains('form-line-error')) {
            hasFormLineError = true;
            // Add display: none to .form-error-message only if submitClicked is false
            var errorMessage = mutation.target.querySelector(".form-error-message");
            if (errorMessage && !submitClicked) {
              errorMessage.style.display = 'none';
            }
            // Hide the label from screen readers
            var label = mutation.target.querySelector(".form-label");
            if (label) {
              label.setAttribute('aria-hidden', 'true');
            }
            // Remove .form-validation-error class if it exists and submitClicked is false
            var validationError = mutation.target.querySelector(".form-validation-error");
            if (validationError && !submitClicked) {
              validationError.classList.remove("form-validation-error");
            }
          }
          
          // Add alt text to images inside .form-error-message divs
          var images = mutation.target.querySelectorAll(".form-error-message img");
          images.forEach(function(image) {
            // Set the alt attribute of the image
            image.setAttribute("alt", "");
          });
        }
      });
    });
   
    // Observe each element with the .form-line class for error message accessibility fix
    elements.forEach(function(element) {
      errorObserver.observe(element, config);
    });
   
    // Add and show all errors once submit button is clicked
    var submitButton = document.querySelector("button[type='submit']");
   
    // Add event listener for the submit button
    if (submitButton) {
      submitButton.addEventListener("click", function(event) {
        // Set the flag to indicate the submit button was clicked
        submitClicked = true;
   
        // When the submit button is clicked, add the .form-line-error class back
        elements.forEach(function(element) {
          // Check if .form-validation-error class was removed
          var validationError = element.querySelector(".form-validation-error");
          if (validationError) {
            // Re-add the .form-validation-error class
            validationError.classList.add("form-validation-error");
          }
        });
   
        // Show the error div and focus the first invalid field if there are any .form-line-error elements
        if (hasFormLineError) {
          var errorMessages = document.querySelectorAll(".form-error-message");
          errorMessages.forEach(function(errorMessage) {
            errorMessage.style.display = 'block'; // or 'inline' depending on your layout
          });
          var firstInvalidField = document.querySelector(".form-line-error input");
          if (firstInvalidField) {
            firstInvalidField.focus();
          }
        }
      });
    }
});

// Add a form label to the HTML element with the name attribute "website"
var inputElement = document.querySelector("input[name='website']");
if (inputElement) {
    // Create a label element
    var label = document.createElement("label");
    label.textContent = "Website: "; // Set the label text
    label.htmlFor = "website"; // Set the 'for' attribute to match the input's 'id'

    // Insert the label before the input field
    inputElement.parentElement.insertBefore(label, inputElement);

    // Ensure the input has an 'id' attribute that matches the label's 'for' attribute
    if (!inputElement.id) {
        inputElement.id = "website";
    }
}