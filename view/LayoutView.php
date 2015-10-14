<?php

class LayoutView {
    
    /*
    Handles the rendering to the client.
    */
    
    public function render($mainView, $navigationView) {
        
        echo '
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="utf-8">
                <link rel="stylesheet" type="text/css" href="css/style.css">
                <title>Programming project - Strength Logger</title>
            </head>
            <body>
                ' . $mainView->showHeadline() .'
                ' . $mainView->showLogoutPanel() .'
                ' . $navigationView->showLinks() .'
                <div id="container">
                    ' . $mainView->showContent() . '
                </div>
            </body>
        </html>
        ';
    }
}
