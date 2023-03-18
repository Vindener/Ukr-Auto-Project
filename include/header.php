<?php
session_start();
include("db_connect.php"); //Підключення до бази даних

if (isset($_POST['submit_input'])) {
    $login = $_POST["uname"];
    $pass = md5($_POST['pass'] . "cargr2gh");

    $result = mysqli_query($connect, "SELECT * FROM `user` WHERE `email`='$login' AND `password`='$pass'");

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        $_SESSION['name']  = $row['name'];
        $_SESSION['id']  = $row['id_user'];

        if ($row["id_access"] == 2) {
            $_SESSION['auth_user']  = 'user';
            header("Location: ../user/user_panel.php");
        }
        if ($row["id_access"] == 1) {
            $_SESSION['auth_user']  = 'admin';
            header("Location: ../admin/admin_panel.php");
        }
    } else {
        echo '<script>alert("Ви допустили помилку при введені даних!");</script>';
    }
}
if (isset($_POST['button_registr'])) {
    header("Location: ../register.php");
}
?>



<!-- Login -->
<div class="modal fade" id="login" href="#login">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-head-title">
                    <h4 class="modal-title">Вхід</h4>
                </div>

                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="POST">
                    <div class="container-login">
                        <label for="uname"><b>Логін</b></label>
                        <input type="text" placeholder="" name="uname" />

                        <label for="psw"><b>Пароль</b></label>
                        <input type="password" placeholder="" name="pass" />
                        <button name="submit_input" type="submit" class="btn btn-danger button_login">
                            Увійти
                        </button>
                        <button type="submit" name="button_registr" class="btn btn-danger button_login button_registr" id="button_registr">
                            Регістрація
                        </button>
                    </div>
                </form>
            </div>

            <!-- Modal footer -->
            <!-- <div class="modal-footer">
          
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div> -->
        </div>
    </div>
</div>


    <div class="modal fade" id="login" href="#login">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <div class="modal-head-title">
                        <h4 class="modal-title">Вхід</h4>
                    </div>

                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form method="POST">
                        <div class="container-login">
                            <label for="uname"><b>Логін</b></label>
                            <input type="text" placeholder="" name="uname" required />

                            <label for="psw"><b>Пароль</b></label>
                            <input type="password" placeholder="" name="pass" required />
                            <button name="submit_input" type="submit" class="btn btn-danger button_login">
                                Увійти
                            </button>
                            <button type="submit" class="btn btn-danger button_login button_registr" id="button_registr">
                                Регістрація
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <!-- <div class="modal-footer">
          
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div> -->
            </div>
        </div>
    </div>
</div>


<!-- Exit Moadl  -->
<?php
if (isset($_POST['button_exit_account'])) {
    session_destroy();
    echo "<meta http-equiv='refresh' content='0'>";
}

?>
<div class="modal fade" id="exit" href="#exit">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-head-title">
                    <h4 class="modal-title">Вихід</h4>
                </div>

                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <div class="container-exit">
                    <label><b>Ви впевненні що хочете вийти з аккаунта?</b></label>
                    <div class="container-exit-button">
                        <form method="POST">
                            <button name="button_exit_account" type="submit" class="btn btn-danger" id="button_exit_account">
                                Так
                            </button>
                        </form>
                        <button type="submit" class="btn btn-danger " data-dismiss="modal">
                            Ні
                        </button>
                    </div>
                </div>

            </div>

            <!-- Modal footer -->
            <!-- <div class="modal-footer">
          
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div> -->
        </div>
    </div>
</div>