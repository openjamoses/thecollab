<?php

if (isset($_POST["invite_collaborator"]) && isset($_POST["collab_id"]) && isset($_POST["user_id"])) {
    $collab_id = $_POST['collab_id'];
    $user_id = $_POST['user_id'];
    $date_time = $date_today . " " . $current_time;
    if (checkUserInvites($collab_id, $user_id)) {
        DB::getInstance()->query("DELETE FROM collab_invites WHERE users_id = '" . $user_id . "' AND contribution_id = '" . $collab_id . "'");
        $event_body = "Removed collaborator";
        $event_name = "collaborator";
        $event_type = "Removed";
        $ipAddress = get_client_ip();
        $login_id = $_SESSION['login_id'];
        savenewEvent($current_time, $event_body, $ipAddress, $login_id, $event_name, $event_type);

        echo '<div class="alert alert-warning">Collaborator removed!</div>';
    } else {
        DB::getInstance()->insert("collab_invites", array(
            "users_id" => $user_id,
            "contribution_id" => $collab_id,
            "invites_date_time" => $date_time
        ));
        $event_body = "Invited new collaborator";
        $event_name = "collaborator";
        $event_type = "Invite";
        $ipAddress = get_client_ip();
        $login_id = $_SESSION['login_id'];
        savenewEvent($current_time, $event_body, $ipAddress, $login_id, $event_name, $event_type);

        echo '<div class="alert alert-success">The Collaborator invited Successfully!</div>';
    }
}

if (isset($_POST["add_new_objective_rows"]) && isset($_POST["row_ids"]) && isset($_POST["collab_id"])) {
    $row_ids = $_POST["row_ids"];
    $collab_id = $_POST["collab_id"];
    $lead_id = DB::getInstance()->getName("contribution_tb", $collab_id, "user", "contribution_id");
    $lead = DB::getInstance()->getName("users_tb", $lead_id, "users_name", "users_id");

    echo '<div id="' . $row_ids . '">

                                        <select class="chosen span5" name="lead[]" id="lead_' . $row_ids . '" data-placeholder="Assign lead collaborator" required="">
                                            <option value=""> -- Select Lead -- </option>
    <option value="' . $lead_id . '"> ' . $lead . ' </option>';

    $query = "SELECT * FROM users_tb u, collab_invites c WHERE c.users_id = u.users_id AND contribution_id = '" . $collab_id . "' ORDER BY users_name ASC";
    if (DB::getInstance()->checkRows($query)) {

        $users_list = DB::getInstance()->query($query);
        foreach ($users_list->results() as $users):

            echo '<option value="' . $users->users_id . '">' . $users->users_name . '</option>';

        endforeach;
    }

    echo ' </select>
                                        <div class="input-prepend">
                                            <span class="add-on" onclick="delete_item(' . $row_ids . ');"><i class="icon-minus-sign"></i></span>
                                            <textarea rows="2" class="span4" name="objective[]" id="name_' . $row_ids . '" placeholder="Enter the Objective here!"  required=""></textarea>
                                            
                                        </div>
                                        </div>';
}


if (isset($_POST["add_new_activity_rows"]) && isset($_POST["row_ids"])) {
    $row_ids = $_POST["row_ids"];
    echo '<div id="' . $row_ids . '">
                                        <div class="input-prepend">
                                            <span class="add-on" onclick="delete_item(' . $row_ids . ');"><i class="icon-minus-sign"></i></span>
                                            <textarea rows="2" class="span4" name="activity[]" id="name_' . $row_ids . '" placeholder="Enter the activity here!"  required=""></textarea>
                                            
                                        </div>
                                        </div>';
}
if (isset($_POST["invite_user_objectives"]) && isset($_POST["invite_id"]) && isset($_POST["objectives_id"])) {
    $invite_id = $_POST['invite_id'];
    $objectives_id = $_POST['objectives_id'];
    if (checkUserObjectives($objectives_id, $invite_id)) {
        DB::getInstance()->query("DELETE FROM objective_users WHERE study_objectives_id = '" . $objectives_id . "' AND invites_id = '" . $invite_id . "'");
        echo '<div class="alert alert-warning">Collaborator removed!</div>';
    } else {
        DB::getInstance()->insert("objective_users", array(
            "study_objectives_id" => $objectives_id,
            "invites_id" => $invite_id,
            "objective_users_status" => 0
        ));
        echo '<div class="alert alert-success">Collaborator added Successfully!</div>';
    }
}

