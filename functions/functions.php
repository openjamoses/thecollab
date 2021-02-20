<?php
error_reporting(E_ALL);

function generatePassword($length = 8) {

    // start with a blank password
    $password = "";

    // define possible characters - any character in this string can be
    // picked for use in the password, so if you want to put vowels back in
    // or add special characters such as exclamation marks, this is where
    // you should do it
    $possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";

    // we refer to the length of $possible a few times, so let's grab it now
    $maxlength = strlen($possible);

    // check for length overflow and truncate if necessary
    if ($length > $maxlength) {
        $length = $maxlength;
    }

    // set up a counter for how many characters are in the password so far
    $i = 0;

    // add random characters to $password until $length is reached
    while ($i < $length) {

        // pick a random character from the possible ones
        $char = substr($possible, mt_rand(0, $maxlength - 1), 1);

        // have we already used this character in $password?
        if (!strstr($password, $char)) {
            // no, so it's OK to add it onto the end of whatever we've already got...
            $password .= $char;
            // ... and increase the counter by one
            $i++;
        }
    }

    // done!
    return $password;
}

function escape($string) {
    return htmlentities($string);
}

function english_date($date) {
    $create_date = date_create($date);
    $new_date = date_format($create_date, "j M Y");
    return $new_date;
}

function redirect($message, $url) {
    ?>
    <script type="text/javascript">
        //        function Redirect()
        //        {
        //            window.location = "<?php echo $url; ?>";
        //        }
        //        alert('<?php echo $message; ?>');
        //        setTimeout('Redirect()', 10);
        alert('<?php echo $message; ?>');
        window.location = "<?php echo $url; ?>"
    </script>
    <?php
}

function english_date_time($date) {
    $create_date = date_create($date);
    $new_date = date_format($create_date, "jS F Y  H:i:s a");
    return $new_date;
}

function ugandan_shillings($value) {
    $value = number_format($value, 0, ".", ",");
    return $value . " UGx";
}

function addMonthsToDate($months, $dateCovert) {
    $date = date_create($dateCovert);
    date_add($date, date_interval_create_from_date_string($months . ' months'));
    return date_format($date, 'Y-m-d');
}

function calculateAge($smallDate, $largeDate) {
    $age = "";
    $diff = date_diff(date_create($smallDate), date_create($largeDate));
    $age .= ($diff->y > 0) ? $diff->y : "";

    return $age;
}

function calculateArrayProductSum($array1, $array2) {
    $result = 0;
    for ($x = 0; $x < count($array1); $x++) {
        $result += ($array1[$x] * $array2[$x]);
    }
    return $result;
}

function getStaffNamebyID($staff_id) {
    $name = DB::getInstance()->getName("staff_tb", $staff_id, "staff_name", "staff_id");
    if ($staff_id == $_SESSION['staff_id']) {
        return "You";
    } else {
        return $name;
    }
}

function checkUserInvites($collab_id, $user_id) {
    $sqlQuery = "SELECT * FROM collab_invites WHERE users_id = '$user_id' AND contribution_id = '$collab_id'";
    return DB::getInstance()->checkRows($sqlQuery);
}

function checkUserObjectives($objective_id, $invites_id) {
    $sqlQuery = "SELECT * FROM objective_users WHERE study_objectives_id = '$objective_id' AND invites_id = '$invites_id'";
    return DB::getInstance()->checkRows($sqlQuery);
}

function countActivities($objective_id) {
    $sqlQuery = "SELECT * FROM study_activity WHERE study_objectives_id = '" . $objective_id . "' ORDER BY study_activity_name ASC";
    $obj_counts = DB::getInstance()->countElements($sqlQuery);
    return $obj_counts;
}

function countInvitesObjectives($objective_id) {
    $sqlQuery = "SELECT * FROM objective_users WHERE study_objectives_id = '$objective_id' ";
    $obj_counts = DB::getInstance()->countElements($sqlQuery);
    return $obj_counts + 1;
}

