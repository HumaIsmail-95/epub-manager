<?php 

require_once "../config/init.php";

if($_POST){
    //Validation 
    $validated = false;
    $request = [
        [
            'name'  => 'title',
            'value' => $_POST['title'],
            'rules' => 'required'
        ],      
    ];

    $errors = Validator::doValidate($request);
    if(count($errors) == 0){
        $validated = true;
    }

    

    //Insert to DB
    if($validated){
        $status = new Status();
     
        $user_data = $_POST;
 
        $check = $status->insert($user_data);
        if($check){
            Session::flash('success',"Status added successfully");
        }
        else{
            Session::flash('errors',"Error while Adding Status.");
        }
    }else{
        // Redirect back with errors
         Session::flash('errors',$errors);
    }
    
    header("Location: ../views/manage-status.php");
    

}

