<?php
    /*
    Script for update record from X-editable.
    */

    //delay (for debug only)
    sleep(1); 

    /*
    You will get 'pk', 'name' and 'value' in $_POST array.
    */
    $data = array();
    if(isset($_POST['pk']) && !empty($_POST['pk']))
        $data['pk'] = $_POST['pk'];
    if(isset($_POST['name']) && !empty($_POST['name']))
        $data['name'] = $_POST['name'];
    if(isset($_POST['value']) && !empty($_POST['value']))
        $data['value'] = $_POST['value'];

    /*
     Check submitted value
    */
    if(count($data) >= 3) {
        /*
          If value is correct you process it (for example, save to db).
          In case of success your script should not return anything, standard HTTP response '200 OK' is enough.
          
          for example:
          $result = mysql_query('update users set '.mysql_escape_string($name).'="'.mysql_escape_string($value).'" where user_id = "'.mysql_escape_string($pk).'"');
        */
        
        //here, for debug reason we just return dump of $_POST, you will see result in browser console
        echo json_encode(array('status'=>'success', 'data'=> $data));


    } else {
        /* 
        In case of incorrect value or error you should return HTTP status != 200. 
        Response body will be shown as error message in editable form.
        */

        header('HTTP 400 Bad Request', true, 400);
        echo json_encode(array('status'=>'error', 'errors'=> "This field is required!"));
    }

?>