<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Coin $coin
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $coin->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $coin->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Coins'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="coins form content">
            <?= $this->Form->create($coin) ?>
            <fieldset>
                <legend><?= __('Edit Coin') ?></legend>
                <?php
                    echo $this->Form->control('ext_ident');
                    echo $this->Form->control('name');
                    echo $this->Form->control('symbol');
                    echo $this->Form->control('rank');
                    echo $this->Form->control('price');
                    echo $this->Form->control('volume');
                    echo $this->Form->control('marketCap');
                    echo $this->Form->control('availableSupply');
                    echo $this->Form->control('totalSupply');
                    echo $this->Form->control('priceChange1h');
                    echo $this->Form->control('priceChange1d');
                    echo $this->Form->control('priceChange1w');
                    echo $this->Form->control('websiteUrl');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