if (isset($_POST["fetch_activity_by_user"]) && isset($_POST["users_id"]) && isset($_POST["objectives_id"]) && isset($_POST["collab_id"])) {
    $collab_id = $_POST['collab_id'];
    $objectives_id = $_POST['objectives_id'];
    $users_id = $_POST['users_id'];
    $objQuery = "SELECT DISTINCT ac.study_activity_id,ac.study_activity_name FROM collab_invites i,study_objectives s, users_tb u, objective_users o, study_activity ac WHERE (( i.invites_id = o.invites_id AND i.users_id = u.users_id AND o.study_objectives_id = s.study_objectives_id AND o.invites_id = i.invites_id AND i.users_id = '$users_id' ) OR ( objective_lead = u.users_id AND objective_lead = '$users_id' )) AND i.contribution_id = '$collab_id' AND s.contribution_id = '$collab_id' AND ac.study_objectives_id = s.study_objectives_id AND ac.study_objectives_id = '$objectives_id' ";
    //echo $objQuery;
    if (DB::getInstance()->checkRows($objQuery)) {

        //echo '<div class="alert alert-info">'.DB::getInstance()->countElements($objQuery).' activities has been registered for this objective!</div>';

        echo ' <select class="chosen span6" name="activity" data-placeholder="Select Objective" required="">
                                                        <option value=""> -- Select Activity -- </option>';
        $users_list = DB::getInstance()->query($objQuery);
        foreach ($users_list->results() as $users):
            echo ' <option value="' . $users->study_activity_id . '">' . $users->study_activity_name . '</option>';
        endforeach;
        echo '</select>';
    }else {
        //echo 0;
        echo '<div class="alert alert-warning">No activity has been registered for this objective!</div>';
    }
}
if (isset($_POST["add_new_files_rows"]) && isset($_POST["row_ids"])) {
    $row_ids = $_POST["row_ids"];
    echo '<div id="' . $row_ids . '"  class="input-prepend">
            <span class="add-on" onclick="delete_item(' . $row_ids . ');"><i class="icon-minus-sign"></i></span> 
        <input type="file" name="uploads[]"  required="" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain,image/*" class="span4 tip" />                           
        </div>';
}

if (isset($_POST["add_download_file"]) && isset($_POST["upload_id"])) {
    $upload_id = $_POST["upload_id"];
    $file_name = DB::getInstance()->getName("upload_tb", $upload_id, "upload_name", "upload_id");
    //echo 'hello';
    try {
        download($file_name, $upload_directory);
        // $fileName = __DIR__ . '/testfile.txt';
        $key = 'openjamosesopm@gmail.com';
        //file_put_contents($fileName, 'Hello World, here I am.');
        // encryptFile($upload_directory.$file_name, $key, $upload_directory.$file_name . '.enc');
        //decryptFile($upload_directory.$file_name . '.enc', $key,$upload_directory. $file_name . '.dec');
        echo '<div class="alert alert-success">Download complete successfully!</div>';
    } catch (Exception $e) {
        echo '<div class="alert alert-warning">Error:' . $e . ' </div>';
    }
    /**
      try {
      header('Content-Description: File Transfer');
      header('Content-Type: application/force-download');
      header("Content-Disposition: attachment; filename=\"" . basename($file_name) . "\";");
      header('Content-Transfer-Encoding: binary');
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize($file_name));
      ob_clean();
      flush();
      readfile($upload_directory . $file_name);

      } catch (Exception $ex) {

      }* */
}

