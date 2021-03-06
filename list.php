<?php
    session_start ();
    require __DIR__.'/models/model.php';
    require __DIR__.'/models/session.php';

    $bdd = initbdd();
    if(!isset($_SESSION['id']))
    {
        $stmt = $bdd->query('SELECT * FROM tache order by priority desc');
        //header('Location:register.php');
        //exit();
    }
    else{
        $stmt = $bdd->query('SELECT * FROM tache WHERE useridlink =' . $_SESSION['id'] . ' order by priority desc');
    }

   if (isset($_POST["submit"])) {
        $priority = prioritytonumber($_POST['priority']);
        $lbl = htmlspecialchars($_POST['lbl']);
        $descr = htmlspecialchars($_POST['descr']);
        $useridlink = $_SESSION['id'];
        AddElement($bdd, $priority, $lbl, $descr, $useridlink);
        header('Location:list.php');
   }
    if (isset($_POST["delete"])) {

        $delete = $_POST['delete'];
        $id = $_SESSION['id'];
        DeleteElement($bdd, $delete, $id);
        }

    if (isset($_POST["edit"]))
    {
        $edit = $_POST["edit"];
        header('Location:edit.php?id=' . $edit);
    }

    if (isset($_POST["detail"]))
    {
        $detail = $_POST["detail"];
        header('Location:detail.php?id=' . $detail);
    }
    require __DIR__.'/views/displaytache.php';
    require __DIR__ . '/views/list_view.php';
?>