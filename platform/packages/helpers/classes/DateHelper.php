<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/04/10 - 14:26
 */
use Carbon\Carbon;

class DateHelper
{
    /**
     * Lấy timeline từ date truyền vào
     *
     * @param  $end_date - ngày kết thúc, $typeReturn - kiểu trả về
     * @return string/int
     */
    public static function getTimeline($end_date, $typeReturn = 1)
    {
        $return_date = date('Y-m-d h:i:s', strtotime($end_date));
        $pick_date   = date('Y-m-d h:i:s');
        $pick_date   = date_create($pick_date);
        $return_date = date_create($return_date);
        $diff        = date_diff($pick_date, $return_date);
        //        $diff->format('%y %m %d %h %i %s');

        $day   = $diff->d;
        $month = $diff->m;
        $hour  = $diff->h;

        switch ($typeReturn)
        {
            //Trả về đầy đủ
            case 1:
                $stringDate = 'Còn ' . $month . ' tháng ' . $day . ' ngày ';
                if ($month == 0)
                {
                    $stringDate = 'Còn ' . $day . ' ngày ' . $hour . ' giờ';
                }

                if ($day == 0)
                {
                    $stringDate = 'Còn ' . $hour . ' giờ';
                }
                break;
            //Trả về tháng
            case 2:
                $stringDate = $month;
                break;
            //Trả về ngày
            case 3:
                $stringDate = $day;
                break;
            //Trả về giờ
            case 4:
                $stringDate = $hour;
                break;
            default:
                break;
        }

        return $stringDate;
    }

    /**
     * Get time post
     * @return string
     */
    public static function postedTimer($minutes)
    {
        $msg = "";
        if ($minutes < 1)
        {
            $msg = "khoảng 1 phút trước";
        }
        else if ($minutes >= 1 && $minutes < 60)
        {
            $msg = round($minutes) . " phút trước";
        }
        else if ($minutes >= 60 && $minutes < 1140)
        {
            $msg = round($minutes / 60) . " giờ trước";
        }
        else
        {
            $msg = round($minutes / (60 * 24)) . " ngày trước";
        }

        return $msg;
    }

    /**
     * Nhận timeago
     * @param timestamp $time_ago
     * @return string
     */
    public static function timeAgo($time_ago)
    {
        $time_ago     = strtotime($time_ago);
        $cur_time     = time();
        $time_elapsed = $cur_time - $time_ago;
        $seconds      = $time_elapsed;
        $minutes      = round($time_elapsed / 60);
        $hours        = round($time_elapsed / 3600);
        $days         = round($time_elapsed / 86400);
        $weeks        = round($time_elapsed / 604800);
        $months       = round($time_elapsed / 2600640);
        $years        = round($time_elapsed / 31207680);

        // Seconds
        if ($seconds <= 60)
        {
            return " vừa xong  ";
        } //Minutes
        else if ($minutes <= 60)
        {
            if ($minutes == 1)
            {
                return "1 phút trước";
            }
            else
            {
                return "$minutes phút trước";
            }
        } //Hours
        else if ($hours <= 24)
        {
            if ($hours == 1)
            {
                return "1 giờ trước ";
            }
            else
            {
                return "$hours giờ trước ";
            }
        } //Days
        else if ($days <= 7)
        {
            if ($days == 1)
            {
                return " Hôm qua ";
            }
            else
            {
                return "$days ngày trước";
            }
        } //Weeks
        else if ($weeks <= 4.3)
        {
            if ($weeks == 1)
            {
                return "1 tuần trước";
            }
            else
            {
                return "$weeks tuần trước";
            }
        } //Months
        else if ($months <= 12)
        {
            if ($months == 1)
            {
                return "1 tháng trước";
            }
            else
            {
                return "$months tháng trước";
            }
        } //Years
        else
        {
            if ($years == 1)
            {
                return "1 năm trước";
            }
            else
            {
                return "$years năm trước";
            }
        }
    }

    public function getDateTime($language = "vn", $getDay = 1, $getDate = 1, $getTime = 1, $timeZone = "GMT+7", $intTimestamp = "")
    {
        if ($intTimestamp != "")
        {
            $today = getdate($intTimestamp);
            $day   = $today["wday"];
            $date  = date("d/m/Y", $intTimestamp);
            $time  = date("H:i", $intTimestamp);
        }
        else
        {
            $today = getdate();
            $day   = $today["wday"];
            $date  = date("d/m/Y");
            $time  = date("H:i");
        }
        switch ($language)
        {
            case "vn":
                $dayArray = ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"];
                break;
            case "en":
                $dayArray = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                break;
            default :
                $dayArray = ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"];
                break;
        }
        $strDateTime = "";
        for ($i = 0; $i <= 6; $i++)
        {
            if ($i == $day)
            {
                if ($getDay != 0) $strDateTime .= $dayArray[$i] . ", ";
                if ($getDate != 0) $strDateTime .= $date . ", ";
                if ($getTime != 0) $strDateTime .= $time . " ";
                $strDateTime .= $timeZone;
                if (substr($strDateTime, -2, 2) == ", ") $strDateTime = substr($strDateTime, 0, -2);

                return $strDateTime;
            }
        }
    }

