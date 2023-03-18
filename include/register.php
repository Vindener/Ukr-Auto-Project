
  <?php
  if (isset($_POST['button_registr_from_enter'])) {
    echo ' <script>
        $("#Registr").modal("show");
  </script>';
  }
  ?>
<!-- Registr -->
<div class="modal fade" id="Registr" href="#Registr">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-head-title">
                    <h4 class="modal-title">Регістрація</h4>
                </div>

                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div>
                    <?php
                    if (isset($_POST['button_registr'])) {
                        $error = 0;

                        $result = mysqli_query($connect, "SELECT * FROM user");
                        $row = mysqli_fetch_array($result);

                        do {
                            if ($_POST["email"] == $row['email']) {
                                if ($error == 0) {
                                    echo "<div class=\"red\">";
                                }
                                echo "Такий email - вже зарігістровано!<br> ";
                                $error = $error + 1;
                            }
                        } while ($row = mysqli_fetch_array($result));
                        if (empty($_POST["name"])) {
                            if ($error == 0) {
                                echo "<div class=\"red\">";
                            }
                            echo "Не введено ім'я!<br> ";
                            $error = $error + 1;
                        }
                        if (empty($_POST["name"])) {
                            if ($error == 0) {
                                echo "<div class=\"red\">";
                            }
                            echo "Не введено ім'я!<br> ";
                            $error = $error + 1;
                        }

                        if (empty($_POST["middlename"])) {
                            if ($error == 0) {
                                echo "<div class=\"red\">";
                            }
                            echo "Не введено по батькові!<br> ";
                            $error = $error + 1;
                        }

                        if (empty($_POST["lastname"])) {
                            if ($error == 0) {
                                echo "<div class=\"red\">";
                            }
                            echo "Не введено прізвище!<br> ";
                            $error = $error + 1;
                        }

                        if (empty($_POST["email"])) {
                            if ($error == 0) {
                                echo "<div class=\"red\">";
                            }
                            echo "Не введено електрону пошту!<br> ";
                            $error = $error + 1;
                        }

                        if (empty($_POST["pass"])) {
                            if ($error == 0) {
                                echo "<div class=\"red\">";
                            }
                            echo "Не введено пароль!<br> ";
                            $error = $error + 1;
                        }

                        if (empty($_POST["telefon"])) {
                            if ($error == 0) {
                                echo "<div class=\"red\">";
                            }
                            echo "Не введено телефон!<br> ";
                            $error = $error + 1;
                        }
                        if ($error > 0) {
                            echo "</div>";
                            echo '
                            <script>
                            $("#Registr").modal("show");
                            </script>';
                        }

                        if ($error == 0) {
                            //Додавання запису в базу даних
                            $password = md5($_POST['pass'] . "cargr2gh");
                            mysqli_query($connect, "INSERT INTO `user` (`id_user`, `name`, `lastname`, `middlename`, `telefon`, `email`, `password`, `id_access`) 
        VALUES (NULL, '" . $_POST["name"] . "', '" . $_POST["lastname"] . "', '" . $_POST["middlename"] . "','" . $_POST["telefon"] . "','" . $_POST["email"] . "','$password','1')");

                            //Вхід після регістрації
                            $login = $_POST["email"];

                            $result = mysqli_query($connect, "SELECT * FROM `user` WHERE `email`='$login' AND `password`='$password'");


                            $row = mysqli_fetch_array($result);

                            $_SESSION['name']  = $row['name'];
                            $_SESSION['id']  = $row['id_user'];

                            if ($row["id_access"] == 2) {
                                $_SESSION['auth_user']  = 'user';
                                header("Location: ../users/user_panel.php");
                            }
                            if ($row["id_access"] == 1) {
                                $_SESSION['auth_user']  = 'admin';
                                header("Location: ./admin/admin_panel.php");
                            }

                            echo "<meta http-equiv='refresh' content='0'>";
                        }
                    }
                    ?>
                    <form action="" method="post" class="container-login">
                        <label for="name"><b>Ім'я</b></label>
                        <input type="text" placeholder="Ім'я" name="name" />
                        <label for="middlename"><b>По батькові</b></label>
                        <input type="text" placeholder="По батькові" name="middlename" />
                        <label for="lastname"><b>Прізвище</b></label>
                        <input type="text" placeholder="Прізвище" name="lastname" />

                        <label for="email"><b>Електронна пошта</b></label>
                        <input type="text" placeholder="Електронна пошта" name="email" />

                        <label for="telefon"><b>Телефон</b></label>
                        <input type="text" placeholder="Телефон" name="telefon" />

                        <label for="pass"><b>Пароль</b></label>
                        <input type="password" placeholder="Пароль" name="pass" />
                        <hr />

                        <button type="submit" class="btn btn-danger button_registr" id="button_registr" name="button_registr">
                            Регістрація
                        </button>
                    </form>

                    <div class="container signin">
                        <p>Вже маєте обліковий запис <a href="#" data-toggle="modal" data-target="#login" id="enter_from_registr">Увійти в акаунт</a>.</p>
                    </div>
                </div>

            </div>

            <!-- Modal footer -->
            <!-- <div class="modal-footer">
          
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div> -->
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