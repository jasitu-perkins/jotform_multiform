<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>JotForm 2</title>
<style>

/* subscribe form class = ".subscribe-form" for blue bg css */

.jotform-form {
    color : #000;
    -webkit-box-shadow : 0 10px 20px 0 rgba(0,0,0,.1);
    box-shadow : 0 10px 20px 0 rgba(0,0,0,.1);
}

.jotform-form ul.form-section {
    padding : 0;
}

/* header */

.jotform-form .form-header-group {
    background-color: #1d4f91;
    margin : 0;
    padding : 2rem 2.8125rem 0.625rem;
    border: 0;
}

.jotform-form .form-header {
    position : relative;
    padding-bottom : 1rem;
    font-size : 1.375rem !important;
    font-weight : 600;
    line-height : 1.35;
    color: #fff;
}

.jotform-form .form-header::after {
    position : absolute;
    top : 100%;
    left : 0;
    display : block!important;
    width : 155px;
    height : 4px;
    background : #ffb81c;
    content : "";
}

@media screen and (max-width: 768px) {
    .jotform-form #cid_1 .form-header-group {
        margin: 0;
        padding: 2rem 2.8125rem 0.625rem;
    }
}

/* textboxes */
.jotform-form .form-textbox {
    display : block;
    width : 100%;
    height : 52px;
    padding : 0.75em;
    border : 1px solid;
    border-radius : 2px;
    font-size : 1em;
    -webkit-transition : all .3s ease-out;
    transition : all .3s ease-out;
}

.jotform-form .form-line {
    margin : 0;
    border-radius: 0;
    padding : .625rem 2.8125rem .3125rem;
}

.jotform-form .form-label-top {
    margin-bottom : 4px;
}

.jotform-form #id_3, .jotform-form #id_4, .jotform-form #id_5 {
    background-color: #1d4f91;
}

.jotform-form #id_3 {
    margin-top: unset;
    padding-top: 2rem;
}

.jotform-form #id_5 {
    padding-bottom : 2.8125rem;
}

.jotform-form #id_6, .jotform-form #id_6 a {
    color: #393939;
}

.jotform-form #id_6 a:hover {
    text-decoration: none;
}

.jotform-form #id_6 a:focus {
    outline-offset: 5px;
    outline: 2px solid black;
}

/* required */

.jotform-form .form-required:before {
    content : '(Required)';
    visibility : visible;
}

.jotform-form .form-label, .form-required {
    color : white !important;
}

/* button */
.jotform-form #cid_2 .form-buttons-wrapper {
    border : none;
    width : calc(100% - 60px);
    margin : 0.9375rem 1.875rem 1.875rem;
    padding : 0;
    background-color: #00cc9f;
}

.jotform-form .form-submit-button {
    position : relative;
    display : -webkit-inline-box;
    display : -ms-inline-flexbox;
    display : inline-flex;
    -webkit-box-align : center;
    -ms-flex-align : center;
    align-items : center;
    -webkit-box-pack : center;
    -ms-flex-pack : center;
    justify-content : center;
    overflow : hidden;
    border-radius : 0;
    background-color : transparent;
    font-size : 1.125rem;
    font-weight : 600;
    line-height : 1.4em;
    text-decoration : none;
    cursor : pointer;
    -webkit-transition : .16s ease-in-out;
    transition : all .16s ease-in-out;
    width : 100%;
    padding : 1rem 3.0625rem 1rem 1.5625rem;
    border : 0;
    background : 0 0;
    color : #000;
}

.jotform-form .form-submit-button:before {
    position : absolute;
    width : auto;
    -webkit-transform : translate(-50%,-50%);
    transform : translate(-50%,-50%);
    color : transparent;
    content : attr(data-content);
    pointer-events : none;
    bottom : -4px;
    left : calc(50% - 12px);
    position : absolute;
    bottom : -2px;
    left : 49px;
    width : calc(100% - 129px);
    height : 2px;
    background-color : #000;
    content : "";
    -webkit-transition : bottom .1s ease-in-out;
    transition : bottom .1s ease-in-out;
}

.jotform-form .form-submit-button:after {
    right : auto;
    left : calc(50% + 20px);
    background-position : 100%;
    background-size : 22px 100%;
    position : absolute;
    width : auto;
    -webkit-transform : translate(-50%,-50%);
    transform : translate(-50%,-50%);
    color : transparent;
    content : attr(data-content);
    pointer-events : none;
    position : absolute;
    top : 50%;
    right : 47px;
    left : auto;
    width : 22px;
    height : 16px;
    -webkit-transform : translateY(-50%);
    transform : translateY(-50%);
    content : "";
    -webkit-transition : all .1s ease-in-out;
    transition : all .1s ease-in-out;
}

/* button hover */
.jotform-form #input_2:hover {
    background-color : #00e7b4 !important;
    -webkit-box-shadow : 0 5px 20px -10px rgba(0,0,0,.7);
    box-shadow : 0 5px 20px -10px rgba(0,0,0,.7);
}

/* accessibility */
.jotform-form .a11y_requirement_desc_line {
    margin-top : 0 !important;
    display : none;
}

.jotform-form .a11y-error-container, .a11y_requirement_desc_line {
    padding : 0 48px;
}

.jotform-form .error-navigation-message {
    padding : 0 2px;
}

.jotform-form .form-required {
    visibility : hidden;
}
</style>
</head>
<body>

<?php
    // Include WordPress core functionality
    require_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');

    // Call the function to display the form
    echo displayJotformForm2();
    ?>
    
<script>

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
</script>



    </body>
</html>