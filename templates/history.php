<?php if (empty($items)): ?>
    <p class="alert alert-info"><?= t('No history') ?></p>
<?php else: ?>

    <div class="page-header">
        <h2><?= t('History') ?> (<?= $nb_items ?>)</h2>
        <ul>
            <li><a href="?action=confirm-flush-history"><?= t('flush all items') ?></a></li>
        </ul>
    </div>

    <section class="items" id="listing">
    <?php foreach ($items as $item): ?>
        <?php $item_id = Model\encode_item_id($item['id']) ?>
        <article id="item-<?= $item_id ?>" data-item-id="<?= $item_id ?>" data-item-page="<?= $menu ?>">
            <h2>
                <?= $item['bookmark'] ? '★ ' : '' ?>
                <a
                    href="?action=show&amp;id=<?= $item_id ?>"
                    id="open-<?= $item_id ?>"
                >
                    <?= Helper\escape($item['title']) ?>
                </a>
            </h2>
            <p>
                <?= Helper\get_host_from_url($item['url']) ?> |
                <?= dt('%e %B %Y %k:%M', $item['updated']) ?> |
                <a href="?action=mark-item-unread&amp;id=<?= $item_id ?>&amp;offset=<?= $offset ?>"><?= t('mark as unread') ?></a> |

                <?php if (! $item['bookmark']): ?>
                    <a href="?action=bookmark&amp;value=1&amp;id=<?= $item_id ?>&amp;redirect=history&amp;offset=<?= $offset ?>"><?= t('bookmark') ?></a> |
                <?php endif ?>

                <a href="?action=mark-item-removed&amp;id=<?= $item_id ?>&amp;offset=<?= $offset ?>"><?= t('remove') ?></a> |
                <a
                    href="<?= $item['url'] ?>"
                    id="original-<?= $item_id ?>"
                    rel="noreferrer"
                    target="_blank"
                    data-item-id="<?= $item_id ?>"
                >
                    <?= t('original link') ?>
                </a>
            </p>
        </article>
    <?php endforeach ?>

    <nav id="items-paging">
    <?php if ($offset > 0): ?>
        <a id="previous-page" href="?action=history&amp;offset=<?= ($offset - $items_per_page) ?>">⇽ <?= t('Previous page') ?></a>
    <?php endif ?>
    &nbsp;
    <?php if (($nb_items - $offset) > $items_per_page): ?>
        <a id="next-page" href="?action=history&amp;offset=<?= ($offset + $items_per_page) ?>"><?= t('Next page') ?> ⇾</a>
    <?php endif ?>
    </nav>

    </section>

<?php endif ?>
