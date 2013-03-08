<div id="content">
    <h3>Mensagens &raquo; <?=$title;?></h3>
    <div class="list">
            <?php foreach ($phrases->result() as $row): ?>
                <div id="item_<?=$row->id?>" class="phrase">
                    <div class="details">
			<span class="name"><?=$row->name;?> </span>
                        <span class="content"><?=$row->message;?></span>
			<span class="date">mensagem enviada em <?=$row->createdOn;?></span>
                    </div>
                    <button id="<?=$row->id?>" class="up <? if ($status == 1) echo 'disabled';?>">"aprovar</button>
		    <button id="<?=$row->id?>" class="down <? if ($status == 2) echo 'disabled';?>">reprovar</button>
                </div>
            <?php endforeach ?>
        </ul>
    </div>
</div>