function getLastUpdate($collab_id) {
    $sqlQuery = "SELECT contribution_date,contribution_time FROM contributers c, study_activity s, study_objectives o WHERE o.study_objectives_id = s.study_objectives_id AND s.study_activity_id = c.study_activity_id AND o.contribution_id = '$collab_id' ORDER BY contributers_id DESC LIMIT 1 ";
    $_name = "";
    $users_list = DB::getInstance()->query($sqlQuery);
    foreach ($users_list->results() as $users):
        $_name = $users->contribution_date . " " . $users->contribution_time;
    endforeach;
    return $_name;
}

function checkUserInvitesObjective($collab_id, $objective_id, $user_id) {
    $sqlQuery = "SELECT *  FROM collab_invites i,study_objectives s, objective_users o WHERE  s.objective_lead = '" . $user_id . "' OR (o.study_objectives_id = s.study_objectives_id  AND o.invites_id = i.invites_id AND i.users_id = '$user_id' AND i.contribution_id = '" . $collab_id . "' ) AND s.study_objectives_id = '" . $objective_id . "' ";
    //$sqlQuery = "SELECT DISTINCT s.study_objectives_id,objectives_name,users_name,s.contribution_id, objective_lead FROM collab_invites i,study_objectives s, users_tb u, objective_users o WHERE (( i.invites_id = o.invites_id AND i.users_id = u.users_id AND o.study_objectives_id = s.study_objectives_id AND o.invites_id = i.invites_id AND i.users_id = '$user_id' ) OR ( objective_lead = u.users_id AND objective_lead = '$user_id' )) AND i.contribution_id = '$collab_id' AND s.contribution_id = '$collab_id' AND s.study_objectives_id = '$objective_id' ";
    //$sqlQuery = "SELECT * FROM objective_users o, collab_invites c, study_objectives s WHERE s.study_objectives_id = o.study_objectives_id AND o.study_objectives_id = '$objective_id' AND o.invites_id = c.invites_id AND (c.users_id = '$user_id' OR s.objective_lead = '$user_id' )";
    return DB::getInstance()->checkRows($sqlQuery);
}

function getUsersActivitySelect($objective_id, $user_id) {
    $sqlQuery = "SELECT * FROM objective_users o, collab_invites c, study_activity s WHERE s.study_objectives_id = o.study_objectives_id AND s.study_objectives_id = '$objective_id' AND o.invites_id = c.invites_id AND (c.users_id = '$user_id' OR s.objective_lead = '$user_id' )";
    $staff_list = DB::getInstance()->query($sqlQuery);
    echo '<select class="chosen span4" name="activity" data-placeholder="Select activity!" required="">
    <option value=""></option>';
    foreach ($staff_list->results() as $users) {
        echo '<option value="' . $users->study_activity_id . '"> ' . $users->study_activity_name . '</option> ';
    }
    echo '</select>';
    return DB::getInstance()->checkRows($sqlQuery);
}

function checkUplpoads($contributers_id) {
    $query = "SELECT * FROM upload_tb WHERE contributers_id = '" . $contributers_id . "'";
    return DB::getInstance()->checkRows($query);
}

function savenewEvent($event_time, $event_body, $ipAddress, $login_id, $event_name, $event_type) {
    $insertQuery = DB::getInstance()->insert("event_tb", array(
        'event_time' => $event_time,
        'events_body' => $event_body,
        'ipaddress' => $ipAddress,
        'login_stats_id' => $login_id,
        'event_name' => $event_name,
        'event_type' => $event_type
    ));
}

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function countUplpoads($contributers_id) {
    $query = "SELECT * FROM upload_tb WHERE contributers_id = '" . $contributers_id . "'";
    $count = DB::getInstance()->countElements($query);
    return $count;
}

