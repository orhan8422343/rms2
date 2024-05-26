<?php

namespace App\Http\Controllers;

use App\Models\BasicExtended;
use Illuminate\Support\Facades\Schema;
use App\Models\Language;
use App\Models\Package;
use App\Models\User;
use App\Models\User\BasicSetting;
use App\Models\User\Language as UserLanguage;
use App\Models\User\UserPermission;
use App\Models\User\UserShopSetting;
use App\Models\User\UserVcard;
use Illuminate\Http\Request;
use Artisan;
use DB;

class UpdateController extends Controller
{
    public function version()
    {
        return view('updater.version');
    }

    public function recurse_copy($src, $dst)
    {

        $dir = opendir(base_path($src));
        @mkdir(base_path($dst));
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir(base_path($src) . '/' . $file)) {
                    $this->recurse_copy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy(base_path($src) . '/' . $file, base_path($dst) . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    public function upversion(Request $request)
    {
      

        $assets = array(
            ['path' => 'public/assets/admin/js', 'type' => 'folder', 'action' => 'replace'],
            ['path' => 'public/assets/admin/css', 'type' => 'folder', 'action' => 'replace'],
            ['path' => 'public/assets/admin/fonts', 'type' => 'folder', 'action' => 'replace'],
            ['path' => 'public/assets/admin/img/themes', 'type' => 'folder', 'action' => 'add'],

            ['path' => 'public/assets/front/css', 'type' => 'folder', 'action' => 'replace'],
            ['path' => 'public/assets/front/js', 'type' => 'folder', 'action' => 'replace'],
            ['path' => 'public/assets/front/fonts', 'type' => 'folder', 'action' => 'replace'],

            ['path' => 'public/assets/front/bakery', 'type' => 'folder', 'action' => 'replace'],
            ['path' => 'public/assets/front/beverage', 'type' => 'folder', 'action' => 'replace'],
            ['path' => 'public/assets/front/coffee', 'type' => 'folder', 'action' => 'replace'],
            ['path' => 'public/assets/front/grocery', 'type' => 'folder', 'action' => 'replace'],
            ['path' => 'public/assets/front/medicine', 'type' => 'folder', 'action' => 'replace'],
            ['path' => 'public/assets/front/multipurpose', 'type' => 'folder', 'action' => 'replace'],
            ['path' => 'public/assets/front/pizza', 'type' => 'folder', 'action' => 'replace'],
            ['path' => 'public/assets/front/plugin_css', 'type' => 'folder', 'action' => 'replace'],

            ['path' => 'config', 'type' => 'folder', 'action' => 'replace'],
            ['path' => 'database/migrations', 'type' => 'folder', 'action' => 'add'],
            ['path' => 'resources/views', 'type' => 'folder', 'action' => 'replace'],
            ['path' => 'routes/web.php', 'type' => 'file', 'action' => 'replace'],
            ['path' => 'app', 'type' => 'folder', 'action' => 'replace'],
            ['path' => 'composer.json', 'type' => 'file', 'action' => 'replace'],
            ['path' => 'composer.lock', 'type' => 'file', 'action' => 'replace'],

            ['path' => 'version.json', 'type' => 'file', 'action' => 'replace']
        );

        foreach ($assets as $key => $asset) {
            // if updater need to replace files / folder (with/without content)
            if ($asset['action'] == 'replace') {
                if ($asset['type'] == 'file') {
                    copy(base_path('public/updater/' . $asset["path"]), base_path($asset["path"]));
                }
                if ($asset['type'] == 'folder') {
                    $this->delete_directory($asset["path"]);
                    $this->recurse_copy('public/updater/' . $asset["path"], $asset["path"]);
                }
            }
            // if updater need to add files / folder (with/without content)
            elseif ($asset['action'] == 'add') {
                if ($asset['type'] == 'folder') {
                    // @mkdir($asset["path"] . '/', 0775, true);
                    $this->recurse_copy('public/updater/' . $asset["path"], $asset["path"]);
                }
            }
        }




        $this->updateLanguage();

        Artisan::call('config:clear');
        // run migration files
        Artisan::call('migrate');
        
        @unlink(base_path('.htaccess'));
        @copy(base_path('public/updater/htaccess/.htaccess'), base_path('.htaccess'));


        \Session::flash('success', 'Updated successfully');
        return redirect('updater/success.php');
    }

    function delete_directory($dirname)
    {
       $dir_handle = null;
        if (is_dir($dirname))
            $dir_handle = opendir($dirname);
            
        if (!$dir_handle)
            return false;
        while ($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirname . "/" . $file))
                    unlink($dirname . "/" . $file);
                else
                    $this->delete_directory($dirname . '/' . $file);
            }
        }
        closedir($dir_handle);
        rmdir($dirname);
        return true;
    }

    public function updateLanguage()
    {
        $langCodes = [];
        $languages = Language::all();
        foreach ($languages as $key => $language) {
            $langCodes[] = $language->code;
        }
        $langCodes[] = 'default';

        foreach ($langCodes as $key => $langCode) {
            // read language json file
            $data = file_get_contents(base_path('resources/lang/') . $langCode . '.json');

            // decode default json
            $json_arr = json_decode($data, true);


            // new keys
            $newKeywordsJson = file_get_contents(base_path('public/updater/language.json'));
            $newKeywords = json_decode($newKeywordsJson, true);
            foreach ($newKeywords as $key => $newKeyword) {
                // # code...
                if (!array_key_exists($key, $json_arr)) {
                    $json_arr[$key] = $key;
                }
            }

            // push the new key-value pairs in language json files
            file_put_contents(base_path('resources/lang/') . $langCode . '.json', json_encode($json_arr));
        }
    }


    public function redirectToWebsite(Request $request) {
        $arr = ['WEBSITE_HOST' => $request->website_host];
        setEnvironmentValue($arr);
        \Artisan::call('config:clear');

        return redirect()->route('front.index');
    }
}
