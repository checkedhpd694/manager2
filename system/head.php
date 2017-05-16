<?php
$name = 'AutoFB.Mobi';
$title = 'Auto Request - Auto Like - Auto Follow - Auto Sub';
$color = '#'.rand(0,9).rand(0,9).rand(0,9);
$version = '1.0';
?>
<!DOCTYPE html>
<html xmlns='https://www.w3.org/1999/xhtml' lang='vi' prefix='og:https://ogp.me/ns# fb: https://ogp.me/ns/fb#'>
  <head>
    <meta charset='utf-8'>
    <title>
      <?= $name ?> Version <?= $version ?> - <?= $title ?>
    </title>
    <meta name='description' content='<?= $name ?> - <?= $title ?>'>
    <meta name='keywords' content='<?= $name ?> - <?= $title ?>'>
    <meta name='copyright' content='<?= $name ?>'>
    <meta name='robots' content='index, follow'>
    <meta name='googlebot' content='index, follow'>
    <meta name='YandexBot' content='index, follow'>
    <meta name='google-site-verification' content='wpADGy2bjBNtbkh-tlgN_xzKKn5njWRduxwvsX2ZbbA'>
    <!-- Og -->
    <meta property='og:url' content='/img/logo.png'>
    <meta property='og:type' content='website'>
    <meta property='og:title' content='<?= $name ?> - <?= $title ?>'>
    <meta property='og:description' content='<?= $name ?> - <?= $title ?>'>
    <meta property='og:locale' content='vi_VN'>
    <meta property='og:image' content='/img/logo.png'>
    <!-- Twitter -->
    <meta name='twitter:card' content='<?= $name ?>'>
    <meta name='twitter:site' content='<?= $name ?>'>
    <meta name='twitter:title' content='<?= $name ?> - <?= $title ?>'>
    <meta name='twitter:description' content='<?= $name ?> - <?= $title ?>'>
    <!-- Other -->
    <meta http-equiv='content-language' content='en'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href='/img/favicon.ico' rel='shortcut icon' type='image/x-icon'>
    <meta name='revisit-after' content='1 days'>
    <meta name='author' content='Nguyễn Hữu Thiện'>
    <!-- CSS & JS -->
    <link rel='stylesheet' href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
    <link rel='stylesheet' href='//fontawesome.io/assets/font-awesome/css/font-awesome.css'>
    <style>
      .thongbao {
      	background-color: #000
      }
      .thongbao {
      	text-shadow: 1px 1px 2px rgba(17, 86, 26, 0.5);
      	background-color: <?=$color ?>;
      	border-color: <?=$color ?>;
      	color: #fff;
      	padding: 10px;
      	border: 1px solid transparent;
      	border-radius: 4px;
      	margin-bottom: 5px
      }
      .panel-primary>.panel-heading,
      .btn-danger {
      	background-color: <?=$color ?>!important
      }
      .panel-primary>.panel-heading,
      .panel-primary,
      .btn-danger {
      	border-color: <?=$color ?>!important
      }
      .btn-danger:hover,
      .btn-danger:focus,
      .btn-danger.active {
      	background: <?=$color ?>!important
      }
      .btn-danger:hover,
      .btn-danger:focus,
      .btn-danger.active {
      	border-color: <?=$color ?>!important
      }
      .form-control:focus {
      	border-bottom: 2px solid <?=$color ?>;
      	border-top: 0;
      	border-right: 0;
      	border-left: 0
      }
      .navbar {
      	background: #000
      }
      .navbar {
      	background: <?=$color ?>
      }
      .navbar-brand {
      	color: #f22!important
      }
      .nav > li > a {
      	color: #fff!important
      }
      .nav > li > a:focus {
      	color: #f22!important
      }
    </style>
  </head>
  <body>
    <script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
    <div class='container'>
      <div class='row'>
        <div class='col-lg-8 col-lg-offset-2'>
          <nav class='navbar navbar-default'>
            <div class='container-fluid'>
              <div class='navbar-header'>
                <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar' aria-expanded='false' aria-controls='navbar'>
                  <span class='sr-only'>Toggle navigation
                  </span>
                  <span class='icon-bar'>
                  </span>
                  <span class='icon-bar'>
                  </span>
                  <span class='icon-bar'>
                  </span>
                </button>
                <a class='navbar-brand' href='/'>
                  <i class='fa fa-star-o'></i> <?= $name ?> 
                  <span style='display:inline-block;vertical-align:middle;font-size:10px;margin-top:-15px'>150+
                  </span>
                </a>
              </div>
              <div id='navbar' class='navbar-collapse collapse'>
                <ul class='nav navbar-nav'>
                </ul>
                <ul class='nav navbar-nav navbar-right'>
                  <li>
                    <a href='https://www.facebook.com/coideptrai.info' target='_blank'><i class="fa fa-paper-plane-o"></i> Contact
                    </a>
                  </li>
				  <li>
                    <a href='/api' target='_blank'><i class='fa fa-comments-o'></i> Phòng chát
                    </a>
                  </li>

                  <li>
                    <a href='/vip/vip.php' target='_blank'><i class='fa fa-thumbs-o-up'></i> Vip Like
                    </a>
                  </li>
                  <li class='dropdown'>
                    <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><i class='fa fa-link'></i> Text Link 
                      <span class='caret'>
                      </span>
                    </a>
                    <ul class='dropdown-menu'>
                      <li>
                        <a href='//Buffsub.net' target='_blank'>Buffsub.net
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
        </div>