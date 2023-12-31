<?php

if (! function_exists('setting')) {
    /**
     * Get / set the specified setting value.
     *
     * If an array is passed, we'll assume you want to set settings.
     *
     * @param string|array $key
     * @param mixed $default
     * @return mixed|\Modules\Setting\Repository
     */
    function setting($key = null, $default = null)
    {
        if (is_null($key)) {
            return app('setting');
        }

        if (is_array($key)) {
            return app('setting')->set($key);
        }

        try {
            return app('setting')->get($key, $default);
        } catch (PDOException $e) {
            return $default;
        }
    }
}
if (! function_exists('remove_http')) {
    function remove_http($url)
    {
        $disallowed = array('http://', 'https://');
        foreach ($disallowed as $d) {
            if (strpos($url, $d) === 0) {
                return rtrim(str_replace($d, '', $url), '/');
            }
        }
        return rtrim($url, '/');
    }
}
if (! function_exists('add_http')) {
    function add_http($link, $append = 'http://', $allowed = array('http://', 'https://'))
    {
        $found = false;
        foreach ($allowed as $protocol)
            if (strpos($link, $protocol) !== 0)
                $found = true;

        if ($found)
            return $link;
        return $append . $link;
    }
}
if (! function_exists('get_client_ip')) {
    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}
