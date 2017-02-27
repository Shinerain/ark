<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Collapsed Sidebar Layout</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="_token" content="{{csrf_token()}}">
    <link rel=stylesheet href="/assets/plugins/codemirror/doc/docs.css">
    <link rel="stylesheet" href="/assets/plugins/codemirror/lib/codemirror.css">
    <link rel="stylesheet" href="/assets/plugins/codemirror/addon/display/fullscreen.css">
    <link rel="stylesheet" href="/assets/plugins/codemirror/theme/night.css">

    <script src="/assets/plugins/codemirror/lib/codemirror.js"></script>
    <script src="/assets/plugins/codemirror/addon/edit/matchbrackets.js"></script>
    @if(str_contains($file->name, '.php'))
        <script src="/assets/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
        <script src="/assets/plugins/codemirror/mode/xml/xml.js"></script>
        <script src="/assets/plugins/codemirror/mode/css/css.js"></script>
        <script src="/assets/plugins/codemirror/mode/clike/clike.js"></script>
        <script src="/assets/plugins/codemirror/mode/php/php.js"></script>
    @endif
    @if(str_contains($file->name, '.js'))
        <script src="/assets/plugins/codemirror/addon/comment/continuecomment.js"></script>
        <script src="/assets/plugins/codemirror/addon/comment/comment.js"></script>
        <script src="/assets/plugins/codemirror/mode/javascript/javascript.js"></script>
    @endif
    <script src="/assets/plugins/codemirror/addon/display/fullscreen.js"></script>

</head>
<body>
<div class="wrapper" style="min-height: 700px;">
    <textarea id="myTextarea" name="myTextarea" style="width: 100%; overflow-y:visible " >
        {!! $file->content !!}
    </textarea>
</div>
<script>
@if(str_contains($file->name, '.php'))
    var editor = CodeMirror.fromTextArea(document.getElementById("myTextarea"),{
        lineNumbers: true,
        matchBrackets: true,
        mode: "application/x-httpd-php",
        indentUnit: 4,
        indentWithTabs: true,
        theme: "night",
    });
@endif
@if(str_contains($file->name, '.js'))
    var editor = CodeMirror.fromTextArea(document.getElementById("myTextarea"),{
        lineNumbers: true,
        matchBrackets: true,
        continueComments: "Enter",
        extraKeys: {"Ctrl-Q": "toggleComment", "Ctrl-S": "save"},
        theme: "night",
    });
@endif

</script>
</body>
</html>