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
            <?= $this->Html->link(__('Edit Coin'), ['action' => 'edit', $coin->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Coin'), ['action' => 'delete', $coin->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coin->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Coins'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Coin'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="coins view content">
            <h3><?= h($coin->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Ext Ident') ?></th>
                    <td><?= h($coin->ext_ident) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($coin->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Symbol') ?></th>
                    <td><?= h($coin->symbol) ?></td>
                </tr>
                <tr>
                    <th><?= __('WebsiteUrl') ?></th>
                    <td><?= h($coin->websiteUrl) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($coin->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rank') ?></th>
                    <td><?= $this->Number->format($coin->rank) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= $this->Number->format($coin->price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Volume') ?></th>
                    <td><?= $this->Number->format($coin->volume) ?></td>
                </tr>
                <tr>
                    <th><?= __('MarketCap') ?></th>
                    <td><?= $this->Number->format($coin->marketCap) ?></td>
                </tr>
                <tr>
                    <th><?= __('AvailableSupply') ?></th>
                    <td><?= $this->Number->format($coin->availableSupply) ?></td>
                </tr>
                <tr>
                    <th><?= __('TotalSupply') ?></th>
                    <td><?= $this->Number->format($coin->totalSupply) ?></td>
                </tr>
                <tr>
                    <th><?= __('PriceChange1h') ?></th>
                    <td><?= $this->Number->format($coin->priceChange1h) ?></td>
                </tr>
                <tr>
                    <th><?= __('PriceChange1d') ?></th>
                    <td><?= $this->Number->format($coin->priceChange1d) ?></td>
                </tr>
                <tr>
                    <th><?= __('PriceChange1w') ?></th>
                    <td><?= $this->Number->format($coin->priceChange1w) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($coin->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($coin->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
