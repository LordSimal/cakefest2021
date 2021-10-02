<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Coin[]|\Cake\Collection\CollectionInterface $coins
 */
?>
<div class="coins index content">
    <?//= $this->Html->link(__('New Coin'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <?= $this->Html->link(__('Sync'), ['action' => 'sync'], ['class' => 'button float-right']) ?>
    <h3><?= __('Coins') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
<!--                    <th>--><?//= $this->Paginator->sort('id') ?><!--</th>-->
<!--                    <th>--><?//= $this->Paginator->sort('ext_ident') ?><!--</th>-->
                    <th><?= $this->Paginator->sort('name') ?></th>
<!--                    <th>--><?//= $this->Paginator->sort('symbol') ?><!--</th>-->
<!--                    <th>--><?//= $this->Paginator->sort('rank') ?><!--</th>-->
<!--                    <th>--><?//= $this->Paginator->sort('price') ?><!--</th>-->
<!--                    <th>--><?//= $this->Paginator->sort('volume') ?><!--</th>-->
<!--                    <th>--><?//= $this->Paginator->sort('marketCap') ?><!--</th>-->
<!--                    <th>--><?//= $this->Paginator->sort('availableSupply') ?><!--</th>-->
<!--                    <th>--><?//= $this->Paginator->sort('totalSupply') ?><!--</th>-->
                    <th><?= $this->Paginator->sort('priceChange1h') ?></th>
                    <th><?= $this->Paginator->sort('priceChange1d') ?></th>
                    <th><?= $this->Paginator->sort('priceChange1w') ?></th>
<!--                    <th>--><?//= $this->Paginator->sort('websiteUrl') ?><!--</th>-->
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($coins as $coin): ?>
                <tr>
<!--                    <td>--><?//= $this->Number->format($coin->id) ?><!--</td>-->
<!--                    <td>--><?//= h($coin->ext_ident) ?><!--</td>-->
                    <td><?= h($coin->name) ?></td>
<!--                    <td>--><?//= h($coin->symbol) ?><!--</td>-->
<!--                    <td>--><?//= $this->Number->format($coin->rank) ?><!--</td>-->
<!--                    <td>--><?//= $this->Number->format($coin->price) ?><!--</td>-->
<!--                    <td>--><?//= $this->Number->format($coin->volume) ?><!--</td>-->
<!--                    <td>--><?//= $this->Number->format($coin->marketCap) ?><!--</td>-->
<!--                    <td>--><?//= $this->Number->format($coin->availableSupply) ?><!--</td>-->
<!--                    <td>--><?//= $this->Number->format($coin->totalSupply) ?><!--</td>-->
                    <td><?= $this->Number->format($coin->priceChange1h) ?></td>
                    <td><?= $this->Number->format($coin->priceChange1d) ?></td>
                    <td><?= $this->Number->format($coin->priceChange1w) ?></td>
<!--                    <td>--><?//= h($coin->websiteUrl) ?><!--</td>-->
                    <td><?= h($coin->created) ?></td>
                    <td><?= h($coin->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $coin->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $coin->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $coin->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coin->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
