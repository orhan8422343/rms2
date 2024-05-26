<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\Process\Process;
use App\Models\Backup;
use Session;

class BackupController extends Controller
{
    public function index()
    {

        $data['backups'] = Backup::orderBy('id', 'DESC')->paginate(10);
        return view('admin.backup', $data);
    }

    public function store()
    {

        $host = env('DB_HOST');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $database = env('DB_DATABASE');
        $port = env('DB_PORT');

        $ts = time();

        $path = 'storage/app/public/';
        $file = date('Y-m-d-His', $ts) . '-dump-' . $database . '.sql';

        //$command = sprintf('C:\wamp64\bin\mysql\mysql5.7.36\bin\mysqldump.exe -h %s -u %s -p %s > %s', $host, $username, $database, $path . $file);
        // $command = sprintf('C:\wamp64\bin\mysql\mysql5.7.36\bin\mysqldump.exe --host=$s --user=%s --password=$s --port=$s  $s --result-file= > %s', $host, $username, $password,$port,$database, $path . $file);
        $command = sprintf('C:\wamp64t\bin\mysql\mysql8.2.0\bin\mysqldump.exe --host=%s --user=%s --password=%s --port=%s  %s --result-file=%s', $host, $username, $password, $port, $database, $path . $file);

        //dd($command);


        @mkdir($path, 0755, true);

        exec($command);

        $backup = new Backup;
        $backup->filename = $file;
        $backup->save();

        Session::flash('success', 'Backup saved successfully');
        return back();
    }

    public function download(Request $request)
    {
        return response()->download('storage/app/public/' . $request->filename, 'backup.sql');
    }

    public function delete($id)
    {
        $backup = Backup::find($id);
        @unlink('storage/app/public/' . $backup->filename);
        $backup->delete();

        Session::flash('success', 'Database sql file deleted successfully!');
        return back();
    }
}
