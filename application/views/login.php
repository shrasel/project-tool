<style type="text/css">

    .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
        -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
        box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
    }

    .form-signin .form-signin-heading,
    .form-signin .checkbox {
        margin-bottom: 10px;
    }

    .form-signin input[type="text"],
    .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
    }

</style>
<form class="form-signin" name="login" action="" method="post">
    <?php if($this->session->flashdata('msg')):?>
    <div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button><?=$this->session->flashdata('msg')?></div>
    <?php endif; ?>

    <h2 class="form-signin-heading">Please sign in</h2>
    <input type="text" name="email" class="input-block-level" placeholder="Email address">
    <input type="password" name="password" class="input-block-level" placeholder="Password">
    <!--<label class="checkbox">
        <input type="checkbox" value="remember-me"> Remember me
    </label>-->
    <button class="btn btn-large btn-primary" type="submit">Sign in</button>
</form>