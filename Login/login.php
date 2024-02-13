<form class="pt-3"  action="login2.php" method="post">
<div class="form-group">
  <input type="text" class="form-control form-control-lg" id="Email" placeholder="Email or Username" name="email_or_username">
</div>
                <div>
                  <input type="password"id="exampleInputPassword1" placeholder="Password" name="psw">
                </div>
                <div class="mt-3">
                  <input type="submit"  value="Login" />
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="forgot_password.php" class="auth-link text-black">Forgot password?</a>

                </div>
               
                <div class="text-center mt-4 fw-light">
                  Don't have an account? <a href="..\Register\Registration.php" class="text-primary">Create</a>
                </div>
              </form>