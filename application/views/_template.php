<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Project Tool</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?=base_url()?>public/assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?=base_url()?>public/assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?=base_url()?>public/assets/sticky.min.css" rel="stylesheet">


    <script src="<?=base_url()?>public/assets/js/jquery.js"></script>
    <script src="<?=base_url()?>public/assets/sticky.min.js"></script>
    <style type="text/css">
        body {
            padding-top: 40px;
            padding-bottom: 40px;
        }

    </style>
    <script>
        var base_url = "<?=site_url()?>";
        //alert(base_url);
    </script>
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body>

<div class="container-fluid">

    <?=$this->load->view($content)?>
</div>


<script src="<?=base_url()?>public/assets/js/bootstrap-transition.js"></script>
<script src="<?=base_url()?>public/assets/js/bootstrap-alert.js"></script>
<script src="<?=base_url()?>public/assets/js/bootstrap-modal.js"></script>
<script src="<?=base_url()?>public/assets/js/bootstrap-dropdown.js"></script>
<script src="<?=base_url()?>public/assets/js/bootstrap-tab.js"></script>


</body>
</html>
