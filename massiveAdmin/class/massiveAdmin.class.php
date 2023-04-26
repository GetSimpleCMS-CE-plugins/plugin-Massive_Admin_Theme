<?php

class MassiveAdminClass
{

    /* massive Options */

    public function deleteFileList()
    {
        $list = $_POST['delFileList'];
        $ar = explode(",", $list);
        foreach ($ar as $key => $value) {
            unlink(GSDATAUPLOADPATH . $value);
            echo ("<meta http-equiv='refresh' content='1'>");
        };
    }

    public function copyRename()
    {

        $fileIsHere = i18n_r("massiveAdmin/INFOERROR");

        $oldDirMassive = '../data/uploads/' . $_POST['rename-massive-hide'];
        $newDirMassive = '../data/uploads/' . $_POST['rename-massive'];

        $afterNewDir = preg_replace('/\s+/', '-', $newDirMassive);

        if (file_exists($afterNewDir) == 'true') {
            echo '<div class="massive-error">' . $fileIsHere . '</div>';
        } else {
            copy($oldDirMassive, $afterNewDir);
            echo ("<meta http-equiv='refresh' content='1'>");
            echo '<div class="massive-done">' . i18n_r("massiveAdmin/INFOCOPY") . $afterNewDir . '</div>';
        }
    }

    public function saveRename()
    {
        $oldDirMassive = '../data/uploads/' . $_POST['rename-massive-hide'];
        $newDirMassive = '../data/uploads/' . $_POST['rename-massive'];

        $afterNewDir = preg_replace('/\s+/', '-', $newDirMassive);

        rename($oldDirMassive, $afterNewDir);
        echo '<div class="massive-done">' . i18n_r("massiveAdmin/FILENOW") . $afterNewDir . '</div>';

        echo ("<meta http-equiv='refresh' content='1'>");
    }


    /*massive uploader */

    public function massiveUpload()
    {
        echo ' <li style="margin: 0 0 3px 0;" class="masive-uploader">
			<h3>' . i18n_r("massiveAdmin/UPLOADFILE") . '</h3>
			<form action="#" class="dropzone"></form>
			</li>';

        $DropFiles = i18n_r('massiveAdmin/DROPFILES');
        echo '<script> const dropFilesName = "' . $DropFiles . '"</script>';
        echo "<script>document.addEventListener('DOMContentLoaded', function(){document.querySelector('.dz-button').innerHTML = dropFilesName});</script>";

        $ds   = DIRECTORY_SEPARATOR;


        if (!empty($_FILES)) {
            $tempFile = $_FILES['file']['tmp_name'];
            $targetPath = GSDATAUPLOADPATH;
            $nameFile = preg_replace('/[^0-9a-z-]+/', '', pathinfo($_FILES['file']['name'])['filename']) . '.' . pathinfo($_FILES['file']['name'])['extension'];
            $targetFile =  $targetPath . $nameFile;

            if (file_exists($targetFile)) {
                $targetFile =  $targetPath . rand(0, 3432423) . $nameFile;
            };

            move_uploaded_file($tempFile, $targetFile);
        };
    }


    /*composite on page */


    public function compositeOnPage()
    {
        echo '<li><a href="components.php" class="compmassive">' . i18n_r("massiveAdmin/EDITCOMPONENTS") . '</a> </li>';
    }

    /*massive option file */

    public function massiveFile()
    {
        global $SITEURL;
        global $massiveOptionFileContent;
        $newmassiveOptionFile = json_decode($massiveOptionFileContent);
        if ($newmassiveOptionFile->gridfront == "yes") {
            register_style('massivegrid', $SITEURL . 'plugins/massiveAdmin/css/bootstrap-grid.min.css', '2.0', 'screen');
            queue_style('massivegrid', GSFRONT);
        };

        if ($newmassiveOptionFile->grid == "no") {
            register_style('hideUpCke', $SITEURL . 'plugins/massiveAdmin/css/hideUpCke.css', '2.0', 'screen');
            queue_style('hideUpCke', GSBACK);
        };
    }

    /*massive header and icon */

