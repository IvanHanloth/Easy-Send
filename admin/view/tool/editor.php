<?php include_once dirname(__FILE__) . "/../header.php" ?>
<link href="https://cdn.bootcdn.net/ajax/libs/wangeditor5/5.1.23/css/style.min.css" rel="stylesheet">
<script src="https://cdn.bootcdn.net/ajax/libs/wangeditor5/5.1.23/index.min.js"></script>
<style>
    #editor—wrapper {
        border: 1px solid #ccc;
        z-index: 100;
        /* 按需定义 */
    }

    #toolbar-container {
        border-bottom: 1px solid #ccc;
    }

    #editor-container {
        height: 500px;
    }
</style>

<body class="pear-container">
    <div class="pear-main">
            <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;" id="log_box">
                <legend>富文本编辑器</legend>
            </fieldset>
        <div id="editor—wrapper">
            <div id="toolbar-container"><!-- 工具栏 --></div>
            <div id="editor-container"><!-- 编辑器 --></div>
        </div>
        <pre class="layui-code" lay-options="{theme: 'dark'}" id="code-show">
</pre>
    </div>
    <script>
        const {
            createEditor,
            createToolbar
        } = window.wangEditor

        const editorConfig = {
            placeholder: 'Type here...',
            onChange(editor) {

                layui.use(function() {
                    $ = layui.jquery;
                    layui.code({
                        elem: '#code-show',
                        code: editor.getHtml(),
                        lang:'html',
                        ln:false
                    });
                })
                // document.getElementById('code-show').innerText =editor.getHtml() 
            }
        }
        const editor = createEditor({
            selector: '#editor-container',
            html: '<p><br></p>',
            config: editorConfig,
            mode: 'default', // or 'simple'
        })

        const toolbarConfig = {}

        const toolbar = createToolbar({
            editor,
            selector: '#toolbar-container',
            config: toolbarConfig,
            mode: 'default', // or 'simple'
        })
    </script>
</body>

</html>