if (! function_exists('_debug')) {
    function _debug($data, $exit = 0)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        if ($exit) {
            exit;
        }
    }
}
if (! function_exists('create_vcard')) {
    function create_vcard($user_info)
    {
        $destinationPath = public_path() . '/images/users/' . $user_info['id'] . '/';
        $user_image = '';
        if (!empty($user_info['avatar'])) {
            $file_path = $destinationPath . $user_info['avatar'];
            if (file_exists($file_path)) {
                $user_image = get_image_encoding($file_path);
            }
        }
        return utf8_encode('BEGIN:VCARD
VERSION:3.0
REV:2019-09-18T11:43:06Z
N;CHARSET=utf-8:' . $user_info['first_name'] . ';' . $user_info['last_name'] . ';' . $user_info['middle_name'] . ';;
FN;CHARSET=utf-8:' . $user_info['first_name'] . ' ' . $user_info['last_name'] . ' ' . $user_info['middle_name'] . '
URL;TYPE=Profile:' . route('account.profile.view', $user_info['username']) . '
ORG;CHARSET=utf-8:' . $user_info['user_info']['company'] . '
TITLE;CHARSET=utf-8:' . $user_info['user_info']['job_title'] . '
EMAIL;TYPE=Email:' . $user_info['email'] . '
TEL;TYPE=Mobile:' . $user_info['user_info']['phone'] . '
TEL;TYPE=Work:' . $user_info['user_info']['job_phone'] . '
TEL;TYPE=Fax:' . $user_info['user_info']['fax'] . '
ADR;WORK;POSTAL;CHARSET=utf-8:;;' . $user_info['user_info']['street_address_1'] . ' ' . $user_info['user_info']['street_address_2'] . ' ;' . $user_info['user_info']['city'] . ';' . $user_info['user_info']['state'] . ';' . $user_info['user_info']['zip'] . ';' . $user_info['user_info']['country'] . '
URL;TYPE=Website:' . add_http($user_info['user_info']['website']) . '
URL;TYPE=Facebook:' . $user_info['user_info']['facebook'] . '
URL;TYPE=Facebook Page:' . $user_info['user_info']['facebook_page'] . '
URL;TYPE=Twitter:' . $user_info['user_info']['twitter'] . '
URL;TYPE=Pinterest:' . $user_info['user_info']['pinterest'] . '
URL;TYPE=Instagram:' . $user_info['user_info']['instagram'] . '
URL;TYPE=Linkedin:https://linkedin.com/in/' . $user_info['user_info']['linkedin'] . '
URL;TYPE=Tumblr:' . $user_info['user_info']['tumblr'] . '
URL;TYPE=Snapchat:https://snapchat.com/add/' . $user_info['user_info']['snapchat'] . '
X-WHATSAPP:' . $user_info['user_info']['whatsapp'] . '
X-SKYPE-USERNAME:' . $user_info['user_info']['skype'] . '
X-CUSTOM;Telegram:' . $user_info['user_info']['telegram'] . '
URL;TYPE=Telegram:https://t.me/' . $user_info['user_info']['telegram'] . '
X-CUSTOM;Messenger:' . $user_info['user_info']['fb_messenger'] . '
URL;TYPE=Messenger:https://m.me/' . $user_info['user_info']['fb_messenger'] . '
X-CUSTOM;Wechat:' . $user_info['user_info']['wechat'] . '
URL;TYPE=Cash App:https://cash.me/' . $user_info['user_info']['cash_app'] . '
URL;TYPE=PayPal:https://www.paypal.me/' . $user_info['user_info']['paypal'] . '
URL;TYPE=Venmo:https://venmo.com/' . $user_info['user_info']['paypal'] . '
URL;TYPE=YouTube:https://youtube.com/' . $user_info['user_info']['youtube'] . '
URL;TYPE=Vimeo:https://vimeo.com/' . $user_info['user_info']['vimeo'] . '
URL:
NOTE;CHARSET=utf-8:' . $user_info['user_info']['profession'] . '\n' . $user_info['user_info']['about_me'] . '
PHOTO;ENCODING=b;' . $user_image . '
END:VCARD');
    }
}
if (! function_exists('get_image_encoding')) {
    function get_image_encoding($path)
    {
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        return $base64 = 'TYPE=' . $type . ':' . base64_encode($data);
    }
}
if (! function_exists('remove_httpOrhttps')) {
    function remove_httpOrhttps($url) {
        $disallowed = array('http://', 'https://');
        foreach($disallowed as $d) {
            if(strpos($url, $d) === 0) {
                return str_replace($d, '', $url);
            }
        }
        return $url;
    }
}
if (! function_exists('getBarCodeImage')) {
    function getBarCodeImage($id,$type='url') {
        $real_id = $id;
        $invalid_codes = [415,416,417,418,419,420,421,422,423,424,425,426,427,428,429,430,431,432,433,434,435,436,437,438,439,440,441,442,443,444,445,446,447,448,449,450,451,452,453,454,455,456,457,458,459,460,461,462,463,464,465,466,467,468,469,470,471,472,473,474,475,476,477,478,479,480,481,482,483,484,485,486,487,488,489,490,491,492,493,494,495,496,497,498,499,500,501,502,503,504,505,506,507,508,509,510,511,512,513,514,515,516,517,518,519,520,521,522,523,524,525,526,527,528,529,530,531,532,533,534,535,536,537,538,539,540,541,542,543,544,545,546,547,548,549,550,551,552,553,554,555,556,557,558,559,560,561,562,563,564,565,566,567,568,569,570,571,572,573,574,575,576,577,578,579,580,581,582,583,584,585,586,587,588,589,590,591,592,593,594,595,596,597,598,599,600,601,602,603,604,605,606,607,608,609,610,611,612,613,614,615,616,617,618,619,620,621,622,623,624,625,626,627,628,629,630,631,632,633,634,635,636,637,638,639,640,641,642,643,644,645,646,647,648,649,650,651,652,653,654,655,656,657,658,659,660,661,662,663,664,665,666,667,668,669,670,671,672,673,674,675,676,677,678,679,680,681,682,683,684,685,686,687,688,689,690,691,692,693,694,695,696,697,698,699,700,701,702,703,704,705,706,707,708,709,710,711,712,713,714,715,716,717,718,719,720,721,722,723,724,725,726,727,728,729,730,731,732,733,734,735,736,737,738,739,740,741,742,743,744,745,746,747,748,749,750,751,752,753,754,755,756,757,758,759,760,761,762,763,764,765,766,767,768,769,770,771,772,773,774,775,776,777,778,779,780,781,782,783,784,785,786,787,788,789,790,791,792,793,794,795,796,797,798,799,800,801,802,803,804,805,806,807,808,809,810,811,812,813,814,815,816,817,818,819,820,821,822,823,824,825,826,827,828,829,830,831,832,833,834,835,836,837,838,839,840,841,842,843,844,845,846,847,848,849,850,851,852,853,854,855,856,857,858,859,860,861,862,863,864,865,866,867,868,869,870,871,872,873,874,875,876,877,878,879,880,881,882,883,884,885,886,887,888,889,890,891,892,893,894,895,896,897,898,899,900,901,902,903,904,905,906,907,908,909,910,911,912,913,914,915,916,917,918,919,920,921,922,923,924,925,926,927,928,929,930,931,932,933,934,935,936,937,938,939,940,941,942,943,944,945,946,947,948,949,950,951,952,953,954,955,956,957,958,959,960,961,962,963,964,965,966,967,968,969,970,971,972,973,974,975,976,977,978,979,980,981,982,983,984,985,986,987,988,989,990,991,992,993,994,995,996,997,998,999,1000,1001,1002,1003,1004,1005,1006,1007,1008,1009,1010,1011,1012,1013,1014,1015,1016,1017,1018,1019,1020,1021,1022,1023,1024,1025,1026,1027,1028,1029,1030,1031,1032,1033,1034,1035,1036,1037,1038,1039,1040,1041,1042,1043,1044,1045,1046,1047,1048,1049,1050,1051,1052,1053,1054,1055,1056,1057,1058,1059,1060,1061,1062,1063,1064,1065,1066,1067,1068,1069,1070,1071,1072,1073,1074,1075,1076,1077,1078,1079,1080,1081,1082,1083,1084,1085,1086,1087,1088,1089,1090,1091,1092,1093,1094,1095,1096,1097,1098,1099,1100,1101,1102,1103,1104,1105,1106,1107,1108,1109,1110,1111,1112,1113,1114,1115,1116,1117,1118,1119,1120,1121,1122,1123,1124,1125,1126,1127,1128,1129,1130,1131,1132,1133,1134,1135,1136,1137,1138,1139,1140,1141,1142,1143,1144,1145,1146,1147,1148,1149,1150,1151,1152,1153,1154,1155,1156,1157,1158,1159,1160,1161,1162,1163,1164,1165,1166,1167,1168,1169,1170,1171,1172,1173,1174,1175,1176,1177,1178,1179,1180,1181,1182,1183,1184,1185,1186,1187,1188,1189,1190,1191,1192,1193,1194,1195,1196,1197,1198,1199,1200,1201,1202,1203,1204,1205,1206,1207,1208,1209,1210,1211,1212,1213,1214,1215,1216,1217,1218,1219,1220,1221,1222,1223,1224,1225,1226,1227,1228,1229,1230,1231,1232,1233,1234,1235,1236,1237,1238,1239,1240,1241,1242,1243,1244,1245,1246,1247,1248,1249,1250,1251,1252,1253,1254,1255,1256,1257,1258,1259,1260,1261,1262,1263,1264,1265,1266,1267,1268,1269,1270,1271,1272,1273,1274,1275,1276,1277,1278,1279,1280,1281,1282,1283,1284,1285,1286,1287,1288,1289,1290,1291,1292,1293,1294,1295,1296,1297,1298,1299,1300,1301,1302,1303,1304,1305,1306,1307,1308,1309,1310,1311,1312,1313,1314,1315,1316,1317,1318,1319,1320,1321,1322,1323,1324,1325,1326,1327,1328,1329,1330,1331,1332,1333,1334,1335,1336,1337,1338,1339,1340,1341,1342,1343,1344,1345,1346,1347,1348,1349,1350,1351,1352,1353,1354,1355,1356,1357,1358,1359,1360,1361,1362,1363,1364,1365,1366,1367,1368,1369,1370,1371,1372,1373,1374,1375,1376,1377,1378,1379,1380,1381,1382,1383,1384,1385,1386,1387,1388,1389,1390,1391,1392,1393,1394,1395,1396,1397,1398,1399,1400,1401,1402,1403,1404,1405,1406,1407,1408,1409,1410,1411,1412,1413,1414];
        if(in_array($id,$invalid_codes)){
            $id = 'j'.$id;
        }
        $path = public_path('bar_codes/'.$id.'.png');
        if(file_exists($path)){
            if($type == 'url'){
                return url('bar_codes/'.$id.'.png');
            }else{
                return $path;
            }
        }else{
            \QrCode::backgroundColor(255, 255, 0)->color(255, 0, 127)
                ->format('png')->/*merge(public_path('themes/storefront/public/new/images/logo_qr.png'), 0.2, true)->*/size(1000)
                ->generate(route('cardLogin',\_encode($real_id)),$path);
            if($type == 'url'){
                return url('bar_codes/'.$id.'.png');
            }else{
                return $path;
            }
        }
    }
}
