<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ThingController extends Controller
{
    function addNewThing(Request $request){
        $path = 'excel.csv';
        $f = fopen($path, 'r');
        while (($line = fgetcsv($f)) !== FALSE) {
            $end_str = $line[0];
        }
        //echo $end_str;
        $id = ((int)$end_str) + 1;
        $rows = [
            [$id, $request->name, $request->amount]];
        $fp = fopen($path, 'a+'); 
        foreach ($rows as $row) {
            fputcsv($fp, $row);
        }
        fclose($fp);
    }

    function getAllThings(){
        $path = 'excel.csv';
        $file = fopen($path, 'r');
        $arr = array();
        while (($line = fgetcsv($file)) !== FALSE) {

            if (count($line) == 4){
                $line1 = $line[3];
                $line1 = explode(")", $line1);
                //var_dump($line1);
                $line[3] = array();
                foreach($line1 as $element){
                    if ($element != "owners"){
                        $del = explode(";", $element);
                        array_push($line[3], array("name" => $del[0], "date" => $del[1], "amount" => $del[2]));
                    } else {
                        array_push($line[3], "owners");
                    }
                    
                }
                array_push($arr, array("id" => $line[0], "name" => $line[1], "amount" => $line[2], "owner" => $line[3]));
            } else {
                array_push($arr, array("id" => $line[0], "name" => $line[1], "amount" => $line[2]));
            }
        }
        fclose($file);
        array_shift($arr);
        return json_encode($arr);
    }
    function addThingOwner(Request $request){
        echo $request->id;
        $path = 'excel.csv';
        $file = fopen($path, 'r');
        $arr = array();
        while (($line = fgetcsv($file)) !== FALSE) {
            if ($request->id == $line[0]){
                if (count($line) == 3){
                    //echo(count($line));
                    array_push($line, "$request->name;$request->date_from;$request->amount");
                    var_dump($line);
                } else {
                    $line[3] .= ")$request->name;$request->date_from;$request->amount";

                }
            }
            array_push($arr, $line);
        }
        fclose($file);

        $fp = fopen($path, 'w');

        foreach ($arr as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);
    }
}
