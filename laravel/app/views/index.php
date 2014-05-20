<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/public/packages/twbs/bootstrap/docs-assets/ico/favicon.png">
    <title>Write an application in Laravel that displays a list of the last 100 emails from an inbox using IMAP.</title>

    <link href="/public/packages/twbs/bootstrap/dist/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/public/packages/twbs/bootstrap/examples/jumbotron/jumbotron.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="/packages/twbs/bootstrap/docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
    .PleaseHold{
        background-color: #000;
        height: 100%;
        left: 0;
        opacity: 0.50;
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 11100;
    }

    .pre {
        display: block;
        padding: 9.5px;
        margin: 0 0 10px;
        font-size: 13px;
        line-height: 1.42857143;
        word-break: break-all;
        word-wrap: break-word;
        color: #333;
        background-color: #f5f5f5;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    </style> 
    </head>
    <body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" 
             data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">IMAP navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"> IMAP </a>
        </div>
        <div class="navbar-collapse collapse">
          <form name="form"  method="POST" class="navbar-form navbar-right" role="form">
            <div class="form-group">
              <input name="username" type="text" placeholder="Username" class="form-control">
            </div>
            <div class="form-group">
              <input  name="password" type="password" placeholder="Password" class="form-control">
            </div>
            <div class="form-group">
                <select name='hostname' class="form-control">
                    <option value='{imap.gmail.com:993/imap/ssl}INBOX'>gmail.com</option>
                    <option value="{mail.ukraine.com.ua}">mail.ukraine.com.ua</option>
                </select>
            </div>
            <button id='OpenPleaseHold' type="submit" class="btn btn-success">Get</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </div>
    <div class='prosess'></div>
    <br />
    <div class="container">
      <!-- Example row of columns -->
      <div class="row"> 
        <?php $i=0; foreach ( $array as $key => $value ): ?>  
        <div class="  pre">
            <div class="bg-info">
                <p>    <span class="glyphicon glyphicon-envelope"></span>  Subject [<?php echo ++$i; ?>] <span class="text-warning">
                <?php            echo utf8_decode(imap_utf8( $value['imap_fetch_overview'][0]->subject) ) ?></span> </p>
                <p>To:     <?php echo utf8_decode(imap_utf8( $value['imap_fetch_overview'][0]->to     ) ) ?>        </p>
                <p>From:   <?php echo utf8_decode(imap_utf8( $value['imap_fetch_overview'][0]->from   ) ) ?>        </p>
                <p>Message: <span class="text-danger"> <?php echo  utf8_encode(quoted_printable_decode($value['imap_fetchbody']));   ?> </span></p>
            </div>
        </div>
        <?php endforeach;?> 
      </div>
      <hr /> 
    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="/public/packages/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
 <script>
    $('#OpenPleaseHold').click(function(e){ 
        var VarOpenDialogWindowClass = $('.prosess');     
        VarOpenDialogWindowClass.addClass( "PleaseHold" );
        VarOpenDialogWindowClass.html('<center><div style="padding-top: 100px;"> <span class="">  </span> <h1   style=" padding: 5px; height: 200px ; font-size:45px; "> Please wait.. </h1> </div> </center> ');
    });
 </script>
  </body>
</html>
