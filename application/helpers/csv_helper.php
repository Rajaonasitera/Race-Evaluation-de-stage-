<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    function lireCsv(){
        try {
            $csv_file = $_FILES['csv']['tmp_name'];
            $error_messages = array();
            if (($handle = fopen($file_path, "r")) !== FALSE) {
                $data_to_insert = array();
                $row_count = 0;
                while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $row_count++;
                    if ($row_count == 1) {
                        continue;
                    }
                    if (count($row) == 2) {
                        $data_to_insert[] = array(
                            'libelle' => $row[0],
                            'prix' => $row[1]
                        );
                    } else {
                        $error_messages[] = "Le nombre de colonnes est incorrect dans la ligne $row_count.";
                    }
                }
            }
        } catch (\Error $th) {
            // throw $th;
            var_dump($th);
        }
        
    }
?>