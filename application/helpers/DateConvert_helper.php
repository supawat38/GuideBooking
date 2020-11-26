<?php

function ConvertThaiMonth($Mohth){
        switch ($Mohth) {
            case '01':
                $ThaiMonth = "มกราคม";
                break;
            case '02':
                $ThaiMonth = "กุมภาพันธ์";
                break;
            case '03':
                $ThaiMonth = "มีนาคม";
                break;
            case '04':
                $ThaiMonth = "เมษายน";
                break;
            case '05':
                $ThaiMonth = "พฤษภาคม";
                break;
            case '06':
                $ThaiMonth = "มิถุนายน";
                break;
            case '07':
                $ThaiMonth = "กรกฎาคม";
                break;
            case '08':
                $ThaiMonth = "สิงหาคม";
                break;
            case '09':
                $ThaiMonth = "กันยายน";
                break;
            case '10':
                $ThaiMonth = "ตุลาคม";
                break;
            case '11':
                $ThaiMonth = "พฤษจิกายน";
                break;
            case '12':
                $ThaiMonth = "ธันวาคม";
                break;
        
            default:
                $ThaiMonth = "ไม่ทราบ";
                break;
        }
        return $ThaiMonth;
}

function ConvertThaiDay($day){
    switch ($day) {
        case 'Sunday':
            $ThaiDay = "อาทิตย์";
            break;
        case 'Monday':
            $ThaiDay = "จันทร์";
            break;
        case 'Tuesday':
            $ThaiDay = "อังคาร";
            break;
        case 'Wednesday':
            $ThaiDay = "พุธ";
            break;
        case 'Thursday':
            $ThaiDay = "พฤหัสบดี";
            break;
        case 'Friday':
            $ThaiDay = "ศุกร์";
            break;
        case 'Saturday':
            $ThaiDay = "เสาว์";
            break;
        default:
            $ThaiDay = "ไม่ทราบ";
            break;
    }
    return $ThaiDay;
}

?>