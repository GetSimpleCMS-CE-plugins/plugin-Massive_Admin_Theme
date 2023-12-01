<style>
    .makefile {
        width: 100%;
        padding: 10px;
        background: #fafafa;
        border: solid 1px #ddd;
        margin-bottom: 10px;
    }

    .main>form:nth-child(2) select {
        padding: 10px;
        width: 100% !important;
    }

    .main>form:nth-child(2) #theme_files {
        width: 100% !important;
    }

    #themefiles {
        width: 100%;
    }

    select {
        background: #fff;
        border-radius: 5px;
        border: solid 1px #ddd;
    }



    @media(min-width:968px) {



        .main>form:nth-child(2) input.submit {
            margin-left: -19px;
        }

        .themeSelector p {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }



        .makefile input {
            border-radius: 5px;
            border: solid 1px #ddd;
        }

        .makefile input:not(input[type="submit"]) {
            padding: 5px;

        }

        .makefile {
            display: grid;
            grid-template-columns: 1fr 200px;
            gap: 10px;
        }



        .themeSelector p {
            width: 100% !important;
        }

        .themeSelector p select {
            width: 100% !important;
        }
    }


    .main>form:nth-child(2) {
        width: 100%;
        padding: 10px;
        background: #fafafa;
        border: solid 1px #ddd;
        margin-bottom: 10px;

    }


    .main>form>p {
        padding: 0;
        margin: 0;
    }


    @media(max-width:996px) {

        input,
        select {
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            box-sizing: border-box;
        }



        .main>form:nth-child(2) input.submit {
            margin-left: 0;
        }

    }
</style>
<div class="makefile">

    <input type="hidden" name="themefolder" class="themefolder">
    <input type="text" name="filename">
    <input type="submit" name="makefile" class="submit" value="Make File">
</div>


<script>
    document.querySelector('.main>form:nth-child(2)').classList.add('themeSelector');


    document.querySelector('.themefolder').value = document.querySelector('#theme-folder').value;
</script>


<?php if (isset($_POST['makefile'])) {


    file_put_contents(GSTHEMESPATH . $_POST['themefolder'] . '/' . $_POST['filename'], '');
    echo '<div class="updated"><p>' . $_POST['filename'] . ' created!</p></div>';
    echo ("<meta http-equiv='refresh' content='2'>");
}; ?>