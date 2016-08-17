<?php

function insert_categories(){
	if(isset($_POST['submit'])){
		global $connection;

        $cat_title=$_POST['cat_title'];

        //check whether the input is empty
        if($cat_title == "" || empty($cat_title)){
            echo "This field should not be empty.";
        }else{
            //insert into categories
            $query="INSERT INTO categories(cat_title) VALUES('$cat_title')";
            //insert
            $create_category=mysqli_query($connection,$query);

            //error checking when insertion failed
			if(!$create_category){
                die('Query failed'.mysqli_error($connection));
            }
        }
    }
}


function find_all_categories(){
    //find all categories and display in a table
    global $connection;

    $query="SELECT * FROM categories";
    $select_categories=mysqli_query($connection,$query);

    while($row=mysqli_fetch_assoc($select_categories)){
    $cat_id=$row['cat_id'];
    $cat_title=$row['cat_title'];
    echo "<tr>";
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";

    //Make query string to delete and edit specific element
    echo "<td><a href='category.php?delete={$cat_id}'>Delete</a></td>";
    echo "<td><a href='category.php?edit={$cat_id}'>Edit</a></td>";
    echo "</tr>";
    }
}


function delete_categories(){
	global $connection;
  	if(isset($_GET['delete'])){
    	//get id to be delete
    	$cat_id_to_delete=$_GET['delete'];
		$delete_query="DELETE FROM categories WHERE cat_id='$cat_id_to_delete'";

		//delete the result
    	$delete_result=mysqli_query($connection,$delete_query);

	    header("Location: category.php");	
    }
}

function confirm_query($query_result){
    global $connection;
    
    if(!$query_result){
        die("Query failed".mysqli_error($connection));
    }
}

?>