    public function massiveHead()
    {
        echo '<link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.8/css/unicons.css">';
        echo ' <meta name="viewport" content="width=device-width, initial-scale=1.0">';
        $massiveOptionFile = GSDATAOTHERPATH . '/massiveadmin/massiveOption.json';
        $massiveOptionFileContent = @file_get_contents($massiveOptionFile);
        $newmassiveOptionFile = json_decode($massiveOptionFileContent);
    }


    /* codeMirror edit */

    public function codeMirror()
    {
        echo '<script>if(document.querySelector(".CodeMirror")!==null){document.querySelector(".CodeMirror textarea").filter="invert(20%)"}</script>';
    }


    /** HELPINFO - DESK**/


    public function saveHelpInfo()
    {

        $folder        = GSDATAOTHERPATH . '/massiveHelpDesk/';
        $filename      = $folder . 'helpdesk.json';
        $chmod_mode    = 0755;


        $checkbox = $_POST['checkbox'];
        if ($checkbox == 'true') {
            $checkboxer = "true";
        } else {
            $checkboxer = "false";
        }
        $helper = $_POST['helper'];
        $helpers =  json_encode($helper,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
        $json = '{
            "content": ' . $helpers . ',
            "checkbox":  "' . $checkboxer . '" 
        }';

        $folder_exists = file_exists($folder) || mkdir($folder, $chmod_mode);

        // Save the file (assuming that the folder indeed exists)
        if ($folder_exists) {
            file_put_contents($filename, $json);
        };

        echo ("<meta http-equiv='refresh' content='0'>");
    }


    /*massiveOption Save Option */


    public function saveMassiveOption()
    {
        // Set up the data
        $grid = $_POST["grid"];
        $gridfront = $_POST["gridfront"];
        $maintence = $_POST["maintence"];
        $mcontent = $_POST["content"];
        $mcontentNew =  json_encode($mcontent,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);

        // Set up the folder name and its permissions
        // Note the constant GSDATAOTHERPATH, which points to /path/to/getsimple/data/other/
        $folder        = GSDATAOTHERPATH . '/massiveadmin/';
        $filename      = $folder . 'massiveOption.json';
        $chmod_mode    = 0755;
        $folder_exists = file_exists($folder) || mkdir($folder, $chmod_mode);

        $json = '{

		"maintence" : "' . $maintence . '",
		"maintencecontent" : ' . $mcontentNew . ',
		"grid" : "' . $grid . '",
		"gridfront" : "' . $gridfront . '"
	}';


        // Save the file (assuming that the folder indeed exists)
        if ($folder_exists) {
            file_put_contents($filename, $json);
        };


        echo "<script>const Another = '" . i18n_r('massiveAdmin/ANOTHERPAGE') . "'</script>";
        echo "<script>document.querySelector('.massiveoption').innerHTML = '<span>'+Another+'</span>' </script>";

        echo ("<meta http-equiv='refresh' content='0'>");

