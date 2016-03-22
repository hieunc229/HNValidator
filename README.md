# HNValidator
PHP Library For Validation
- Return array of errors
- If there is no error, return NULL

How to use:

// Include library
include_once 'HNValidator.php';

// Example attributes to validate
$attributes = array(
    "firstname" => "Hieu",
    "lastname" => "Nguyen",
    "email" => "ee"
)

// Define rules
$rules = array(
    "firstname" => array("required","min(5)"),
    "lastname"  => array("required","between(5,20)"),
    "email"     => array("required","email")
)

// Create HNValidator instance
$validate = new HNValidator($rules, $attributes);

// Add custom error
$validate->addErrors("lastname","This is custom error");

// Output
print_r($validate);

// Array(2) {
//      'email'     => 'email is invalid',
//      'lastname'  => 'This is custom error'
// }
