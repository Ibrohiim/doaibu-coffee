<div class="register-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <h2 class="m-0"><b>Welcome to</b></h2>
            <a href="<?= base_url('homepage'); ?>" class="h2"><b>Doa Ibu Coffee!</b></a>
        </div>
        <div class="card-body" style="padding-top: 10px;">
            <p class="login-box-msg">Register a new membership</p>
            <form action="<?= base_url('auth/register') ?>" method="post">
                <div class="form-group mb-2">
                    <div class="input-group">
                        <input class="form-control <?= form_error('name') ? 'is-invalid' : null; ?>" placeholder="Full name" type="text" id="name" name="name" value="<?= set_value('name'); ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <?= form_error('name', '<small class="text-danger m-r-10">', '</small>'); ?>
                </div>
                <div class="form-group mb-2">
                    <div class="input-group">
                        <input class="form-control <?= form_error('email') ? 'is-invalid' : null; ?>" placeholder="Email Address" type="text" id="email" name="email" value="<?= set_value('email'); ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <?= form_error('email', '<small class="text-danger m-r-10">', '</small>'); ?>
                    <p class="small">We'll never share your email with anyone else.</p>
                </div>
                <div class="form-group mb-2">
                    <div class="input-group">
                        <input class="form-control" placeholder="Password" type="password" id="password1" name="password1">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <div class="input-group">
                        <input class="form-control <?= form_error('password1') ? 'is-invalid' : null; ?>" placeholder="Repeat Password" type="password" id="password2" name="password2">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <?= form_error('password1', '<small class="text-danger m-r-10">', '</small>'); ?>
                </div>
                <div class="icheck-primary">
                    <input type="checkbox" id="agreeTerms" name="terms" checked>
                    <label for="agreeTerms">
                        I agree to the <a href="#">terms</a>
                    </label>
                </div>
                <div style="margin-top: 20px;">
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </div>
            </form>
            <a href="<?= base_url('auth') ?>" class="text-center">Already registered? Sign In</a>
        </div>
    </div>
</div>