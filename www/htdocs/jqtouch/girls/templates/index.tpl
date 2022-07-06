<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>jQtouch cheet UI</title>
        <meta name="apple-mobile-web-app-capable" content="yes" />  
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
        <link type="text/css" rel="stylesheet" media="screen" href="../jqtouch/jqtouch.css" />
        <link type="text/css" rel="stylesheet" media="screen" href="../themes/jqt/theme.css" />
        <link type="text/css" rel="stylesheet" media="screen" href="../css/base.css">
        <script type="text/javascript" src="../jqtouch/jquery.1.3.2.min.js"></script>
        <script type="text/javascript" src="../jqtouch/jqtouch.js"></script>
        <script type="text/javascript" charset="utf-8">
            $.jQTouch();
        </script>
    </head>
    <body>
        <div id="home">
                <div class="toolbar">
                <h1>女の子一覧</h1>
                </div>
                
                {foreach from=$prtData item=value name=result}
                <div class="info">
                    <h1>{$value.img}</h1>
                    <h2>{$value.name}</a>( {$value.age} )</h2>
                </div>
                {/foreach}
        </div>
    </body>
</html>