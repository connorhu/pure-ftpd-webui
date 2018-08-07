<?php

require 'functions.php';
require 'config.php';
require 'vendor/autoload.php';

require 'prologue.php';

$info = '';

$sql = 'SELECT * FROM ftpd';
$sth = $dbh->prepare($sql);
$sth->execute();
$data = [];
foreach ($sth->fetchAll() as $row) {
    $data[] = $row;
}

$template = $twig->load('list_users.twig');
$variables = [
    'user' => $_SERVER['PHP_AUTH_USER'],
    'tab' => 'edit_users',
    'trans' => $translations,
    'version' => $version,
    'data' => $data,
];
echo $template->render($variables);
/*
                    elseif($_POST['edit']) {
                        echo "</br></br></br>";

                        // Проверяем были ли заполнены поля, если поля не были заполнены - выставляем переменную равной пустому полю
                        if (isset ($_POST['User'])) {$User = $_POST['User']; if ($User == '') {unset ($User);}}
                        if (isset ($_POST['status'])) {$status = $_POST['status']; if ($status == '') {unset ($status);}}
                        if (isset ($_POST['Password'])) {$Password = $_POST['Password']; if ($Password == '') {unset ($Password);}}
                        if (isset ($_POST['Dir'])) {$Dir = $_POST['Dir']; if ($Dir == '') {unset ($Dir);}}
                                                if (isset ($_POST['Uid'])) {$Uid = $_POST['Uid']; if ($Uid == '') {unset ($Uid);}}
                                                if (isset ($_POST['Gid'])) {$Gid = $_POST['Gid']; if ($Gid == '') {unset ($Gid);}}
                        if (isset ($_POST['ULBandwidth'])) {$ULBandwidth = $_POST['ULBandwidth']; if ($ULBandwidth == '') {unset ($ULBandwidth);}}
                        if (isset ($_POST['DLBandwidth'])) {$DLBandwidth = $_POST['DLBandwidth']; if ($DLBandwidth == '') {unset ($DLBandwidth);}}
                        if (isset ($_POST['ipaccess'])) {$ipaccess = $_POST['ipaccess']; if ($ipaccess == '') {unset ($ipaccess);}}
                        if (isset ($_POST['quotasize'])) {
                            $quotasize = $_POST['quotasize']; if ($quotasize == '') {
                                unset ($quotasize);
                            }
                        }
                        if (isset ($_POST['quotafiles'])) {
                            $quotafiles = $_POST['quotafiles']; if ($quotafiles == '') {
                                unset ($quotafiles);
                            }
                        }
                        if (isset ($_POST['id'])) {$id = $_POST['id']; if ($id == '') {unset ($id);}}

                        // Запрашиваем из БД настройки пользователя
                        $result = mysqli_query ($link, "SELECT * FROM ftpd WHERE id=$id");
                        $array = mysqli_fetch_array ($result);

                        // Проверяем были ли внесены какие-то изменения
                        if (($Dir != $array[Dir]) || ($User != $array[User]) || ($status != $array[status]) || (isset ($Password)) || ($ULBandwidth != $array[ULBandwidth]) || ($DLBandwidth != $array[DLBandwidth]) || ($ipaccess != $array[ipaccess]) || ($Uid != $array['Uid']) || ($Uid != $array['Uid']) || ($quotasize != $array[QuotaSize]) || ($quotafiles != $array[QuotaFiles])) {

                            if (($Uid != $array['Uid']) && isset ($id)) {
                                                                $result = mysqli_query ($link, "UPDATE ftpd SET Uid='$Uid' WHERE id='$id'");
                                                                if ($result == 'true') {echo "<p><strong>$um_edit_uidok</strong></p>";}
                                                                else {echo "<p><strong>$um_edit_uiderror</strong></p>";}

                                                        }
                            if (($Gid != $array['Gid']) && isset ($id)) {
                                                                $result = mysqli_query ($link, "UPDATE ftpd SET Gid='$Gid' WHERE id='$id'");
                                                                if ($result == 'true') {echo "<p><strong>$um_edit_folderok</strong></p>";}
                                                                else {echo "<p><strong>$um_edit_foldererror</strong></p>";}

                                                        }


                            // Если изменена папка пользователя, вносим изменения в базу
                            if (($Dir != $array[Dir]) && isset ($id)) {
                                $result = mysqli_query ($link, "UPDATE ftpd SET Dir='$Dir' WHERE id='$id'");
                                if ($result == 'true') {echo "<p><strong>$um_edit_folderok</strong></p>";}
                                else {echo "<p><strong>$um_edit_foldererror</strong></p>";}

                            }
                            // Если изменено имя пользователя, вносим изменения в базу
                            if (($User != $array[User]) && isset ($id)) {
                                $result = mysqli_query ($link, "UPDATE ftpd SET User='$User' WHERE id='$id'");
                                if ($result == 'true') {echo "<p><strong>$um_edit_loginok</strong></p>";}
                                else {echo "<p><strong>$um_edit_loginerror</strong></p>";}
                            }

                            // Если изменён статус пользователя, вносим изменения в базу
                            if (($status != $array[status]) && isset ($id)) {
                                $result = mysqli_query ($link, "UPDATE ftpd SET status='$status' WHERE id='$id'");
                                if ($result == 'true') {echo "<p><strong>$um_edit_statusok</strong></p>";}
                                else {echo "<p><strong>$um_edit_statuserror</strong></p>";}
                            }

                            // Если изменён пароль пользователя, вносим изменения в базу
                            if (isset ($Password)) {$Password = md5($Password);
                                if (($Password != $array[Password]) && isset ($id)) {
                                    $result = mysqli_query ($link, "UPDATE ftpd SET Password='$Password' WHERE id='$id'");
                                    if ($result == 'true') {echo "<p><strong>$um_edit_passwdok</strong></p>";}
                                    else {echo "<p><strong>$um_edit_passwderror</strong></p>";}}
                            }

                            // Если изменено ограничение скорости загрузки, вносим изменения в базу
                            if (($ULBandwidth != $array[ULBandwidth]) && isset ($id)) {
                                $result = mysqli_query ($link, "UPDATE ftpd SET ULBandwidth='$ULBandwidth' WHERE id='$id'");
                                if ($result == 'true') {echo "<p><strong>$um_edit_ullimitok</strong></p>";}
                                else {echo "<p><strong>$um_edit_ullimiterror</strong></p>";}
                            }

                            // Если изменено ограничение скорости скачивания, вносим изменения в базу
                            if (($DLBandwidth != $array[DLBandwidth]) && isset ($id)) {
                                $result = mysqli_query ($link, "UPDATE ftpd SET DLBandwidth='$DLBandwidth' WHERE id='$id'");
                                if ($result == 'true') {echo "<p><strong>$um_edit_dllimitok</strong></p>";}
                                else {echo "<p><strong>$um_edit_dllimiterror</strong></p>";}
                            }
                            // Если изменён разрешенный IP адрес, вносим изменения в базу
                            if (($ipaccess != $array[ipaccess]) && isset ($id)) {
                                $result = mysqli_query ($link, "UPDATE ftpd SET ipaccess='$ipaccess' WHERE id='$id'");
                                if ($result == 'true') {echo "<p><strong>$um_edit_permipok</strong></p>";}
                                else {echo "<p><strong>$um_edit_permiperror</strong></p>";}
                            }
                            // Если изменён размер квоты, вносим изменения в базу
                            if (($quotasize != $array[QuotaSize]) && isset ($id)) {
                                $result = mysqli_query ($link, "UPDATE ftpd SET QuotaSize='$quotasize' WHERE id='$id'");
                                if ($result == 'true') {
                                    echo "<p><strong>$um_edit_quotasizeok</strong></p>";
                            }
                            else {echo "<p><strong>$um_edit_quotasizeerror</strong></p>";}
                            }
                            // Если изменён размер квоты, вносим изменения в базу
                            if (($quotafiles != $array[QuotaFiles]) && isset ($id)) {
                                $result = mysqli_query ($link, "UPDATE ftpd SET QuotaFiles='$quotafiles' WHERE id='$id'");
                                if ($result == 'true') {
                                    echo "<p><strong>$um_edit_quotafilesok</strong></p>";
                            }
                            else {echo "<p><strong>$um_edit_quotafileserror</strong></p>";
                            }
                            }
                        }
                        else {echo"<p><strong>$um_edit_nochanges</strong></p>";}

                    echo"</br>
                            <form name='to_list' method='post' action='$PHP_SELF'>
                                <p>
                                    <label>
                                    <input type='submit' name='users' id='users' value='$um_edit_nochangesback'>
                                    </label>
                                </p>
                            </form>";
                    }
*/