function getUplpoads($contributers_id) {
    $query = "SELECT * WHERE contributers_id = '" . $contributers_id . "'";
    $count = DB::getInstance()->countElements($query);
    $upload_name = "";
    $users_list = DB::getInstance()->query($query);
    foreach ($users_list->results() as $users):
        $upload_name = $users->upload_path;
    endforeach;
    return $upload_name;
}

function editTopic($user_type) {

    $query = "SELECT * FROM contributers WHERE user_type ='" . $user_type . "'";
    $count = DB::getInstance()->countElements($query);
    $user_role = "";
    $users_list = DB::getInstance()->query($query);
    foreach ($users_list->results() as $users):
        $upload_name = $users->user_type;
    endforeach;
    return $user_role;
}

function countCollaborations($collab_id) {
    $sqlQuery = "SELECT DISTINCT contribution_body FROM contributers c, study_objectives sb, study_activity sa WHERE sa.study_activity_id = c.study_activity_id AND sa.study_objectives_id = sb.study_objectives_id AND sb.contribution_id = '$collab_id'";
    return DB::getInstance()->countElements($sqlQuery);
}

function countInvites($collab_id) {
    $sqlQuery = "SELECT * FROM collab_invites WHERE contribution_id = '$collab_id'";
    return DB::getInstance()->countElements($sqlQuery) + 1;
}

function downloadFile($path, $file) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/force-download');
    header("Content-Disposition: attachment; filename=\"" . basename($file) . "\";");
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($path . $file);
}

function createZip($file, $dir) {
    $password = $_SESSION['password'];
    $zipFile = explode('.', $file)[0];
    shell_exec('zip -P ' . $password . ' ' . $zipFile . '.zip ' . $dir . $file);
    // unlink($fileName);
    //return file_exists($zipFileName.'.zip');
    /**
      $zip = new ZipArchive();

      $filename = $dir.explode('.', $file)[0].".zip";

      if ($zip->open($filename, ZipArchive::CREATE) !== TRUE) {
      exit("cannot open <$filename>\n");
      }
      //$dir = $upl;
      // Create zip
      zipNow($zip, $dir);
      $zip->close();
     * 
     * @param type $zip
     * @param type $dir**
     */
}

function createZipFile($file, $path) {
    $zip = new ZipArchive();
    //explode(".", $file)[0];
    $zipFile = $path . explode(".", $file)[0] . '.zip';
    if (file_exists($zipFile)) {
        unlink($zipFile);
    }
    $zipStatus = $zip->open($zipFile, ZipArchive::CREATE);
    if ($zipStatus !== true) {
        throw new RuntimeException(sprintf('Failed to create zip archive. (Status code: %s)', $zipStatus));
    }

    $password = $_SESSION['password'];
    if (!$zip->setPassword($password)) {
        throw new RuntimeException('Set password failed');
    }

// compress file
    //$fileName = __DIR__ . '/test.pdf';
    $fileName = $path . $file;
    $baseName = basename($fileName);
    try {
        $zip->addFile($fileName, $baseName);
    } catch (Exception $ex) {
        echo $x;
    }
    //if (!$zip->addFile($fileName, $baseName)) {
    //    throw new RuntimeException(sprintf('Add file failed: %s', $fileName));
    //}
// encrypt the file with AES-256
    if (!$zip->setEncryptionName($baseName, ZipArchive::EM_AES_256)) {
        throw new RuntimeException(sprintf('Set encryption failed: %s', $baseName));
    }

    $zip->close();
}

// Create zip
function zipNow($zip, $dir) {
    if (is_dir($dir)) {

        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                // If file
                if (is_file($dir . $file)) {
                    if ($file != '' && $file != '.' && $file != '..') {

                        $zip->addFile($dir . $file);
                    }
                } else {
                    // If directory
                    if (is_dir($dir . $file)) {

                        if ($file != '' && $file != '.' && $file != '..') {

                            // Add empty directory
                            $zip->addEmptyDir($dir . $file);

                            $folder = $dir . $file . '/';

                            // Read data of the folder
                            createZip($zip, $folder);
                        }
                    }
                }
            }
            closedir($dh);
        }
    }
}

