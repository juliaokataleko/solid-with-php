<?php

// Single Responsability Principle

// Convert to Json class
class Json {
    public static function from($data) {
        return json_encode($data);
    }
}

// Class for validation
class UserRequest {
    
    protected static $rules = [
        "name" => "string",
        "email" => "string"
    ];

    public static function validate($data)
    {
        foreach (static::$rules as $property => $type) {
            if(gettype($data[$property]) != $type) {
                throw new \Exception("User property {$property} Must be of type {$type}");
            }
        }
    }
}

class User {
    public $name;
    public $email;

    // Primary responsability
    public function __construct($data)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
    }

    // we need to pass json formatation to another class
    // public function formatJson()
    // {
    //     return json_encode([
    //         "name" => $this->name,
    //         "email" => $this->email,
    //     ]);
    // }

    // We need to create a class for validation
    // public function validate($data)
    // {
    //     if(!isset($data['name'])) {
    //         throw new \Exception("Bad request. User requires a name");
    //     }
    //     if(!isset($data['email'])) {
    //         throw new \Exception("Bad request. User requires a email");
    //     }
    // }
}

// Usage
$data = [
    "name" => "Julien Kata",
    "email" => "juliofeli78@gmail.com"
];

// Now the validation is separated from user
UserRequest::validate($data);

// User class has only the responsability to create user
$user = new User($data);

// Json class is in a separated class, so we can use this class to format more data types
var_dump(Json::from($data));