    public function convertDateTime($strDate = "", $strTime = "")
    {
        //Break string and create array date time
        $strDate      = str_replace("/", "-", $strDate);
        $strDateArray = explode("-", $strDate);
        $countDateArr = count($strDateArray);
        $strTime      = str_replace("-", ":", $strTime);
        $strTimeArray = explode(":", $strTime);
        $countTimeArr = count($strTimeArray);
        //Get Current date time
        $today = getdate();
        $day   = $today["mday"];
        $mon   = $today["mon"];
        $year  = $today["year"];
        $hour  = $today["hours"];
        $min   = $today["minutes"];
        $sec   = $today["seconds"];
        //Get date array
        switch ($countDateArr)
        {
            case 2:
                $day = intval($strDateArray[0]);
                $mon = intval($strDateArray[1]);
                break;
            case $countDateArr >= 3:
                $day  = intval($strDateArray[0]);
                $mon  = intval($strDateArray[1]);
                $year = intval($strDateArray[2]);
                break;
        }
        //Get time array
        switch ($countTimeArr)
        {
            case 2:
                $hour = intval($strTimeArray[0]);
                $min  = intval($strTimeArray[1]);
                break;
            case $countTimeArr >= 3:
                $hour = intval($strTimeArray[0]);
                $min  = intval($strTimeArray[1]);
                $sec  = intval($strTimeArray[2]);
                break;
        }
        //Return date time integer
        if (@mktime($hour, $min, $sec, $mon, $day, $year) == -1) return $today[0];
        else return mktime($hour, $min, $sec, $mon, $day, $year);
    }

    public function DatetoInt($day, $month, $year, $hour = 0, $min = 0, $second = 0)
    {
        return mktime($hour, $min, $second, $month, $day, $year);
    }

    public function getDay($intdate)
    {
        return date("d", $intdate);
    }

    public function getMonth($intdate)
    {
        return date("m", $intdate);
    }

    public function getYear($intdate)
    {
        return date("Y", $intdate);
    }

    public function getShortDate($intdate, $type = "-")
    {
        return $this->getDay($intdate) . $type . $this->getMonth($intdate) . $type . $this->getYear($intdate);
    }

    public function validateDate($strDate)
    {
        $strDate      = str_replace("/", "-", $strDate);
        $strDateArray = explode("-", $strDate);
        if (count($strDateArray) == 3)
        {
            if (checkdate(intval($strDateArray[1]), intval($strDateArray[0]), intval($strDateArray[2]))) return true;
            else return false;
        }
        else return false;
    }

    public function convertDatetomySQL($strDate)
    {
        $strDate      = str_replace("/", "-", $strDate);
        $strDateArray = explode("-", $strDate);

        return $strDateArray[2] . "-" . $strDateArray[1] . "-" . $strDateArray[0];
    }

    public function convertDatefrommySQL($strDate)
    {
        $strDate      = str_replace("/", "-", $strDate);
        $strDateArray = explode("-", $strDate);

        return $strDateArray[2] . "-" . $strDateArray[1] . "-" . $strDateArray[0];
    }

    // Đổi ngày ra Hôm nay, Hôm qua....
    public function today_yesterday($td_day, $td_month, $td_year, $ye_day, $ye_month, $ye_year, $compare_time)
    {
        $ct = getdate($compare_time);
        // Kiểm tra so với hôm nay
        if ($td_day == $ct["mday"] && $td_month == $ct["month"] && $td_year == $ct["year"]) return "Hôm nay, lúc " . date("H:i", $compare_time);
        if ($ye_day == $ct["mday"] && $ye_month == $ct["month"] && $ye_year == $ct["year"]) return "Hôm qua, lúc " . date("H:i", $compare_time);

        // Nếu không trùng thì return lại
        return date("d/m/Y - H:i", $compare_time);
    }

    // Đổi ngày ra Hôm nay, Hôm qua....
    public function today_yesterday_v2($compare_time, $type = 0)
    {
        $today     = getdate();
        $yesterday = getdate(strtotime("yesterday"));
        $ct        = getdate($compare_time);

        if ($type == 0)
        {
            // Nếu thời gian nhỏ hơn 10h thì show kiểu "10 giờ 30 phút" trước
            $intTime = time() - $compare_time;
            if ($intTime / 3600 <= 10) return $this->generateDuration($intTime, 3, "1 phút") . " trước";
        }

        // Kiểm tra so với hôm nay
        if ($today["mday"] == $ct["mday"] && $today["month"] == $ct["month"] && $today["year"] == $ct["year"]) return "Hôm nay, lúc " . date("H:i", $compare_time);
        if ($yesterday["mday"] == $ct["mday"] && $yesterday["month"] == $ct["month"] && $yesterday["year"] == $ct["year"]) return "Hôm qua, lúc " . date("H:i", $compare_time);

        // Nếu không trùng thì return lại
        return date("d/m/Y - H:i", $compare_time);
    }

