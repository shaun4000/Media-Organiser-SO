<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class BackupController extends Controller
{
    // Downloads the database tables to csv files
    public function backupDB () {

            // Set the table names into an array
            $tables = [
                'artists',
                'albums',
                'songs',
                'playlists',
                'playlists_songs'
            ];


            // Write over the current csv files with the data from the tables
            foreach ($tables as $table) {
                $filename = public_path('/backups/' . $table . '.csv');
                $handle = fopen($filename, 'w');
                $select_query = "SELECT * FROM " . $table;
                $records = DB::select(DB::raw($select_query));

                if (!empty($records)) {
                    fputcsv($handle, array_keys(json_decode(json_encode($records[0]), true)));
                }

                foreach ($records as $record) {
                    $record = (array)$record;
                    $table_value_array = array_values($record);
                    fputcsv($handle, $table_value_array);
                }

                fclose($handle);

                $headers = array(
                    'Content-Type' => 'text/csv',
                );
            }

            // Return a success message
            return back()->with('success', 'Downloaded Successfully');
        }

        // Uploads the csv files to the database tables
        public function uploadDB () {

            // Set the table names into an array
            $tables = [
                'artists',
                'albums',
                'songs',
                'playlists',
                'playlists_songs'
            ];

            // Uncheck the foreign key checks in the database
            DB::statement("SET foreign_key_checks=0");

            // Get the data from each csv file and upload the data into the relevant database tables
            foreach ($tables as $table) {
                DB::table($table)->truncate();
                $file = fopen(public_path('/backups/' . $table . '.csv'),"r");
                $importData_arr = array();
                $i = 0;

                while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                    $num = count($filedata );
                    if($i == 0){
                       $i++;
                       continue;
                    }
                    for ($c=0; $c < $num; $c++) {
                       $importData_arr[$i][] = $filedata [$c];
                    }
                    $i++;
                 }
                 fclose($file);

                 // Insert to each database table
                foreach($importData_arr as $importData){

                    if ($table == 'artists') {
                        $insertData = array(
                            "id"=>$importData[0],
                            "artist_name"=>$importData[1],
                            "description"=>$importData[2]);
                    } elseif ($table == 'albums') {
                        $insertData = array(
                            "id"=>$importData[0],
                            "artists_id"=>$importData[1],
                            "album_name"=>$importData[2],
                            "category"=>$importData[3],
                            "img"=>$importData[4]);
                    } elseif ($table == 'songs') {
                        $insertData = array(
                            "id"=>$importData[0],
                            "albums_id"=>$importData[1],
                            "song_name"=>$importData[2],
                            "file_name"=>$importData[3],
                            "file_type"=>$importData[4],
                            "file_size"=>$importData[5],
                            "file_location"=>$importData[6],
                            "comment"=>$importData[7]);
                    } elseif ($table == 'playlists') {
                        $insertData = array(
                            "id"=>$importData[0],
                            "playlist_name"=>$importData[1]);
                    } elseif ($table == 'playlists_songs') {
                        $insertData = array(
                            "id"=>$importData[0],
                            "playlists_id"=>$importData[1],
                            "songs_id"=>$importData[2]);
                    }

                    DB::table($table)->insert($insertData);

                }
            }

            // Uncheck the foreign key checks in the database
            DB::statement("SET foreign_key_checks=1");

            // Return a success message
            return back()->with('success', 'Uploaded Successfully');
        }

        public function cleanDB () {

            // Set the table names into an array
            $tables = [
                'artists',
                'albums',
                'songs',
                'playlists',
                'playlists_songs'
            ];

            // Uncheck the foreign key checks in the database
            DB::statement("SET foreign_key_checks=0");

            // Clear the data in each table
            foreach ($tables as $table) {
                DB::table($table)->truncate();
            }

            // Uncheck the foreign key checks in the database
            DB::statement("SET foreign_key_checks=1");

            // Clear all images from the public folder
            File::cleanDirectory(public_path('uploads/img'));

            // Clear all songs from the public folder
            File::cleanDirectory(public_path('uploads/songs'));

            // Return a success message
            return back()->with('success', 'Everything Cleared Successfully');
        }

        public function userGuide() {

            // Find the file loaction of the User Guide
            $file = public_path('User_Guide_Media_Organiser.docx');

            // Set the content headers
            $headers = array(
              'Content-Type: application/docx',
            );

            // Download the User Guide straight from the view
            return response()->download($file, 'User_Guide.docx', $headers);
        }

}
