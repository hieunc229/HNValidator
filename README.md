# HNValidator
PHP Library For Validation
- Return array of errors
- If there is no error, return NULL

# Available validation
Please note that number below is only for demonstration, replace with your number requirement
- min(5)    : mininum lenght of string is 5
- max(5)    : maxinum length of string is 5 
- size(5)   : valid size of length is 5
- between(4,6): valid length of string between 4 and 6
- required  : field is required, must not be empty
- email     : string must be an email form (a@b.c)
- regex({regex-pattern}) : string must follow the regex format

# How to use:
    
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