if (isset($_POST["get_calender"]) && isset($_POST["activities"])) {
    $users_id = $_SESSION['id'];
    $objQuery = "SELECT DISTINCT ac.study_activity_id,ac.study_activity_name,ac.study_start,ac.study_end FROM collab_invites i,study_objectives s, users_tb u, objective_users o, study_activity ac WHERE (( i.invites_id = o.invites_id AND i.users_id = u.users_id AND o.study_objectives_id = s.study_objectives_id AND o.invites_id = i.invites_id AND i.users_id = '$users_id' ) OR ( objective_lead = u.users_id AND objective_lead = '$users_id' )) AND i.contribution_id = s.contribution_id AND ac.study_objectives_id = s.study_objectives_id ";
    $jsonArray = array();
    if (DB::getInstance()->checkRows($objQuery)) {
        $users_list = DB::getInstance()->query($objQuery);
        foreach ($users_list->results() as $users):
            $datess = $users->study_start;
            $jsonArray[] = array(
                'title' => $users->study_activity_name,
                'start' => new date(explode("-", $datess)[0], explode("-", $datess)[1], explode("-", $datess)[2])
                    // 'end' => new Date(y, m, d + 7)
            );
        endforeach;
        echo json_encode($jsonArray);
    }
}




/**
  //Display all data in the select

  if (isset($_POST['display_selects']) && $_POST['display_selects'] == "display_selects" && $_POST['id_column'] != "") {
  $table_name = Input::get("table_name");
  $id_column = Input::get("id_column");
  $other_column = Input::get("other_column");

  //echo $table_name . " " . $id_column . " " . $other_column;
  //if ($table_name == "drink") {
  if ($table_name == 'dish_served') {
  echo '<option value=""> Select....</option>';
  $sqlQuery = "SELECT * FROM dish_served  ORDER BY Dish_Name ASC";
  $dish_list = DB::getInstance()->query($sqlQuery);
  foreach ($dish_list->results() as $dishs) {
  $quantityAvailable = DB::getInstance()->calculateSum("SELECT * FROM stock_in WHERE Dish_Id ='$dishs->Dish_Id'", "Quantity");
  $quantityTaken = DB::getInstance()->calculateSum("SELECT * FROM stock_out WHERE Dish_Id ='$dishs->Dish_Id'", "Quantity_Taken");
  $quantityAvailable = ($quantityAvailable - $quantityTaken >= 0) ? $quantityAvailable - $quantityTaken : 0;
  if ($quantityAvailable > 0 || $dishs->Dish_Type == 0) {
  echo '<option value="' . $dishs->Dish_Id . '">' . $dishs->Dish_Name . '</option>';
  }
  }
  } elseif ($table_name == 'drink') {
  echo '<option value=""> Select....</option>';
  $sqlQuery = "SELECT * FROM drink  ORDER BY Drink_Name ASC";
  $drink_list = DB::getInstance()->query($sqlQuery);
  foreach ($drink_list->results() as $drinks) {
  $quantityAvailable = DB::getInstance()->calculateSum("SELECT * FROM stock_in WHERE Drink_Id ='$drinks->Drink_Id'", "Quantity");
  $quantityTaken = DB::getInstance()->calculateSum("SELECT * FROM stock_out WHERE Drink_Id ='$drinks->Drink_Id'", "Quantity_Taken");
  $quantityAvailable = ($quantityAvailable - $quantityTaken >= 0) ? $quantityAvailable - $quantityTaken : 0;
  //echo 'Table2';
  if ($quantityAvailable > 0) {
  echo '<option value="' . $drinks->Drink_Id . '">' . $drinks->Drink_Name . '</option>';
  }
  }
  } else {
  echo DB::getInstance()->dropDowns($table_name, $id_column, $other_column);
  }
  }
  //Calculating Total on selecting item
  if (isset($_POST['calculate_total']) && $_POST['id_value'] != "" && $_POST['amount_taken'] != "") {

  $table_name = Input::get("table_name");
  $id_column = Input::get("id_column");
  $other_column = Input::get("other_column");
  $id_value = Input::get("id_value");

  $item_price = DB::getInstance()->getName($table_name, $id_value, $other_column, $id_column);
  echo $total_amount = $_POST['amount_taken'] * $item_price;
  }
  //Display standard on selecting item
  if (isset($_POST['display_column_name']) && $_POST['id_value'] != "" && $_POST['other_column'] != "") {
  $table_name = Input::get("table_name");
  $id_column = Input::get("id_column");
  $other_column = Input::get("other_column");
  $id_value = Input::get("id_value");
  echo DB::getInstance()->getName($table_name, $id_value, $other_column, $id_column);
  }

  //Display the stock balance
  if (isset($_POST['display_stock_balance']) && $_POST['stock_type'] != "" && $_POST['id_column'] != "") {
  $stock_type = Input::get("stock_type");
  $id_column_name = Input::get("id_column");
  $id_column_value = Input::get("id_value");
  $stockGeneral = DB::getInstance()->calculateSum("SELECT * FROM stock_in WHERE Stock_Type='$stock_type' AND $id_column_name='$id_column_value'", "Quantity");
  $stockTaken = DB::getInstance()->calculateSum("SELECT * FROM stock_out WHERE Stock_Type='$stock_type' AND $id_column_name='$id_column_value'", "Quantity_Taken");
  echo $stockAvailable = ($stockGeneral - $stockTaken > 0) ? $stockGeneral - $stockTaken : 0;
  }



  ///TODO::::: POST
  if (isset($_POST['calculate_maximum']) && $_POST['column_name'] != "" && $_POST['column_id'] != "" && $_POST['qty_ordered'] != "" && $_POST['row_id'] != "" && $_POST['user_id'] != "") {
  $column_name = Input::get("column_name");
  $column_id = Input::get("column_id");
  $quantity_ordered = Input::get("qty_ordered");
  $row_id = Input::get("row_id");
  $user_id = Input::get("user_id");
  $dish_type = 1;
  if ($column_name == "Dish_Id") {
  $dish_type = DB::getInstance()->getName("dish_served", $column_id, "Dish_Type", "Dish_Id");
  }
  if ($dish_type == 1) {
  $quantityAvailable = DB::getInstance()->calculateSum("SELECT * FROM stock_in WHERE $column_name ='$column_id'", "Quantity");
  $quantityTaken = DB::getInstance()->calculateSum("SELECT * FROM stock_out WHERE $column_name='$column_id'", "Quantity_Taken");

  $quantityAvailable = ($quantityAvailable - $quantityTaken >= 0) ? $quantityAvailable - $quantityTaken : 0;
  if ($quantity_ordered <= $quantityAvailable) {
  if (!DB::getInstance()->checkRows("SELECT * FROM temp_order WHERE User_Id = $user_id AND $column_name='$column_id'")) {
  DB::getInstance()->insert("temp_order", array(
  $column_name => $column_id,
  "Quantity_Ordered" => $quantity_ordered,
  "row_id" => $row_id,
  "User_Id" => $user_id
  ));
  $maximumLimit = $quantity_ordered . "/" . ($quantityAvailable - $quantity_ordered) . "/0";
  } else {
  $tmp_ordered = DB::getInstance()->calculateSum("SELECT * FROM temp_order WHERE $column_name='$column_id'", "Quantity_Ordered");
  ///echo $tmp_ordered;
  if (DB::getInstance()->checkRows("SELECT * FROM temp_order WHERE $column_name='$column_id' AND row_id='$row_id' AND User_Id = '$user_id' ")) {
  $temp = DB::getInstance()->displayTableColumnValue("SELECT * FROM temp_order WHERE $column_name='$column_id' AND row_id='$row_id' AND User_Id = '$user_id'", "Quantity_Ordered");
  $tmp_ordered -= $temp;
  if ($tmp_ordered + $quantity_ordered <= $quantityAvailable) {

  DB::getInstance()->query("UPDATE temp_order SET Quantity_Ordered=$quantity_ordered WHERE $column_name='$column_id' AND row_id='$row_id' AND User_Id='$user_id'");


  $maximumLimit = $quantity_ordered . "/" . ($quantityAvailable - ($tmp_ordered + $quantity_ordered)) . "/0";
  } else {
  $maximumLimit = ($quantityAvailable - $tmp_ordered) . "/" . ($quantityAvailable - $tmp_ordered) . "/1";
  }
  } else {
  if ($quantity_ordered + $tmp_ordered <= $quantityAvailable) {
  DB::getInstance()->insert("temp_order", array(
  $column_name => $column_id,
  "Quantity_Ordered" => $quantity_ordered,
  "row_id" => $row_id,
  "User_Id" => $user_id
  ));
  $maximumLimit = $quantity_ordered . "/" . ($quantityAvailable - ($quantity_ordered + $tmp_ordered)) . "/0";
  } else {
  $maximumLimit = ($quantityAvailable - $tmp_ordered) . "/" . ($quantityAvailable - $tmp_ordered) . "/1";
  }
  }
  }
  } else {

  $maximumLimit = $quantityAvailable . "/" . $quantityAvailable . "/1";
  }
  } else {
  $maximumLimit = $quantity_ordered . "/" . ($quantity_ordered + 100) . "/0";
  }

  echo $maximumLimit;
  }

  if (isset($_POST['display_bill_name_modal']) && $_POST['bill_id'] != "") {
  $bill_id = Input::get("bill_id");
  $sqlQuery = "SELECT * FROM customer_booking,person,room,room_occupancy WHERE person.Person_Id=customer_booking.Person_Id AND room_occupancy.Booking_Id=customer_booking.Booking_Id AND room_occupancy.Room_Id=room.Room_Id AND customer_booking.Booking_Id='$bill_id' LIMIT 1";
  $bill_list = DB::getInstance()->query($sqlQuery);
  foreach ($bill_list->results() as $bills) {
  echo $bills->Sur_Name . " " . $bills->Last_Name . "/" . $bills->Room_Number;
  }
  }

  if (isset($_POST['payment_method']) && $_POST['waiter'] != "" && $_POST['subTotal'] != "" && $_POST['total'] != "" && $_POST['register_bill_order'] == "register_bill_order") {
  $bill_id = Input::get("bill_id");
  $waiter = Input::get("waiter");
  $order_type = Input::get("order_type");
  $payment_method = Input::get("payment_method");

  $subTotal = Input::get("subTotal");
  $total = Input::get("total");
  $discount = Input::get("discounts");
  $no_pax = Input::get("no_pax");
  $room_no = Input::get("room_no");
  $table_no = Input::get("table_no");
  $order_status = 0;
  $user_id = Input::get("user_id");
  $bill_id = ($bill_id == "") ? NULL : $bill_id;
  $column = "cash";
  if ($payment_method == 1) {
  $column = "cash";
  } else {
  $column = "credit";
  }

  DB::getInstance()->insert("order_tb", array(
  "Booking_Id" => $bill_id,
  $column => $total,
  "discounts" => $discount,
  "subTotal" => $subTotal,
  "total_charges" => $total,
  "waiter_name" => $waiter,
  "order_type" => $order_type,
  "User_id" => $user_id,
  "table_no" => $table_no,
  "no_pax" => $no_pax,
  "order_status" => $order_status,
  "method" => $payment_method
  ));


  $sqlQuery1 = "DELETE FROM temp_order WHERE User_Id = '" . $user_id . "'";
  DB::getInstance()->query($sqlQuery1);


  $sqlQuery = "SELECT * FROM order_tb ORDER BY order_id DESC LIMIT 1";
  $bill_list = DB::getInstance()->query($sqlQuery);
  foreach ($bill_list->results() as $bills) {
  echo $bills->order_id;
  }
  }* */
?>

