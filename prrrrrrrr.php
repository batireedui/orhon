<?php
if (isset($_SESSION['userid'])) {
    if (isset($_POST['infoupdate'])) {
        $displayname = post('displayname', 200);
        $uphone = post('uphone', 50);
        $uemail = post('uemail', 100);
        $uaddress = post('uaddress', 1000);
        $error = [];
        _select(
            $cst,
            $ccount,
            "SELECT id FROM wp_users WHERE user_phone=?",
            "s",
            [$uphone],
            $cphone
        );
        if ($ccount > 0) {
            $error[] = $uphone + " утасны дугаар бүртгэлтэй байна.";
        }
        _select(
            $est,
            $ecount,
            "SELECT id FROM wp_users WHERE user_email=?",
            "s",
            [$uemail],
            $cemail
        );
        if ($ecount > 0) {
            $error[] = $uemail + " email хаяг бүртгэлтэй байна.";
        }
        if (sizeof($errors) == 0) {
            try {
                $success = _exec(
                    "UPDATE wp_users SET display_name=?, user_phone=?, user_email=?, user_address=? WHERE ID=?",
                    'ssssi',
                    [$displayname, $uphone, $uemail, $uaddress, $_SESSION['userid']],
                    $count
                );
                $_SESSION['display_name'] = $displayname;
                $_SESSION['user_phone'] = $uphone;
                $_SESSION['user_email'] = $uemail;
                $_SESSION['user_address'] = $uaddress;
            } catch (Exception $e) {
                $_SESSION['errors'] = ["Системийн алдаа гарлаа. Та дараа дахин оролдоно уу"];
                echo "Алдаа: " . $e->getMessage() . ' : ' . $e->getFile() . ' : ' . $e->getLine() . ' : Code ' . $e->getCode();
            } finally {
                if (isset($e)) {
                    logError($e);
                }
                $_SESSION['perror'] = $error;
                redirect('/front/profile');
            }
        } else {
            $_SESSION['perror'] = $error;
            redirect('/front/profile');
        }
    } else if (isset($_POST['passupdate'])) {
        if ($_SESSION['op'] == $_POST["oldpass"]) {
            try {
                $success = _exec(
                    "UPDATE wp_users SET user_pass=? WHERE ID=?",
                    'si',
                    [$_POST["newpass"], $_SESSION['userid']],
                    $count
                );
                $_SESSION['op'] = $_POST["newpass"];
                echo "Нууц үг солигдлоо";
            } catch (Exception $e) {
                $_SESSION['errors'] = ["Системийн алдаа гарлаа. Та дараа дахин оролдоно уу"];
                echo "Алдаа: " . $e->getMessage() . ' : ' . $e->getFile() . ' : ' . $e->getLine() . ' : Code ' . $e->getCode();
            } finally {
                if (isset($e)) {
                    logError($e);
                }
            }
        } else {
            echo "Хуучин нууц үг буруу байна";
        }
    }
} else
    redirect('/front/profile');
