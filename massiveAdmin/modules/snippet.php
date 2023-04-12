<h3 class="floated"><?php echo i18n_r('massiveAdmin/EDITSNIPPET'); ?></h3>
<div class="edit-nav">
    <a href="#" onclick="event.preventDefault();addNewSnippet();" id="addsnippet" accesskey="a"><?php echo i18n_r('massiveAdmin/ADDSNIPPET'); ?></a>
    <div class="clear"></div>
</div>


<form action="#" method="post">

    <div class="snippet-list">


        <?php

        $file = GSDATAOTHERPATH . 'snippetMassive/snippet.xml';

        if (file_exists($file)) {
            $readed = simplexml_load_file($file);
        };

        ?>


        <?php

        if (file_exists($file)) {

            $fileFolder = GSDATAOTHERPATH . 'snippetMassive/';
            foreach ($readed as $file) {

                $title = $file->title;
                $content = $file->content;

                echo '<div style="display:block;position:relative;width:100%;border:solid 1px #ddd;margin-top:15px; background:#fafafa;padding:10px; box-sizing:border-box;padding-top:30px;">
            <p style="position:absolute;top:5px;left:10px; color:#333;font-size:12px;">&#60;?php get_snippet("' . $title . '");?></p>
            <button style="position:absolute;top:5px;right:10px;background:red;color:#fff;border:none;" onclick="event.preventDefault();closeThisSnippet(this)">X</button>
            <input type="text" required  pattern="[a-zA-Z0-9]+" style="width:100%;padding:10px; margin-bottom:10px;" placeholder="' . i18n_r('massiveAdmin/TITLESNIPPET') . '" value="' .  $title . '" name="snippetTitle[]">
            <textarea name="content[]" class="snippet-content" id="post-content" style="width:100%;">' . $content . '</textarea>
            </div>
        ';
            };
        };

        ?>


        <div style="width:100%;margin-top:20px;" class="submit-show">
            <input type="submit" class="submit" name="snippetSave" id="button" value="<?php echo i18n_r('massiveAdmin/SUBMITSNIPPET');?>">
        </div>



    </div>
</form>

<script type="text/javascript" src="template/js/ckeditor/ckeditor.js?t=3.3.18.1"></script>

<script>
    function addNewSnippet() {


        document.querySelector('.snippet-list').insertAdjacentHTML('afterBegin', `

   

    <div style="display:block;position:relative;width:100%;border:solid 1px #ddd;margin-top:15px; background:#fafafa;padding:10px; box-sizing:border-box;padding-top:30px;">
    <button style="position:absolute;top:5px;right:10px;background:red;color:#fff;border:none;" onclick="event.preventDefault();closeThisSnippet(this)">X</button>
    <input type="text" required  pattern="[a-zA-Z0-9]+" style="width:100%;padding:10px; margin-bottom:10px;" placeholder="<?php echo i18n_r('massiveAdmin/TITLESNIPPET');?>"  name="snippetTitle[]">

    <textarea name="content[]" id="post-content" style="width:100%;"></textarea>
</div>
    
    `);


        let editor = CKEDITOR.replace('post-content', {
            skin: 'getsimple',
            forcePasteAsPlainText: true,
            entities: false,
            // uiColor : '#FFFFFF',
            height: '200px',
            tabSpaces: 10,
            filebrowserBrowseUrl: 'filebrowser.php?type=all',
            filebrowserImageBrowseUrl: 'filebrowser.php?type=images',
            filebrowserWindowWidth: '730',
            filebrowserWindowHeight: '500',
            toolbar: 'advanced'
        });

    }




    document.querySelectorAll('.snippet-content').forEach(x => {

        let editor = CKEDITOR.replace(x, {
            skin: 'getsimple',
            forcePasteAsPlainText: true,

            entities: false,
            // uiColor : '#FFFFFF',
            height: '200px',
            tabSpaces: 10,
            filebrowserBrowseUrl: 'filebrowser.php?type=all',
            filebrowserImageBrowseUrl: 'filebrowser.php?type=images',
            filebrowserWindowWidth: '730',
            filebrowserWindowHeight: '500',
            toolbar: 'advanced'
        });


    })

    function closeThisSnippet(x) {

        x.parentElement.remove();

    };
</script>


<?php if (isset($_POST['snippetSave'])) {

    global $MA;
    $MA->snippetSave();

    echo ("<meta http-equiv='refresh' content='0'>");
};
?>