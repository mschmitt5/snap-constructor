<?php
/**
 * Created by PhpStorm.
 * User: schmi
 * Date: 1/23/2018
 * Time: 8:07 AM
 */

class profile {

    /**
     * id for profile. this will be the primary key.
     * @var Uuid $profileId
     **/
    private $profileId;

    /**
     * age of this person
     * @var int $age
     **/
    private $age;

    /**
     * birthdate for this person
     * @var datetime $birthDate
     **/
    private $birthDate;

    /**
     * full name
     * @var string $fullName
     **/
    private $fullName;

    /**
     * constructor for this Profile
     *
     * @param string|Uuid $newProfileId id of this Profile or null if a new Profile
     * @param string $newFullName string containing full name
     * @throws \InvalidArgumentException if data types are not valid
     * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
     * @throws \TypeError if a data type violates a data hint
     * @throws \Exception if some other exception occurs
     * @Documentation https://php.net/manual/en/language.oop5.decon.php
     **/
    public function __construct($newProfileId, string $newFullName) {
        try {
            $this->setProfileId($newProfileId);
            $this->setFullName($newFullName);
        } catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
            //determine what exception type was thrown
            $exceptionType = get_class($exception);
            throw(new $exceptionType($exception->getMessage(), 0, $exception));
        }
    }

    /**
     * accessor method for profile age
     * @return int value of age
     **/
    public function getAge() : int {
        return $this->age;
    }

    /**
     * accessor method for full name
     * @return string value of full name
     **/
    public function getFullName() : string {
        return $this->fullName;
    }

    /**
     * mutator method for full name
     *
     * @param string $newFullName new value of full name
     * @throws \InvalidArgumentException if $newFullName is not a string or is insecure
     * @throws \RangeException if $newFullName is > 32 characters
     * @throws \TypeError if $newFullName is not a string
     *
     **/
    public function setFullName(string $newFullName) : void {
        $newFullName = trim($newFullName);
        $newFullName = filter_var($newFullName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        if (empty($newFullName) === true) {
            throw (new \InvalidArgumentException("full name is empty or insecure"));
        }
        if ((strlen($newFullName)) > 32) {
            throw (new \RangeException("full name is too long"));
        }
        $this->fullName = $newFullName;
    }
}

$johnSmith = new profile();
$johnSmith->setFullName(John Smith);