    //Đổi ngày ra Hôm nay, Hôm qua....
    public function today_yesterday_raovat($td_day, $td_month, $td_year, $ye_day, $ye_month, $ye_year, $compare_time)
    {
        $ct = getdate($compare_time);
        //Kiểm tra so với hôm nay
        if ($td_day == $ct["mday"] && $td_month == $ct["month"] && $td_year == $ct["year"]) return "Hôm nay, lúc " . date("H:i", $compare_time);;
        if ($ye_day == $ct["mday"] && $ye_month == $ct["month"] && $ye_year == $ct["year"]) return "Hôm qua, lúc " . date("H:i", $compare_time);;
        //Nếu không trùng thì return lại
        $str_return = date("d/m/Y", $compare_time);

        // $str_return.= "<br />" . date("H:i",$compare_time);
        return $str_return;
    }

    //Kiểm tra ngày sản xuất
    public function check_appear_date($mydate, $type = 0)
    {
        //Nhỏ hơn 1/1/1971
        if ($mydate <= 31510800) return "-";
        else
        {
            //type = 0 : dạng tháng / năm
            if ($type == 0) return date("m/Y", $mydate);
            //type khác dạng ngày / tháng / năm
            else return date("d/m/Y", $mydate);
        }
    }

    public function generateDuration($int_time, $type = 4, $default = "", $limit_param = 0, $time = [])
    {
        $strReturn = "";
        $arrTime   = [86400 => "ngày",
                      3600  => "giờ",
                      60    => "phút",
                      1     => "giây",
        ];
        if (is_array($time) && count($time) > 0) $arrTime = $time;
        $i = 0;
        $j = 0;
        foreach ($arrTime as $key => $value)
        {
            $i++;
            if ($int_time >= $key)
            {
                $j++;
                $strReturn .= " " . format_number(intval($int_time / $key)) . " " . $value;
                $int_time  = $int_time % $key;
                if ($limit_param > 0 && $j >= $limit_param) break;
            }
            if ($i >= $type) break;
        }
        if ($strReturn == "") $strReturn = $default;

        return trim($strReturn);
    }

    public function generateDurationShort($int_time, $default = "1 phút")
    {
        $strReturn = $default;
        $arrTime   = [86400 => "ngày",
                      3600  => "giờ",
                      60    => "phút",
        ];
        foreach ($arrTime as $key => $value)
        {
            if ($int_time >= $key)
            {
                $strReturn = format_number(intval($int_time / $key)) . " " . $value;

                return $strReturn;
            }
        }

        return $strReturn;
    }

    public function getNiceDuration($durationInSeconds)
    {

        $duration          = '';
        $years             = floor($durationInSeconds / (86400 * 123));
        $months            = floor($durationInSeconds / (86400 * 30));
        $days              = floor($durationInSeconds / 86400);
        $durationInSeconds -= $days * 86400;
        $hours             = floor($durationInSeconds / 3600);
        $durationInSeconds -= $hours * 3600;
        $minutes           = floor($durationInSeconds / 60);
        $seconds           = $durationInSeconds - $minutes * 60;

        if ($seconds > 0)
        {
            $duration = ' ' . $seconds . ' giây trước';
        }

        if ($minutes > 0)
        {
            $duration = ' ' . $minutes . ' phút trước';
        }

        if ($hours > 0)
        {
            $duration = ' ' . $hours . ' giờ trước';
        }

        if ($days > 0)
        {
            $duration = $days . ' ngày trước';
        }

        if ($months > 0)
        {
            $duration = $months . ' tháng trước';
        }

        if ($years > 0)
        {
            $duration = $years . ' năm trước';
        }

        return $duration;
    }

    public function checkWorkingTime()
    {
        $day  = date("w");
        $hour = date("H");
        if ($day == 0) return false;
        $start = 8;
        $end   = ($day == 6 ? 11 : 16);
        if ($hour >= $start && $hour <= $end) return true;
        else return false;
    }

    public function checkIsNewJob($time)
    {
        $date = Carbon::parse($time);
        $now  = Carbon::now();

        $diff = $date->diffInDays($now);
        if ($diff)
        {
            return false;
        }

        return true;
    }

    /*
     * Dùng để render view select thời gian
     */
    public function createMonth()
    {
        $result = [];
        for ($m = 1; $m <= 12; ++$m)
        {
            array_push($result, $m);
        }

        return $result;
    }

    /*
     * Dùng để render view select thời gian
     */
    public function createYear()
    {
        $result = [];
        $year   = date('Y');
        $min    = 1980;
        $max    = $year;
        for ($i = $max; $i >= $min; $i--)
        {
            array_push($result, $i);
        }

        return $result;
    }
}