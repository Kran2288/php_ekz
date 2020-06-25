<?php
$name = $_GET['name_expert'];
$desc = $_GET['desc_expert'];
$questions = $_GET['questions'];
if($name && $desc){
    require("../db.php");
    require("../hash.php");
    $new_expert_session = db_request("INSERT INTO expert_session SET name='".$name."', description='".$desc."', link='". generateLink() ."'");
    $id_new_expert_session = mysqli_insert_id($db);

    foreach ($questions as $question){
        $question_text = $question['text'];
        $new_question = db_request("INSERT INTO questions SET id_expert_session='".$id_new_expert_session."', text='".$question_text."'");
        $id_new_question = mysqli_insert_id($db);
        foreach ($question['answer'] as $answer){
            if($answer['correct'] == 'on'){
                $correct = 1;
            }else{
                $correct = 0;
            }
            $answer_text = $answer['text'];
            $new_question = db_request("INSERT INTO answer SET id_question='".$id_new_question."', text='".$answer_text."', correct=".$correct);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-text mx-3">Админ-панель</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="index.php">
                <i class="far fa-list-alt"></i>
                <span>Экспертные сессии</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="index.html">
                <i class="fas fa-sign-out-alt"></i>
                <span>Выход</span></a>
        </li>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Введите номер экспертной сессии" aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Создание экспертной сессии</h1>
                    <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-plus fa-sm text-white-50"></i> Создать экспертную сессию
                    </button>
                </div>
                <form action="new_expert.php" method="get">
                    <div class="form-group">
                        <label for="nameExpert">Название</label>
                        <input type="text" class="form-control" name="name_expert" id="nameExpert" placeholder="Введите название экспертной сессии">
                    </div>
                    <div class="form-group">
                        <label for="descExpert">Описание экспертной сессии</label>
                        <textarea class="form-control" name="desc_expert" id="descExpert" rows="3" placeholder="Введите описание экспертной сессии"></textarea>
                    </div>
                    <label>Вопросы</label>
                    <div class="questions">
                    </div>
                    <div class="add-question">
                        <span>Добавить вопрос</span>
                    </div>
                    <button>тест</button>
                </form>
            </div>
        </div>
        <!-- End of Main Content -->
        <pre>
            <?var_dump($_GET['questions'][0]);?>
        </pre>
        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2020</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>
<script src="js/new_expert.js"></script>

</body>

</html>
