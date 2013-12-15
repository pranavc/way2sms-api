<?php
          
          sendSMS("9999999999","*********", "mob.no to send msg", "ur message");
    
    
          function sendSMS($uid, $pwd, $ph, $message) {
    		$phone=explode(",",$ph);
    		$msg1=str_split(urlencode($message),140);
            $curl = curl_init();
            $timeout = 60;
            $uid = urlencode($uid);
            $pwd = urlencode($pwd);
            $autobalancer = rand(1, 8);
            curl_setopt($curl, CURLOPT_URL, "http://site" . $autobalancer . ".way2sms.com/Login1.action");
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, "username=" . $uid . "&password=" . $pwd . "&button=Login");
            curl_setopt($curl, CURLOPT_COOKIESESSION, 1);
            curl_setopt($curl, CURLOPT_COOKIEFILE, "JSESSIONID");
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($curl, CURLOPT_MAXREDIRS, 20);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0");
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
            curl_setopt($curl, CURLOPT_REFERER, "http://site" . $autobalancer . ".way2sms.com/");
            $text = curl_exec($curl);
            //echo $text;
            preg_match_all('/<input[\s]*type="hidden"[\s]*name="id"[\s]*id="id"[\s]*value="?([^>]*)?"/si', $text, $match);
            preg_match_all('/<input[\s]*type="hidden"[\s]*name="data"[\s]*id="data"[\s]*value="?([^>]*)?"/si', $text, $match1);
            $id = $match[1][0];
            $dt = $match[1][0];
            if (curl_errno($curl))
                return "access error : " . curl_error($curl);
            $pos = stripos(curl_getinfo($curl, CURLINFO_EFFECTIVE_URL), "MainView.action");
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
            curl_setopt($curl, CURLOPT_URL, "http://site" . $autobalancer . ".way2sms.com/jsp/InstantSMS.jsp");
            curl_setopt($curl, CURLOPT_URL, "http://site" . $autobalancer . ".way2sms.com/Main.action?id=" . $id . "&data=" . $dt);
            $text1 = curl_exec($curl);
            preg_match_all('/<input[\s]*type="hidden"[\s]*name="Token"[\s]*id="Token"[\s]*value="?([^>]*)?"/si', $text1, $match2);
            curl_setopt($curl, CURLOPT_URL, 'http://site' . $autobalancer . '.way2sms.com/singles.action?Token=' . $match2[1][0]);
            $text3 = curl_exec($curl);
            if (!preg_match_all("/<input[^>]*id='t_15_k_5'[\s]*value='?([^>]*)?'/si", $text3, $m3))
                preg_match_all("/<textarea[\s]*style='display:[\s]*none;'[\s]*name='t_15_k_5'[\s]*id='t_15_k_5'>?([^>]*)?<\/textarea>/si", $text3, $m3);
            $t_15_k_5 = $m3[1][0];
            if (!preg_match_all("/<input[^>]*id='m_15_b'[\s]*value='?([^>]*)?'/si", $text3, $m4))
                preg_match_all("/<textarea[\s]*style='display:[\s]*none;'[\s]*name='m_15_b'[\s]*id='m_15_b'>?([^>]*)?<\/textarea>/si", $text3, $m4);
            $m_15_b = $m4[1][0];
            preg_match_all('/"name",[\s]*"?([^>]*)?"\);\r\nelement.setAttribute\("id",/si', $text3, $m5);
            foreach ($phone as $key => $value) {
                foreach ($msg1 as $msg) {
                    $url0 = "http://site$autobalancer.way2sms.com/sndqsms.action?";
                    $url0.= $m_15_b . "=" . $value . '&' . $t_15_k_5 . "=";
                    $url0.= $match2[1][0] . "&" . $m5[1][0] . "=&Token=";
                    $url0.= $match2[1][0] . "&a_m_p=snsms&adno=1&catnamedis=Birthday&catnamedis=Birthday&m_15_b=";
                    $url0.= $m_15_b . "&pftDo=sndqsms&pjkdws=sa65sdf656fdfd&t_15_k_5=";
                    $url0.= $t_15_k_5 . "&textArea=" . $msg . "&textfield2=%2B91";
                    $url0.= "&txtLen=" . (140 - strlen($msg)) . "&w2sms=w2sms";
                    $url1 = "http://site$autobalancer.way2sms.com/smstoss.action?";
                    $url1.= $t_15_k_5 . "=" . $match2[1][0];
                    $url1.="&Token=" . $match2[1][0] . "&a_m_p=snsms&adno=1&catnamedis=Birthday&catnamedis=Birthday&";
                    $url1 .= $m_15_b . "=" . $value . "&m_15_b=" . $m_15_b . "&pjkdws=sa65sdf656fdfd&smsActTo=smstoss&t_15_k_5=" . $t_15_k_5;
                    $url1.="&textArea=" . $msg . "&textfield2=%2B91";
                    $url1.="&txtLen=" . (140 - strlen($msg)) . "&w2sms=w2sms&";
                    $url1.=$m5[1][0] . "=";
                    curl_setopt($curl, CURLOPT_URL, $url0);
                    curl_exec($curl);
                    curl_setopt($curl, CURLOPT_URL, $url1);
                    curl_exec($curl);
                }
            }
            curl_setopt($curl, CURLOPT_REFERER, curl_getinfo($curl, CURLINFO_EFFECTIVE_URL));
            curl_setopt($curl, CURLOPT_URL, "http://site" . $autobalancer . ".way2sms.com/LogOut");
            $text4 = curl_exec($curl);
            curl_close($curl);
        }
    ?>
