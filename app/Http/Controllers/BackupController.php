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
    public function backupDB () {


            $tables = [
                'artists',
                'albums',
                'songs',
                'playlists',
                'playlists_songs'
            ];



            foreach ($tables as $table) {
                $filename = public_path('/backups/' . $table . '.csv');
                $handle = fopen($filename, 'w');
                $select_query = "SELECT * FROM " . $table;
                $records = DB::select(DB::raw($select_query));
                // $columns = (array)$columns;
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

            return back()->with('success', 'Downloaded Successfully');
        }

        public function uploadDB () {

            $tables = [
                'artists',
                'albums',
                'songs',
                'playlists',
                'playlists_songs'
            ];
            DB::statement("SET foreign_key_checks=0");
            foreach ($tables as $table) {
                DB::table($table)->truncate();
                $file = fopen(public_path('/backups/' . $table . '.csv'),"r");

                $importData_arr = array();
                $i = 0;

                while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                    $num = count($filedata );

                    // Skip first row (Remove below comment if you want to skip the first row)
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

                 // Insert to MySQL database
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
            DB::statement("SET foreign_key_checks=1");

            return back()->with('success', 'Uploaded Successfully');
        }

        public function cleanDB () {

            $tables = [
                'artists',
                'albums',
                'songs',
                'playlists',
                'playlists_songs'
            ];

            DB::statement("SET foreign_key_checks=0");
            foreach ($tables as $table) {
                DB::table($table)->truncate();
            }
            DB::statement("SET foreign_key_checks=1");

            File::cleanDirectory(public_path('uploads/img'));
            File::cleanDirectory(public_path('uploads/songs'));

            return back()->with('success', 'Everything Cleared Successfully');
        }

        public function userGuide() {

            //PDF file is stored under project/public/download/info.pdf
            $file = public_path('User_Guide_Media_Organiser.docx');

            $headers = array(
              'Content-Type: application/docx',
            );

        return response()->download($file, 'User_Guide.docx', $headers);
        }

}
