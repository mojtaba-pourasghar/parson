<?php
if (!function_exists('getContentStatus')) {
    function getContentStatus($status)
    {
        switch ($status) {
            case 'WITH_OUT_INFORMATION' :
                echo __('message.with_out_information');
                break;
            case 'WITH_OUT_TEXT':
                echo __('message.with_out_text');
                break;
            case 'FIRST_INFORMATION' :
                echo __('message.first_information');
                break;
            case 'EDITED':
                echo __('message.edited');
                break;
            case 'SEO':
                echo __('message.seo');
                break;
            case 'FINAL':
                echo __('message.final');
                break;
            case 'CONTENT_PRODUCTION':
                echo __('message.content_production');
                break;
            case 'OTHER':
                echo __('message.other');
                break;
        }
    }
}

if (!function_exists('getTextileLink')) {
    function getTextileLink($id, $title)
    {
        return route('textile.view', [$id, $title]);
    }
}



if (!function_exists('getPersonImagePath')) {
    function getPersonImagePath($image)
    {
        $path = getConstant('options.upload_path') . '/persons';
        return '/' . $path . '/' . $image;
    }
}

if (!function_exists('getOrganizationImagePath')) {
    function getOrganizationImagePath($image)
    {
        $path = getConstant('options.upload_path') . '/organizations';
        return '/' . $path . '/' . $image;
    }
}
if (!function_exists('getCategoryImagePath')) {
    function getCategoryImagePath($image)
    {
        $path = getConstant('options.upload_path') . '/categories';
        return '/' . $path . '/' . $image;
    }
}
if (!function_exists('getTextileImagePath')) {
    function getTextileImagePath($image)
    {
        $path = getConstant('options.upload_path') . '/textiles';
        return '/' . $path . '/' . $image;
    }
}

if (!function_exists('getTrendImagePath')) {
    function getTrendImagePath($image)
    {
        $path = getConstant('options.upload_path') . '/trends';
        return '/' . $path . '/' . $image;
    }
}

if (!function_exists('getDiscountTypeImagePath')) {
    function getDiscountTypeImagePath($image)
    {
        $path = getConstant('options.upload_path') . '/discounttypes';
        return '/' . $path . '/' . $image;
    }
}


if (!function_exists('getBlogImagePath')) {
    function getBlogImagePath($image)
    {
        $path = getConstant('options.upload_path') . '/blogs';
        return '/' . $path . '/' . $image;
    }
}

if (!function_exists('getUserImagePath')) {
    function getUserImagePath($image)
    {
        $path = getConstant('options.upload_path') . '/users';
        return '/' . $path . '/' . $image;
    }
}

if (!function_exists('getSliderImagePath')) {
    function getSliderImagePath($image)
    {
        $path = getConstant('options.upload_path') . '/sliders';
        return '/' . $path . '/' . $image;
    }
}

if (!function_exists('speedSend')) {
    function speedSend($Mobile, $TemplateId, $parametters)
    {
        try {
            date_default_timezone_set("Asia/Tehran");

           // $APIURL = "https://ws.sms.ir/";
            // message data
            $data = array(
                "ParameterArray" => $parametters,
                "Mobile" => $Mobile,
                "TemplateId" => $TemplateId
            );

            $APIKey = "df75ff335e351642cd8a0b30";
            $SecretKey = "f78410d8bc882211e7880c97";

            $SmsIR_UltraFastSend = new  App\Http\SmsIR_UltraFastSend($APIKey,$SecretKey);
            $UltraFastSend = $SmsIR_UltraFastSend->UltraFastSend($data);

            //$SmsIR_UltraFastSend = new App\Http\SmsIR_UltraFastSend(getConstant('sms.user'), getConstant('sms.password'), $APIURL);
            //$UltraFastSend = $SmsIR_UltraFastSend->ultraFastSend($data);
            //var_dump($UltraFastSend);

        } catch (Exeption $e) {
            echo 'Error UltraFastSend : ' . $e->getMessage();
        }
    }
}

if (!function_exists('getReadBookStatus')) {
    function getReadBookStatus($book_id)
    {
        $bookshelf = app('App\BookShelf');
        return $bookshelf->checkStatus($book_id);
    }
}

if (!function_exists('convertMention')) {
    function convertMention($str)
    {
        $regex = "/@+([a-zA-Z0-9_]+)/";
        $str = preg_replace($regex, "<a href='profile?username=$1'>&nbsp;$0&nbsp;</a>", $str);
        return ($str);
    }
}

if (!function_exists('removeFirstDash')) {
    function removeFirstDash($str)
    {
        if (substr($str, 0, 1) == '-')
            return substr($str, 1, strlen($str));
        if (substr($str, strlen($str) - 1, 1) == '-')
            return substr($str, 0, strlen($str) - 1);
        return ($str);
    }
}
if (!function_exists('randomNumber')) {
    function randomNumber($length = 4)
    {
        $char = '';
        for ($i = 0; $i < $length; $i++) {
            switch (rand(0, 2)) {
                case 0:
                    $char .= rand(0, 9);
                    break;
                case 1:
                    $char .= rand(0, 9);
                    break;
                default:

                    $char .= rand(0, 9);
            }
        }
        return $char;
    }
}

function user_order_status($status)
{
    $status_txt = '';
    switch($status)
    {
        case 0:
            $status_txt = __('order.ordered');
            break;
        case 1:
            $status_txt = __('order.deposited');
            break;
        case 2:
            $status_txt = __('order.posted');
            break;
        case 3:
            $status_txt = __('order.accepted');
            break;
        case 4:
            $status_txt = __('order.accepted');
            break;
        case 5:
            $status_txt = __('order.accepted');
            break;
        case 8:
            $status_txt = __('order.checking');
            break;
        case 9:
            $status_txt = __('order.not_accepted');
            break;
    }

    return $status_txt;
}
