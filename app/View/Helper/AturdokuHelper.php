<?php
App::uses('AppHelper', 'View/Helper');

class AturdokuHelper extends AppHelper {
    private $months = array(
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
    );
    
    public function get_number_of_day($month) {
        $number_of_day = array(
            1  => 31,
            2  => 28 + $this->is_leap_year(date('Y')),
            3  => 31,
            4  => 30,
            5  => 31,
            6  => 30,
            7  => 31,
            8  => 31,
            9  => 30,
            10 => 31,
            11 => 30,
            12 => 31
        );
        
        return $number_of_day[$month];
    }
    
    public function print_date_progress() {
        $date = intval(date('d'));
        $month = intval(date('m'));       
?>
        <p style="margin: 0">Hari ini tanggal: <?php echo date('Y-m-d') ?></p>
        <div class="progress large-6 success" style="width: 100%;"><span class="meter" style="width: <?php echo ceil($date * 100 / $this->get_number_of_day($month)); ?>%"></span></div>
<?php
    }
    
    private function is_leap_year($year) {
        if ($year % 400 == 0) {
            return 1;
        }
        else if ($year % 100 == 0) {
            return 0;
        }
        else if ($year % 4 == 0) {
            return 1;
        }
        else {
            return 0;
        }
    }
    
    public function getGraphDateFormat($date) {
        $dateElements = explode('-', $date);
        return $dateElements[2] . "-" . $this->months[$dateElements[1]-1] . "-" . $dateElements[0];
    }
}
?>
