// Add the 'redirect' class to all jotform-form elements in the footer
var footerForms = document.querySelector('footer').getElementsByClassName('jotform-form');
Array.from(footerForms).forEach(function(form) {
    form.classList.add('redirect');
});

// Check if any jotform-form elements in the main have a 'redirect' class
var mainForms = document.querySelector('main').getElementsByClassName('jotform-form');
var mainHasRedirect = Array.from(mainForms).some(function(form) {
    return form.classList.contains('redirect');
});

// If a 'redirect' class is found in the main, exit the script
if (mainHasRedirect) {
    return;
}

// Get all the submit buttons
var submitButtons = document.querySelectorAll('.form-submit-button');

// Store the original textContent of the buttons
var originalTextContents = Array.from(submitButtons).map(button => button.textContent);

// Loop over each form
Array.from(mainForms).forEach(function(form, formIndex) {
    // Create a new iframe element
    var iframe = document.createElement('iframe');

    // Set the iframe's properties
    iframe.name = 'jf_iframe_' + form.id;
    iframe.id = 'jf_iframe_' + form.id;
    iframe.style.display = 'none';
    iframe.className = 'jf_iframe'; // Add a class to the iframe

    // Append the iframe directly after the form
    form.insertAdjacentElement('afterend', iframe);

    // Set the form's target to the ID of the iframe
    form.target = iframe.id;

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Get the form and iframe elements
        var formContainer = this; // 'this' refers to the form being submitted
        var iframe = document.getElementById('jf_iframe_' + this.id);

        // Listen for the iframe to load
        iframe.addEventListener('load', function() {
            // Once the iframe is loaded, hide the form and show the iframe
            formContainer.style.display = 'none';
            iframe.style.display = 'block';

            // Make the iframe focusable and give it focus
            iframe.setAttribute('tabIndex', '-1');
            iframe.focus();

            // Change the text of all buttons back to their original state
            submitButtons.forEach((button, index) => {
                button.textContent = originalTextContents[index];

                // Re-enable the button if it was previously disabled
                if (button.classList.contains('lastDisabled')) {
                    button.classList.remove('lastDisabled');
                    button.disabled = false;
                }
            });
        });

        // Continue with the form submission
        this.submit();
    });
});
