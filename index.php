<?php
session_start();
include('autoload.php');

Bootstrap::init($db, $err, $typehead);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Flashsms r0mdau</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap-responsive.min.css">
</head>
<body>
<div class="container">
    <div class="span3">
        <form method="post" class="form-horizontal">
            <fieldset>
                <legend>Envoyer</legend>
                <label>Numero</label>
                <input type="text" name="number" placeholder="+33 6 xx xx xx xx" autocomplete="off"
                       value="<?= (isset($_SESSION['user']) ? $_SESSION['user'] : '') ?>"
                       data-provide="typeahead"
                       data-items="4"
                       data-source='<?= $typehead['send'] ?>'>
                <br>
                <label>Message</label>
                <textarea rows="3"
                          name="message"><?= (isset($_SESSION['message']) ? $_SESSION['message'] : '') ?></textarea>
                <br>
                <label class="checkbox">
                    <input type="checkbox" name="flash" <?= (isset($_SESSION['flash']) ? 'checked="checked"' : '') ?>>
                    Flash
                </label>
                <br>
                <input class="btn" type="submit" value="Envoyer" data-loading-text="En cours d'envoi..."
                       onclick="$(this).button('loading');">
            </fieldset>
        </form>
        <?= info_sending($err) ?>
    </div>
    <div class="span3">
        <form method="post" class="form-horizontal">
            <fieldset>
                <legend>Annuaire</legend>
                <label>Prénom Nom</label>
                <input type="text" name="name" autocomplete="off"
                       data-provide="typeahead"
                       data-items="4"
                       data-source='<?= $typehead['directory'] ?>'>
                <label>Numero</label>
                <input type="text" name="number" placeholder="+33 6 xx xx xx xx">
                <br><br>
                <input class="btn btn-warning" type="submit" value="Enregistrer" data-loading-text="Enregistrement..."
                       onclick="$(this).button('loading');">
            </fieldset>
        </form>
        <?= info_directory($err) ?>
    </div>
    <div class="span3">
        <form method="post" class="form-horizontal">
            <fieldset>
                <legend>Listes de diffusion</legend>
                <label>Nom de la liste</label>
                <input type="text" name="list" autocomplete="off"
                       data-provide="typeahead"
                       data-items="4"
                       data-source='<?= $typehead['lists'] ?>'>
                <label>Numero / Nom personne</label>
                <input type="text" name="number1" autocomplete="off"
                       placeholder="+33 6 xx xx xx xx"
                       data-provide="typeahead"
                       data-items="4"
                       data-source='<?= $typehead['directory'] ?>'>
                <br><br>
                <input id="btnpos" class="btn btn-primary" type="submit" value="Enregistrer"
                       data-loading-text="Enregistrement..." onclick="$(this).button('loading');">
                <button id="btnlist" type="button" class="btn btn-inverse">+</button>
            </fieldset>
        </form>
        <?= info_list($err) ?>
    </div>
</div>
<div class="container">
    <div class="span9">
        <div id="messages" class="well well-small">
            <h3>Messages reçus</h3>
            <hr>
            <?= getMessages() ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="span9">
        <p class="pull-right">
            Flashsms by <a href="https://github.com/r0mdau" title="Github r0mdau" target="_blank">r0mdau</a>
        </p>
    </div>
</div>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>window.jQuery || document.write('<script src="lib/jquery/jquery-1.10.2.min.js"><\/script>')</script>
<script src="lib/bootstrap/js/bootstrap-alert.min.js"></script>
<script src="lib/bootstrap/js/bootstrap-button.min.js"></script>
<script src="lib/bootstrap/js/bootstrap-typeahead.min.js"></script>
<script>
    var numero = 1;
    $(document).ready(function () {
        $('#btnlist').click(function () {
            numero++;
            $('#btnpos').before(
                '<input type="text" name="number' + numero + '" autocomplete="off" ' +
                'placeholder="+33 6 xx xx xx xx" data-provide="typeahead" data-items="4" ' +
                'data-source="<?=$typehead['directory']?>"><br><br>'
            );
        });
        getMessages();
    });

    function getMessages() {
        var intervalID = setInterval(function () {
            $.ajax({
                url: "ajax/getMessages.php"
            }).done(function (data) {
                $('#messages').html('').append('<h3>Messages reçus</h3><hr>' + data);
            });
        }, 10000);
    }

    function deleteMessage(number) {
        $.ajax({
            url: "ajax/deleteMessage.php?number=" + number
        }).done(function (data) {
            $('#messages').after(data);
            getMessages();
        });
    }
</script>
</body>
</html>
