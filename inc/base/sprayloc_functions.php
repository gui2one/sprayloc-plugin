<?php


// echo $_SERVER['DOCUMENT_ROOT']."\n";
require_once($_SERVER['DOCUMENT_ROOT'] . "/wp-load.php");
if( isset($_POST["action"])){
    switch($_POST["action"]){
        case 'add_equipment' :

            compareData();
            echo 'action is Add Equipment : ';
            
            
            echo $_POST["value"];
            break;
    }
}else{
    echo 'action not set';
}

function add_equipment($object){
    var_dump($object);
}

function compareData(){

    // echo "CompareData Function\n";
    $sprayloc_plugin_admin_options = get_option( 'sprayloc_plugin_admin_option_name' ); // Array of All Options
    $json_data_0 = $sprayloc_plugin_admin_options['json_data_0']; // json data		
    $json_data_rentman = $sprayloc_plugin_admin_options['json_data_rentman']; // json data	
    
    $saved_array = json_decode($json_data_0);
    $saved_ids = array();
    foreach($saved_array as $key => $value){

        array_push($saved_ids, $value->{'id'});
    }

    // var_dump($saved_ids);


    $online_array = json_decode($json_data_rentman);
    // var_dump($online_array);
    $online_ids = array();
    foreach($online_array as $key => $value){

        array_push($online_ids, $value->{'id'});
    }
    // var_dump($online_ids);

    $to_delete = [];
    foreach($saved_ids as $id){

        if(!in_array($id, $online_ids)){
            array_push($to_delete, $id);
        }
    }

    // var_dump($to_delete);

    $to_add = [];
    foreach($online_ids as $id){

        if(!in_array($id, $saved_ids)){
            array_push($to_add, $id);
        }
    }

    // var_dump($to_add);
    if(count($to_add) > 0){
    
        addEquipment(getEquipmentById($online_array,$to_add[0]));
        // var_dump(getEquipmentById($online_array,$to_add[0]));
    }
        

}

function getEquipmentById($data, $id){

    foreach($data as $key => $value){
        if( $value->{'id'} == $id){
            return $value;
        }
    }
    return null;
}

function addEquipment($object){
    $settings = get_option( "sprayloc_plugin_admin_option_name" );
    $json_data = json_decode($settings["json_data_0"]);

    array_push($json_data, $object);

    $settings["json_data_0"] = json_encode($json_data);
    update_option( "sprayloc_plugin_admin_option_name", $settings , true);
}


