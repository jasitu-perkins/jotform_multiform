// Error message accessibility fix
document.addEventListener("DOMContentLoaded", function () {
  // Select all elements with the .form-line class
  var elements = document.querySelectorAll(".form-line");

  // Create a new MutationObserver
  var observer = new MutationObserver(function(mutations) {
    mutations.forEach(function(mutation) {
      // Check if the mutation is an attribute mutation and the attribute name is 'class'
      if (mutation.type === "attributes" && mutation.attributeName === "class") {
        // Check if the mutation target contains a .error-navigation-message
        var errorMessage = mutation.target.querySelector(".error-navigation-message");
        if (errorMessage) {
          // If it does, find the .form-label within the same element
          var label = mutation.target.querySelector(".form-label");
          if (label) {
            // Trim the label text and remove the '*' character
            var labelText = label.textContent.trim();
            labelText = labelText.replace("*", "");
            // Update the error message
            errorMessage.textContent = labelText + " is required.";
            
            // Move the error message next to the label
            label.appendChild(errorMessage.parentNode);
          }
        }
      }
    });
  });

  // Define the configuration for the observer
  var config = { attributes: true, childList: true, subtree: true, attributeFilter: ['class'] };

  // Observe each element with the .form-line class
  elements.forEach(function(element) {
    observer.observe(element, config);
  });
});