function encryption($filename, $destination, $password) {
    $handle = fopen($filename, "rb") or die("Could not open the file!");
    $contents = fread($handle, filesize($filename));
    fclose($handle);

    $iv = substr(md5("\x18\x3C\x58" . $password, TRUE), 0, 8);
    $key = substr(md5("x2D\xFC\xD8" . $password, true) . md5("x2D\xFC\xD8" . $password, true), 0, 24);
    $opts = array("iv" => $iv, "keys" => $key);
    $fp = fopen($destination, "wb") or die("Could not open file for writing");
    stream_filter_append($stream, $filtername);
}

/**
 * Encrypt the passed file and saves the result in a new file with ".enc" as suffix.
 * 
 * @param string $source Path to file that should be encrypted
 * @param string $key    The key used for the encryption
 * @param string $dest   File name where the encryped file should be written to.
 * @return string|false  Returns the file name that has been created or FALSE if an error occured
 */
function encryptFile($source, $key, $dest) {
    $key = substr(sha1($key, true), 0, 16);
    $iv = openssl_random_pseudo_bytes(16);

    $error = false;
    if ($fpOut = fopen($dest, 'w')) {
        // Put the initialzation vector to the beginning of the file
        fwrite($fpOut, $iv);
        if ($fpIn = fopen($source, 'rb')) {
            while (!feof($fpIn)) {
                $plaintext = fread($fpIn, 16 * FILE_ENCRYPTION_BLOCKS);
                $ciphertext = openssl_encrypt($plaintext, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $iv);
                // Use the first 16 bytes of the ciphertext as the next initialization vector
                $iv = substr($ciphertext, 0, 16);
                fwrite($fpOut, $ciphertext);
            }
            fclose($fpIn);
        } else {
            $error = true;
        }
        fclose($fpOut);
    } else {
        $error = true;
    }

    return $error ? false : $dest;
}

// Download Created Zip file
function download($file, $dir) {

    $filename = $dir . $file;

    header('Content-Description: File Transfer');
    header('Content-Type: application/force-download');
    header("Content-Disposition: attachment; filename=\"" . basename($filename) . "\";");
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filename));
    ob_clean();
    flush();
    readfile("/Users/john/Desktop/outputs/" . $file); //showing the path to the server where the file is to be download
    exit;
}

/**
 * Dencrypt the passed file and saves the result in a new file, removing the
 * last 4 characters from file name.
 * 
 * @param string $source Path to file that should be decrypted
 * @param string $key    The key used for the decryption (must be the same as for encryption)
 * @param string $dest   File name where the decryped file should be written to.
 * @return string|false  Returns the file name that has been created or FALSE if an error occured
 */
function decryptFile($source, $key, $dest) {
    $key = substr(sha1($key, true), 0, 16);

    $error = false;
    if ($fpOut = fopen($dest, 'w')) {
        if ($fpIn = fopen($source, 'rb')) {
            // Get the initialzation vector from the beginning of the file
            $iv = fread($fpIn, 16);
            while (!feof($fpIn)) {
                $ciphertext = fread($fpIn, 16 * (FILE_ENCRYPTION_BLOCKS + 1)); // we have to read one block more for decrypting than for encrypting
                $plaintext = openssl_decrypt($ciphertext, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $iv);
                // Use the first 16 bytes of the ciphertext as the next initialization vector
                $iv = substr($ciphertext, 0, 16);
                fwrite($fpOut, $plaintext);
            }
            fclose($fpIn);
        } else {
            $error = true;
        }
        fclose($fpOut);
    } else {
        $error = true;
    }

    return $error ? false : $dest;
}
?>
