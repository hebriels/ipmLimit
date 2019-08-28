<!--<h3>Login admin</h3>
<form action="/admin/login" method="post">
    <p>Login</p>
    <input type="text" name="login">
    <p>Password</p>
    <input type="text" name="pass">
    <input type="submit" name="submit">
</form>
<a href="/">На главную</a>-->

<!-- BEGIN LOGO -->
<div class="logo">
    <a href="/">
        <img src="/public/images/logos/<?php echo $imageLogo;?>" style="height: 40px;" alt="" /> </a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form action="/admin/login" method="post">
        <div class="form-title">
            <span class="form-title">Добро пожаловать!</span>
        </div>
        <div class="form-group">
            <input class="form-control form-control-solid placeholder-no-fix" type="text" placeholder="Имя пользователя" name="login" /> </div>
        <div class="form-group">
            <input class="form-control form-control-solid placeholder-no-fix" type="password" placeholder="Пароль" name="pass" /> </div>
        <div>
            <button type="submit" class="btn red btn-block uppercase">Войти</button>
        </div>
    </form>
</div>-->