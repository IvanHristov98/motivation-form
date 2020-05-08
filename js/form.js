const ZODIAC_SIGNS = [
    {name: "водолей", fromMonth: 0, fromDate: 20, toMonth: 1, toDate: 19},
    {name: "риби", fromMonth: 1, fromDate: 20, toMonth: 2, toDate: 20},
    {name: "овен", fromMonth: 2, fromDate: 21, toMonth: 3, toDate: 20},
    {name: "телец", fromMonth: 3, fromDate: 21, toMonth: 4, toDate: 20},
    {name: "близнаци", fromMonth: 4, fromDate: 21, toMonth: 5, toDate: 20},
    {name: "рак", fromMonth: 5, fromDate: 21, toMonth: 6, toDate: 22},
    {name: "лъв", fromMonth: 6, fromDate: 21, toMonth: 7, toDate: 22},
    {name: "дева", fromMonth: 7, fromDate: 23, toMonth: 8, toDate: 22},
    {name: "везни", fromMonth: 8, fromDate: 23, toMonth: 9, toDate: 22},
    {name: "скорпион", fromMonth: 9, fromDate: 23, toMonth: 10, toDate: 22},
    {name: "стрелец", fromMonth: 10, fromDate: 23, toMonth: 11, toDate: 21},
    {name: "козирог", fromMonth: 11, fromDate: 22, toMonth: 0, toDate: 19},
];

function dateToZodiac(date) {
    for (let i = 0; i < ZODIAC_SIGNS.length; i++) {
        if (ZODIAC_SIGNS[i].fromMonth === date.getMonth() && ZODIAC_SIGNS[i].fromDate <= date.getDate()) {
            return ZODIAC_SIGNS[i].name;
        }

        if (ZODIAC_SIGNS[i].toMonth === date.getMonth() && ZODIAC_SIGNS[i].toDate >= date.getDate()) {
            return ZODIAC_SIGNS[i].name;
        }
    }

    return null;
}

function setZodiac(text) {
    let zodiacSign = document.getElementById("zodiac-sign");
    zodiacSign.style.display = "block";
    zodiacSign.innerText = text;
}

function unsetZodiac() {
    let zodiacSign = document.getElementById("zodiac-sign");
    zodiacSign.style.display = "none";    
}

unsetZodiac();

document.getElementById("date-of-birth").addEventListener("change", function() {
    let dateOfBirth = new Date(this.value);
    let zodiac = dateToZodiac(dateOfBirth);

    if (zodiac !== null) {
        setZodiac("Вашата зодия е " + zodiac);
    } else {
        unsetZodiac();
    }
});

const photo = document.getElementById("photo");
const motivationForm = document.getElementById("motivation-from");
const motivationEndpoint = "index.php";

const goodInfo = document.getElementById("good-info");
const badInfo = document.getElementById("bad-info");

motivationForm.addEventListener("submit", function(e) {
    e.preventDefault();
    
    let formData = new FormData();

    function getInputValue(id) {
        return document.getElementById(id).value;
    }

    formData.append("photo", photo.files[0]);
    formData.append("firstName", getInputValue("first-name"));
    formData.append("familyName", getInputValue("family-name"));
    formData.append("facultyNum", getInputValue("faculty-num"));
    formData.append("courseYear", getInputValue("course-year"));
    formData.append("specialty", getInputValue("specialty"));
    formData.append("groupNum", getInputValue("group-num"));
    formData.append("dateOfBirth", getInputValue("date-of-birth"));
    formData.append("link", getInputValue("link"));
    formData.append("motivation", getInputValue("motivation"));

    let currentInfoBlock = null;

    fetch(motivationEndpoint, {
        method: "post",
        body: formData
    }).then(function (response){
        if (response.status == 200) {
            goodInfo.style.display = "block";
            badInfo.style.display = "none";

            currentInfoBlock = goodInfo;
        } else {
            badInfo.style.display = "block";
            goodInfo.style.display = "none";

            currentInfoBlock = badInfo;
        }

        return response.json();
    }).then(function (content) {
        currentInfoBlock.innerText = content;
    });
});