        /* hideAdminSection */
    }


    public function saveCreateUser()
    {
        $newposUser = $_POST['createuserhidden'];

        $newposUserwithspace = str_replace(' ', '-', $newposUser);
        $supportUserMailMonkey = str_replace('@', '', $newposUserwithspace);
        $supportUserMailFinal = str_replace('.', '', $supportUserMailMonkey);
        $createUserEmail = $_POST['createuseremail'];
        $pass = $_POST['createpassword'];
        $lang = $_POST['lang'];
        $passhash = passhash($pass);
        $folder = '../data/users';
        $newUserFile = $folder . '/' . $supportUserMailFinal . '.xml';
        $userinfo = '<?xml version="1.0" encoding="UTF-8"?>
<item><USR>' . strtolower($newposUser) . '</USR><NAME/><PWD>' . $passhash . '</PWD><EMAIL>' . $createUserEmail . '</EMAIL><HTMLEDITOR>1</HTMLEDITOR><TIMEZONE/><LANG>' . $lang . '</LANG></item>';
        file_put_contents($newUserFile, $userinfo);

        echo ("<meta http-equiv='refresh' content='0'>");
    }


    public function userList()
    {
        $files = glob(GSUSERSPATH . "*.xml");

        foreach ($files as &$value) {

            $oldDir = ["../data/users/", ".xml"];
            $newDir = ['', ''];
            $newValue = str_replace($oldDir, $newDir, $value);

            $username = new SimpleXMLElement(file_get_contents($value));

            $usrfile = $username->USR[0];


            echo '<li> <span class="name">' . $usrfile . '</span><form action="" method="POST"><button type="submit" name="' . $newValue . '" class="delete-this" style="background:red;color:#fff;border:none;font-size:1.1rem;border-radius:3px"><i class="uil uil-trash-alt"></i></button></form> </li>';


            if (isset($_POST[$newValue])) {
                unlink($value);
                echo ("<meta http-equiv='refresh' content='0'>");
            };
        };
    }


    public function submitHideAdminSection()
    {
        $hidefiles = $_POST['hidefiles'];
        $hidebackup = $_POST['hidebackup'];
        $hidethemes = $_POST['hidethemes'];
        $hideplugin = $_POST['hideplugin'];
        $hidei18n = $_POST['hidei18n'];
        $hidepages = $_POST['hidepages'];
        $hideuser = $_POST['hideuser'];
        $hidesupport = $_POST['hidesupport'];
        $hidesettings = $_POST['hidesettings'];



        $json = '{
                "hidefiles": "' . $hidefiles . '",
                "hidebackup": "' . $hidebackup . '",
                "hidethemes": "' . $hidethemes . '",
                "hidei18n": "' . $hidei18n . '",
                "hideplugin":"' . $hideplugin . '",
                "hidepages": "' . $hidepages . '",
                "hideuser": "' . $hideuser . '",
                "hidesupport": "' . $hidesupport . '",
                "hidesettings": "' . $hidesettings . '"
                
                }';


        $massiveHiddenSection = GSDATAOTHERPATH . '/massiveHiddenSection/';
        $filejson = 'userhidden.json';
        $finaljson = $massiveHiddenSection . $filejson;
        $chmod_mode    = 0755;
        $folder_exists = file_exists($massiveHiddenSection) || mkdir($massiveHiddenSection, $chmod_mode);
        file_put_contents($finaljson, $json);
        echo ("<meta http-equiv='refresh' content='0'>");
    }



    /*menu ext */

    public function createLinkMenuExt()
    {

        $folder        = GSDATAOTHERPATH . 'massiveMenuExt/';
        $filename      = $folder . 'menuext.json';
        $chmod_mode    = 0755;
        $folder_exists = file_exists($folder) || mkdir($folder, $chmod_mode);
        $daterJson = @file_get_contents($filename);
        $daterJsonNew = json_encode($daterJson);

        if ($folder_exists) {
            $datee = @file_get_contents($filename);
            $data = json_decode($datee, true);
            $data[$_POST['linkname']] = array();
            $data[$_POST['linkname']]['name'] = $_POST['linkname'];
            $data[$_POST['linkname']]['url'] = $_POST['linkurl'];
            $data[$_POST['linkname']]['icon'] = $_POST['linkicon'];
            $data[$_POST['linkname']]['linkblank'] = $_POST['linkblank'];
            $datee = json_encode($data, true);

            file_put_contents($filename, $datee);
            echo ("<meta http-equiv='refresh' content='0'>");
        };
    }



    /*migrate & SSL */


    public function migrateMassive()
    {

        foreach (glob(GSDATAPATH . '{,*/,*/*/,*/*/*/}*.xml', GLOB_BRACE) as $file) {

            $old = $_POST['oldMassiveUrl'];
            $replace = $_POST['newMassiveUrl'];
            $content = file_get_contents($file);
            $new = str_replace($old, $replace, $content);
            file_put_contents($file, $new);
        }
    }

    public function forceSSL()
    {

        $file = GSDATAOTHERPATH . 'MassiveForceSSL/';
        $status = $file . 'status.txt';

        if (file_exists($file)) {
            file_put_contents($file . 'status.txt', $_POST['turnon'] ?? '');
        } else {
            mkdir($file, 0755);
            file_put_contents($file . 'status.txt', $_POST['turnon'] ?? '');
        }

        //code for htaccess //

        if (file_get_contents($status) == 'on') {
            global $https;
            $htaccess = file_get_contents(GSROOTPATH . '.htaccess');
            $htaccess .= "
            # MassiveAdmin HTACCESS 
            RewriteEngine On 
    RewriteCond %{HTTPS} off 
    RewriteRule .* https://%{HTTP_HOST}%{REQUEST_URI} 
            ";
            file_put_contents(GSROOTPATH . '.htaccess', $htaccess);
        } else {
            $htaccess = file_get_contents(GSROOTPATH . '.htaccess');
            $withoutHTTPS =  str_replace("
            # MassiveAdmin HTACCESS 
            RewriteEngine On 
    RewriteCond %{HTTPS} off 
    RewriteRule .* https://%{HTTP_HOST}%{REQUEST_URI} 
            ", '', $htaccess);
            file_put_contents(GSROOTPATH . '.htaccess', $withoutHTTPS);
        }
    }


    // showPassword option 

    public function showPassword()
    {

        $file = GSDATAOTHERPATH . 'MassiveShowPassword/';
        $status = $file . 'status.txt';

        if (file_exists($file)) {
            file_put_contents($file . 'status.txt', $_POST['showPassword'] ?? '');
        } else {
            mkdir($file, 0755);
            file_put_contents($file . 'status.txt', $_POST['showPassword'] ?? '');
        }
    }


    //remove forget password

    public function removeForgetPassword()
    {

        $file = GSDATAOTHERPATH . 'MassiveShowForgetPassword/';
        $status = $file . 'status.txt';

        if (file_exists($file)) {
            file_put_contents($file . 'status.txt', $_POST['removeForgetPassword'] ?? '');
        } else {
            mkdir($file, 0755);
            file_put_contents($file . 'status.txt', $_POST['removeForgetPassword'] ?? '');
        }
    }



    //show button password front


    public function showIndexOption()
    {

        $file = @file_get_contents(GSDATAOTHERPATH . 'MassiveShowPassword/status.txt');
        $file2 = @file_get_contents(GSDATAOTHERPATH . 'MassiveShowForgetPassword/status.txt');


        if ($file == 'on') {
            echo '
        <script>

        window.addEventListener("load", (event) => {
            document.querySelector(".submit").insertAdjacentHTML("afterend",`<button class="button" style="margin-left:5px;padding:7px;" onclick="event.preventDefault();showPass()"><i class="uil uil-key-skeleton-alt"></i> Show Password</button>`);
        });

        function showPass(){

            if(document.querySelector("#pwd").getAttribute("type")== "password"){
                document.querySelector("#pwd").setAttribute("type","text");
            }else{
                document.querySelector("#pwd").setAttribute("type","password");
            }

        };

        </script>
        ';
        };


        if ($file2 == 'on') {
            echo '
        <script>
        window.addEventListener("load", (event) => {

            document.querySelector("#index .cta").remove(); 
      
        });
        </script>
        ';
        };
    }


    //download plugin 


    public function downloadPlugin()
    {


        $url = $_POST['url'];

        file_put_contents(GSPLUGINPATH . "Tmpfile.zip", fopen("$url", 'r'));
        $path = GSPLUGINPATH . "Tmpfile.zip";

        $zip = new ZipArchive;
        if ($zip->open($path) === TRUE) {
            if (file_exists(GSPLUGINPATH . "tmp_plugin/") == false) {
                mkdir(GSPLUGINPATH . "tmp_plugin/", 0755);
            };
            $zip->extractTo(GSPLUGINPATH  . "tmp_plugin/");
            $zip->close();

            foreach (glob(GSPLUGINPATH  . "tmp_plugin/*/*") as $filename) {
                if (file_exists(str_replace(pathinfo($filename)['dirname'], GSPLUGINPATH, $filename)) !== true) {
                    rename($filename, str_replace(pathinfo($filename)['dirname'], GSPLUGINPATH, $filename));
                };
            };



            function delete_directory($dirname)
            {
                if (is_dir($dirname))
                    $dir_handle = opendir($dirname);
                if (!$dir_handle)
                    return false;
                while ($file = readdir($dir_handle)) {
                    if ($file != "." && $file != "..") {
                        if (!is_dir($dirname . "/" . $file))
                            unlink($dirname . "/" . $file);
                        else
                            delete_directory($dirname . '/' . $file);
                    }
                }
                closedir($dir_handle);
                rmdir($dirname);
                return true;
            };

            delete_directory(GSPLUGINPATH . "tmp_plugin");

            unlink($path);
        };


        echo '<div class="success" style="position:absolute;top:0;left:0;">Installed!</div>';
        echo ("<meta http-equiv='refresh' content='1'>");
    }


    //snippet save

    public function snippetSave()
    {
        $title = $_POST['snippetTitle'];
        $content = $_POST['content'];
        $fileFolder = GSDATAOTHERPATH . 'snippetMassive/';
        $myXML = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><snippets/>');


        if ($title !== null) {
            foreach ($title as $key => $value) {
                if (file_exists($fileFolder)) {
                    $snippet = $myXML->addChild($value);
                    $snippet->addChild('title', $value);
                    $snippet->addChild('content', htmlentities(htmlentities($content[$key])));
                    $myXML->asXML($fileFolder . 'snippet.xml');
                } else {
                    mkdir($fileFolder, 0755);
                    $snippet = $myXML->addChild($value);
                    $snippet->addChild('title', $value);
                    $snippet->addChild('content', htmlentities(htmlentities($content[$key])));
                    $myXML->asXML($fileFolder . 'snippet.xml');
                };
            }
        } else {
            unlink($fileFolder . 'snippet.xml');
        }
    }


    //codemirror components

    public function ComponentsCodeMirror()
    {



        echo '
		<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/codemirror.min.js" integrity="sha512-8RnEqURPUc5aqFEN04aQEiPlSAdE0jlFS/9iGgUyNtwFnSKCXhmB6ZTNl7LnDtDWKabJIASzXrzD0K+LYexU9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/codemirror.min.css" integrity="sha512-uf06llspW44/LZpHzHT6qBOIVODjWtv4MxCricRxkzvopAlSWnTf6hpZTFxuuZcuNE9CBQhqE0Seu1CoRk84nQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/theme/rubyblue.min.css" integrity="sha512-pt+OhZW7o2pmHEahNFroPWkGR89L0tmDqCzXK+7WM1vGLtUyxms1JxZsXgJbOdFwylRnEt0yHnU6y2uAs40FxQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/php/php.min.js" integrity="sha512-jZGz5n9AVTuQGhKTL0QzOm6bxxIQjaSbins+vD3OIdI7mtnmYE6h/L+UBGIp/SssLggbkxRzp9XkQNA4AyjFBw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/css/css.min.js" integrity="sha512-rQImvJlBa8MV1Tl1SXR5zD2bWfmgCEIzTieFegGg89AAt7j/NBEe50M5CqYQJnRwtkjKMmuYgHBqtD1Ubbk5ww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/javascript/javascript.min.js" integrity="sha512-I6CdJdruzGtvDyvdO4YsiAq+pkWf2efgd1ZUSK2FnM/u2VuRASPC7GowWQrWyjxCZn6CT89s3ddGI+be0Ak9Fg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/xml/xml.min.js" integrity="sha512-LarNmzVokUmcA7aUDtqZ6oTS+YXmUKzpGdm8DxC46A6AHu+PQiYCUlwEGWidjVYMo/QXZMFMIadZtrkfApYp/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/htmlmixed/htmlmixed.min.js" integrity="sha512-HN6cn6mIWeFJFwRN9yetDAMSh+AK9myHF1X9GlSlKmThaat65342Yw8wL7ITuaJnPioG0SYG09gy0qd5+s777w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/clike/clike.min.js" integrity="sha512-l8ZIWnQ3XHPRG3MQ8+hT1OffRSTrFwrph1j1oc1Fzc9UKVGef5XN9fdO0vm3nW0PRgQ9LJgck6ciG59m69rvfg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<style type="text/css">

.CodeMirror {
        font-size: 15px;
        width: 100%, ;
        height: 200px;
    }
</style>


<script>
window.addEventListener("load",()=>{

    if(document.querySelector("#components")){

        document.querySelectorAll(".compdiv textarea").forEach(x=>{
            var editor = CodeMirror.fromTextArea(x, {
                theme: "rubyblue",
                lineNumbers: true,
                matchBrackets: true,
                indentUnit: 4,
                indentWithTabs: true,
                enterMode: "keep",
                tabMode: "shift",
                mode:"htmlmixed"
            });
            
            });

    }


})


</script>

';
    }


    //gsconfig edit

    public function gsConfigEdit()
    {
        file_put_contents(GSROOTPATH . 'gsconfig.php', $_POST['content']);
    }
};