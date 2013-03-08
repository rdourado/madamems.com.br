<div id="content">
    <h3>USU&AacuteRIOS &raquo; <?=isset($editUser) ? "EDITAR" : "NOVO"?> USU&AacuteRIO</h3>
    <form id="usuarios-form" class="form" insert-id="<? if (isset($editUser)) echo $editUser[0]['id']; ?>">
        <span>Nome</span>
        <input type="text" id="text-name" value="<? if (isset($editUser)) echo $editUser[0]['name']; ?>" />
        <span>E-mail</span>
        <input type="text" id="text-email" value="<? if (isset($editUser)) echo $editUser[0]['email']; ?>" />
        <span>Senha</span>
        <input type="password" id="text-password" value="" />
        <div class="divider"></div>
        <input type="submit" class="bt-submit" value="Salvar" />
    </form>
    <div class="list">
    <h2>Usuários cadastrados</h2>
    <ul id="list-users"></ul>
    </div>
</div>