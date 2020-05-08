<?php namespace form\db\dto;

use form\db\DBConnection;

class User extends DTO {
    const TABLE = "users";
    const P_KEY = "fn";

    private $facultyNum;
    private $firstName;
    private $familyName;
    private $courseYear;
    private $specialty;
    private $group;
    private $dateOfBirth;
    private $zodiacSign;
    private $link;
    private $photo;
    private $motivation;

    public function __construct() {
        parent::__construct(self::TABLE, self::P_KEY);
    }

    /**
     * @throws \Exception
     */
    public function update() {
        $dbConn = DBConnection::getInstance()::getPDO();
        if ($this->isInDB($dbConn, $this->facultyNum, 's')) {
            throw new \Exception("Вече сте написали мотивационно писмо.");
        }
        
        $stmt = $dbConn->prepare(
            'INSERT INTO users ' .
            '(`fn`, `first_name`, `family_name`, `course_year`, `specialty`, `group_name`, `date_of_birth`, `zodiac_sign`, `link`, `photo`, `motivation`) ' .
            'VALUES (:fn, :first_name, :family_name, :course_year, :specialty, :group_name, :date_of_birth, :zodiac_sign, :link, :photo, :motivation)'
        );

        $stmt->bindParam(':fn', $this->facultyNum);
        $stmt->bindParam(':first_name', $this->firstName);
        $stmt->bindParam(':family_name', $this->familyName);
        $stmt->bindParam(':course_year', $this->courseYear);
        $stmt->bindParam(':specialty', $this->specialty);
        $stmt->bindParam(':group_name', $this->group);
        $stmt->bindParam(':date_of_birth', $this->dateOfBirth);
        $stmt->bindParam(':zodiac_sign', $this->zodiacSign);
        $stmt->bindParam(':link', $this->link);
        $stmt->bindParam(':photo', $this->photo);
        $stmt->bindParam(':motivation', $this->motivation);

        $stmt->execute();
    }

    /**
     * @throws \Exception
     */
    public function setFacultyNum($facultyNum) {
        if (\mb_strlen($facultyNum) > 32) {
            throw new \Exception("Факултетният номер не трябва да е по-дълъг от 32 символа.");
        }

        $this->facultyNum = $facultyNum;
    }

    /**
     * @throws \Exception
     */
    public function setFirstName($firstName) {
        if (\mb_strlen($firstName) > 128) {
            throw new \Exception("Първото име не трябва да е по-дълго от 128 символа.");
        }

        $this->firstName = $firstName;
    }

    /**
     * @throws \Exception
     */
    public function setFamilyName($familyName) {
        if (\mb_strlen($familyName) > 128) {
            throw new \Exception("Фамилното име не трябва да е по-дълго от 128 символа.");
        }

        $this->familyName = $familyName;
    }

    /**
     * @throws \Exception
     */
    public function setCourseYear($courseYear) {
        if (!\is_numeric($courseYear)) {
            throw new \Exception("Курсът се представя като година, т.е. трябва да е цяло число.");
        }

        $this->courseYear = \intval($courseYear);
    }

    /**
     * @throws \Exception
     */
    public function setSpecialty($specialty) {
        if (\mb_strlen($specialty) > 128) {
            throw new \Exception("Името на специалността не трябва да е по-дълго от 128 символа.");
        }

        $this->specialty = $specialty;
    }

    /**
     * @throws \Exception
     */
    public function setGroup($group) {
        if (\mb_strlen($group) > 16) {
            throw new \Exception("Името на групата не трябва да е по-дълго от 16 символа.");
        }

        $this->group = $group;
    }

    /**
     * @throws \Exception
     */
    public function setDateOfBirth($dateOfBirth) {
        $dateOfBirthAsDate = \DateTime::createFromFormat('Y-m-d', $dateOfBirth);

        if (!$dateOfBirthAsDate) {
            throw new \Exception("Въведената дата не е валидна. Очакваният формат е година-месец-ден час:минута:секунда.");
        }

        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * @throws \Exception
     */
    public function setZodiacSign($zodiacSign) {
        if (\mb_strlen($zodiacSign) > 32) {
            throw new \Exception("Името на зодията не трябва да е по-дълго от 32 символа.");
        }

        $this->zodiacSign = $zodiacSign;
    }

    /**
     * @throws \Exception
     */
    public function setLink($link) {
        if (\mb_strlen($link) > 512) {
            throw new \Exception("Линкът не трябва да е по-дълъг от 512 символа.");
        }

        $this->link = $link;
    }

    /**
     * @param string $photo Must be the name of the file containing the photo.
     * @throws \Exception
     */
    public function setPhoto($photo) {
        if (\mb_strlen($photo) > 64) {
            throw new \Exception("Името на снимката не трябва да е по-дълго от 64 символа.");
        }

        $this->photo = $photo;
    }

    /**
     * @throws \Exception
     */
    public function setMotivation($motivation) {
        $this->motivation = $motivation;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function getDateOfBirth() {
        return $this->dateOfBirth;
    }
}