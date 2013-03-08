<div id="header">
    <div class="logo"></div>
    <div class="user">
        <ul>
            <li>Ol&aacute;, <a href="javascript:void(0);"><?=$this->session->userdata('session_name');?></a></li>
            <li><?=anchor(base_url(), 'Ver site')?></li>
            <li><a id="logout" href="javascript:void(0);">Sair</a></li>
        </ul>
    </div>
</div>