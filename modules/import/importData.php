<?php
include '../../db_connector/mysqli_conn.php';

if (isset($_POST['importSubmit'])) {

    //validate whether uploaded file is a csv file
    $csvMimes = array('application/vnd.ms-excel', 'text/plain', 'text/csv', 'text/tsv');
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)) {
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {

            //open uploaded csv file with read only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

            //skip first line
            fgetcsv($csvFile);

            //parse data from csv file line by line
            while (($line = fgetcsv($csvFile)) !== FALSE) {
                $prevQuery = "SELECT id FROM employee_details WHERE emp_id = '" . $line[0] . "' AND national_id = '" . $line[1] . "'";
                $prevResult = mysqli_query($dbcon, $prevQuery);
                if (mysqli_num_rows($prevResult) > 0) {
                    //update data
                    mysqli_query($dbcon, "UPDATE employee_details SET Surname = '" . $line[2] . "', Firstname = '" . $line[3] . "', Othername = '" . $line[4] . "', Position = '" . $line[5] . "', Department = '" . $line[6] . "', district = '" . $line[7] . "', facility = '" . $line[8] . "' WHERE emp_id = '" . $line[0] . "' AND national_id = '" . $line[1] . "'");
                } else {
                    //insert member data into database
                    mysqli_query($dbocn, "INSERT INTO employee_details (emp_id, national_id, Surname, Firstname, Othername, Contact, Position, Department, district, facility, flag) VALUES ('" . $line[0] . "','" . $line[1] . "','" . $line[2] . "','" . $line[3] . "','" . $line[4] . "','" . $line[4] . "','" . $line[5] . "','" . $line[6] . "','" . $line[7] . "','" . $line[8] . "','" . $line[9] . "','" . $line[10] . "','" . $line[11] . "')");
                }
            }

            //close opened csv file
            fclose($csvFile);

            $qstring = '?status=succ';
        } else {
            $qstring = '?status=err';
        }
    } else {
        $qstring = '?status=invalid_file';
    }
}

//redirect to the employee_details page
header("Location:../../dashboard.php?action=view_employee&" . $qstring);
