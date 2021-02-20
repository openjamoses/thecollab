<?php
//session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['id'])) {
    Redirect::to('index?!=logout|' . $_SESSION['email']);
}
?>
<div class="body-nav body-nav-vertical body-nav-fixed">
    <div class="container">
        <ul>
            
            <li>
                <a href="index?!=dashboard|38837892urhfvn,opeiiuy82773772366562781876ewtfyuewgdbhjs">
                    <i class="icon-dashboard icon-large"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="index?!=downs|38837892urhfvn,opeiiuy82773772366562781876ewtfyuewgdbhjs">
                    <i class="icon-download icon-large"></i> Downloads
                </a>
            </li>
            <li>
                <a href="index?!=plt|38837892urhfvn,opeiiuy82773772366562781876ewtfyuewgdbhjs">
                    <i class="icon-leaf icon-large"></i> Platform
                </a>
            </li>
            <li>
                <a href="index?!=notfy|38837892urhfvn,opeiiuy82773772366562781876ewtfyuewgdbhjs">
                    <i class="icon-bell icon-large"></i> Notifications
                </a>
            </li>
            <li>
                <a href="index?!=#|38837892urhfvn,opeiiuy82773772366562781876ewtfyuewgdbhjs">
                    <i class="icon-cogs icon-large"></i> Settings
                </a>
            </li>
            
        </ul>
    </div>
</div>
<!-- /navbar -->
