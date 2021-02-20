<?php

$users_id = $_SESSION['id'];
$objQuery = "SELECT DISTINCT i.contribution_id,ac.study_activity_id,ac.study_activity_name,ac.study_start,ac.study_end FROM collab_invites i,study_objectives s, users_tb u, objective_users o, study_activity ac WHERE (( i.invites_id = o.invites_id AND i.users_id = u.users_id AND o.study_objectives_id = s.study_objectives_id AND o.invites_id = i.invites_id AND i.users_id = '$users_id' ) OR ( objective_lead = u.users_id AND objective_lead = '$users_id' )) AND i.contribution_id = s.contribution_id AND ac.study_objectives_id = s.study_objectives_id ";
$json = array();
$eventArray = array();
if (DB::getInstance()->checkRows($objQuery)) {
    $users_list = DB::getInstance()->query($objQuery);
    foreach ($users_list->results() as $users):
        $start = $users->study_start;
        $end = $users->study_end;
        $jsonArray = array(
            'title' => $users->study_activity_name,
            'start' => $start,
            'end' => $end,
            'url' => 'index?!=add_ctb&%='.$users->contribution_id.'|'.$users->study_activity_id.'|uewyiywuiynnncvbdyusdin jhsuisiuwiuwe9287217725265363'
        );
        array_push($eventArray, $jsonArray);
    endforeach;
    //echo json_encode($jsonArray);
}

echo json_encode($eventArray);
?>