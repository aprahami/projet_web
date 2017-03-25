<article>
<h1>Objets Connectés</h1>

<div class="values index large-9 medium-8 columns content">
    <h3><?= __('Trusted') ?></h3>
	
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('member_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('serial') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
		
            
				<?php foreach($infos as $value){
					if ($value['member_id']==$id)
						$test += $value['trusted'];
					if (($value['trusted'])&&($value['member_id']==$id)){
						echo "<td>".$value['id']."</td>";
						echo "<td>".$this->Html->link($value['member_id'], ['controller' => 'Sport', 'action' => 'monCompte', $value['member_id']])."</td>";
						echo "<td>".$value['serial']."</td>";
						echo "<td>".$value['description']."</td>";
						echo "<td class='actions'>";
							echo $this->Html->link(__('Edit'), ['action' => 'edit', $value['id']]);
							echo " ";
							echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $value['id']], ['confirm' => __('Are you sure you want to delete # {0}?', $value['id'])]);
						echo "</td></tr>";
						if ((count($value['trusted'])!=$test)&&($value['member_id']==$id)){
							echo "</tr><tr><td></td><td></td><td></td><td></td>";
							echo "<td class='actions'>";
								echo $this->Html->link(__('Add'), ['action' => 'add', $value['id']]);
							echo "</td></tr>";
						}
					}
				}
				if (!$test){
						echo "<td></td><td></td><td></td><td></td>";
						echo "<td class='actions'>";
							echo $this->Html->link(__('Add'), ['action' => 'add', $value['id']]);
						echo "</td></tr>";
					}
				?>
			
        </tbody>
    </table>
</div>

</article>
<aside>

<div class="values index large-9 medium-8 columns content">
    <h3><?= __('Untrusted') ?></h3>
	
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('member_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('serial') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
		
            
				<?php foreach($infos as $value){
					if ($value['member_id']==$id)
						$test += $value['trusted'];
					if ((!$value['trusted'])&&($value['member_id']==$id)){
						echo "<td>".$value['id']."</td>";
						echo "<td>".$this->Html->link($value['member_id'], ['controller' => 'Sport', 'action' => 'monCompte', $value['member_id']])."</td>";
						echo "<td>".$value['serial']."</td>";
						echo "<td>".$value['description']."</td>";
						echo "<td class='actions'>";
							echo $this->Html->link(__('Edit'), ['action' => 'edit', $value['id']]);
							echo " ";
							echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $value['id']], ['confirm' => __('Are you sure you want to delete # {0}?', $value['id'])]);
						echo "</td></tr>";
						if ((count(!$value['trusted'])!=$test)&&($value['member_id']==$id)){
							echo "</tr><tr><td></td><td></td><td></td><td></td>";
							echo "<td class='actions'>";
								echo $this->Html->link(__('Add'), ['action' => 'add', $value['id']]);
							echo "</td></tr>";
						}
					}
				}
				if (!$test){
						echo "<td></td><td></td><td></td><td></td>";
						echo "<td class='actions'>";
							echo $this->Html->link(__('Add'), ['action' => 'add', $value['id']]);
						echo "</td></tr>";
					}
				?>
			
        </tbody>
    </table>
</div>

</aside>