<?php namespace form\handler;

use form\db\DBConnection;
use form\db\dto\User;
use form\img\ImageTool;
use form\zodiac\Zodiac;

class UserHandler {
    const USER_FIELDS = [
        "firstName", "familyName", "facultyNum", "courseYear", "specialty", "groupNum", "dateOfBirth", "link", "motivation"
    ];

    private $user;
    private $imageTool;
    private $zodiac;
    
    public function __construct() {
        $this->user = new User();
        $this->imageTool = new ImageTool();
        $this->zodiac = new Zodiac();
    }

    /**
     * @throws \Exception
     */
    public function uploadClient() {
        $this->setFields();
        $this->uploadImage();
        $this->user->update();

        http_response_code(200);
        echo json_encode("Успешно въведохте вашето мотивационно писмо.");
    }

    /**
     * @throws \Exception
     */
    private function setFields() {
        $this->validateFields();

        $this->user->setFacultyNum($_POST['facultyNum']);
        $this->user->setFirstName($_POST['firstName']);
        $this->user->setFamilyName($_POST['familyName']);
        $this->user->setCourseYear($_POST['courseYear']);
        $this->user->setSpecialty($_POST['specialty']);
        $this->user->setGroup($_POST['groupNum']);
        $this->user->setLink($_POST['link']);
        $this->user->setMotivation($_POST['motivation']);

        $imageName = $this->genPhotoName();
        $this->user->setPhoto($imageName);

        if (isset($_POST['dateOfBirth'])) {
            $this->user->setDateOfBirth($_POST['dateOfBirth']);

            $dateOfBirth = \DateTime::createFromFormat('Y-m-d', $this->user->getDateOfBirth());

            $zodiacSign = $this->zodiac->dateToZodiac($dateOfBirth);
            $this->user->setZodiacSign($zodiacSign);
        }
    }

    /**
     * @throws \Exception
     */
    private function validateFields() {
        for ($i = 0; $i < \count(self::USER_FIELDS); $i++) {
            if (!isset($_POST[self::USER_FIELDS[$i]])) {
                throw new \Exception("Не всички полета са били попълнени. Липсва " . self::USER_FIELDS[$i] . ".");
            }
        }
    }

    private function uploadImage() {
        if (!$this->isPhotoGiven()) {
            return;
        }

        $from = $_FILES["photo"]["tmp_name"];
        $destDir = "img/student/";
        $name = $this->user->getPhoto();

        $this->imageTool->moveImageIfNotExisting($from, $destDir, $name);

        return $name;
    }

    private function genPhotoName() {
        if (!$this->isPhotoGiven()) {
            return null;
        }

        $file = $_FILES["photo"]["name"];
        $extension = \strtolower(\pathinfo($file)['extension']);

        return uniqid() . '.' . $extension;
    }

    private function isPhotoGiven() {
        return isset($_FILES["photo"]);
    }
}