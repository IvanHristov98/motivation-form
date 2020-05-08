<?php namespace form\zodiac;

class Zodiac {
    public static $ZODIAC_SIGNS;

    public function __construct() {
        self::$ZODIAC_SIGNS = json_decode('[' . 
            '{"name": "водолей", "fromMonth": 1, "fromDate": 20, "toMonth": 2, "toDate": 19},'.
            '{"name": "риби", "fromMonth": 2, "fromDate": 20, "toMonth": 3, "toDate": 20},' .
            '{"name": "овен", "fromMonth": 3, "fromDate": 21, "toMonth": 4, "toDate": 20},' .
            '{"name": "телец", "fromMonth": 4, "fromDate": 21, "toMonth": 5, "toDate": 20},' .
            '{"name": "близнаци", "fromMonth": 5, "fromDate": 21, "toMonth": 6, "toDate": 20},' .
            '{"name": "рак", "fromMonth": 6, "fromDate": 21, "toMonth": 7, "toDate": 22},' .
            '{"name": "лъв", "fromMonth": 7, "fromDate": 21, "toMonth": 8, "toDate": 22},' .
            '{"name": "дева", "fromMonth": 8, "fromDate": 23, "toMonth": 9, "toDate": 22},' .
            '{"name": "везни", "fromMonth": 9, "fromDate": 23, "toMonth": 10, "toDate": 22},' .
            '{"name": "скорпион", "fromMonth": 10, "fromDate": 23, "toMonth": 11, "toDate": 22},' .
            '{"name": "стрелец", "fromMonth": 11, "fromDate": 23, "toMonth": 12, "toDate": 21},' .
            '{"name": "козирог", "fromMonth": 12, "fromDate": 22, "toMonth": 1, "toDate": 19}' .
        ']');
    }

    public function dateToZodiac($date) {
        for ($i = 0; $i < \count(self::$ZODIAC_SIGNS); $i++) {
            if (self::$ZODIAC_SIGNS[$i]->fromMonth == $date->format('n') 
                && self::$ZODIAC_SIGNS[$i]->fromDate <= $date->format('j')) {
                return self::$ZODIAC_SIGNS[$i]->name;
            }
    
            if (self::$ZODIAC_SIGNS[$i]->toMonth == $date->format('n') 
                && self::$ZODIAC_SIGNS[$i]->toDate >= $date->format('j')) {
                return self::$ZODIAC_SIGNS[$i]->name;
            }
        }

        return null;
    }
}